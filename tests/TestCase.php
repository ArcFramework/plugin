<?php

use Arc\Testing\ArcTestCase;

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
