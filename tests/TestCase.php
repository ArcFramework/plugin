<?php

use Arc\Testing\ArcTestCase;
use Illuminate\Contracts\Console\Kernel;

class TestCase extends ArcTestCase
{
    public function createApplication()
    {
        $plugin = new Vendor\PluginName\Plugin(realpath(__DIR__ . '/../plugin-name.php'));

        $plugin->make(Kernel::class)->bootstrap();

        $this->app = $plugin;
    }

    public function tearDown()
    {
        parent::tearDown();

        Mockery::close();
    }
}
