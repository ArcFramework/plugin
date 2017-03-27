#!/usr/bin/env php
<?php

use Acclimate\Container\ContainerAcclimator;
use Silly\Application;
use Symfony\Component\Console\Output\OutputInterface;
use Vendor\PluginName\Plugin;

$arc = new ArcCommandLineInterface(__DIR__);
$arc->boot();

class ArcCommandLineInterface
{
    /**
     * The instance of Silly CLI
     * @var Silly\Application
     **/
    protected $arc;

    /**
     * The command signatures (key) and the command classes which they map to (value)
     * @var array
     **/
    protected $commands = [
        'make:provider [name]'      => \Arc\Console\GenerateProviderCommand::class,
        'make:controller [name]'    => \Arc\Console\GenerateControllerCommand::class,
        'ship'                      => \Arc\Console\ShipPluginCommand::class,
    ];

    /**
     * string $dir the path to the directory which contains the plugin
     * @var string
     **/
    protected $dir;

    /**
     * The environment variables that have been set
     * @var array
     **/
    protected $env = [];

    /**
     * The instance of the Arc Framework based plugin
     * @var Arc\BasePlugin
     **/
    public function __construct($dir)
    {
        $this->dir = $dir;
    }

    /**
     * Boot the command line interface
     **/
    public function boot()
    {
        $this->registerAutoLoader();
        $this->loadEnvironmentVariables();
        $this->bootWordpress();
        $this->bootPlugin();
        $this->buildCommandLineInterface();
        $this->registerCommands();
        $this->run();
    }

    /**
     * Register the composer autoloader for the plugin
     **/
    protected function registerAutoloader()
    {
        require($this->dir . '/vendor/autoload.php');
    }

    /**
     * Load any environment variables that have been set
     **/
    protected function loadEnvironmentVariables()
    {
        if (file_exists($this->dir . '/.env')) {
            foreach(file($this->dir . '/.env') as $envLine) {
                $pair = explode('=', $envLine);
                $this->env[trim($pair[0])] = trim($pair[1]);
            }
        }
    }

    /**
     * Boot the wordpress application
     **/
    protected function bootWordpress()
    {
        $wordpressPath = $this->getEnv('WORDPRESS_PATH', '/../../../../');
        define('WP_USE_THEMES', false);

        // Main wordpress bootstrap file
        require $wordpressPath . '/wp-load.php';

        // Plugin bootstrap file
        require $wordpressPath . '/wp-admin/includes/plugin.php';
    }

    /**
     * Get the value for the given environment variable key if it exists, or else
     * return the default
     * @param string $key
     * @param mixed $default
     * @return mixed
     **/
    protected function getEnv($key, $default = null)
    {
        if (!isset($this->env[$key])) {
            return $default;
        }

        return $this->env[$key];
    }

    /**
     * Boot the Arc framework based plugin
     **/
    protected function bootPlugin()
    {
        $this->plugin = new Plugin($this->getEnv('PLUGIN_PATH') . '/' . $this->getEnv('PLUGIN_FILENAME'));
        $this->plugin->boot();
    }

    protected function buildCommandLineInterface()
    {
        // Instantiate the console application
        $this->arc = new Application;

        // Register the container
        $this->arc->useContainer($this->plugin);
    }

    /**
     * Register any commands for the CLI
     **/
    protected function registerCommands()
    {
        foreach ($this->commands as $signature => $class) {
            $this->arc->command($signature, $class);
        }
    }

    /**
     * Run the CLI
     **/
    protected function run()
    {
        $this->arc->run();
    }

    /**
     * Get the current user's home directory
     * @return string
     **/
    protected function getHomeDirectory()
    {
        if (isset($_SERVER['HOME'])) {
            return $_SERVER['HOME'];
        }

        return posix_getpwuid(posix_getuid())['dir'];
    }
}
