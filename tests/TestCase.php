<?php

use Arc\Testing\ArcTestCase;

class TestCase extends ArcTestCase
{
    public function __construct()
    {
        $this->app = Vendor\PluginName\Plugin::plugin();
    }

    public function tearDown()
    {
        parent::tearDown();

        Mockery::close();
    }
}
