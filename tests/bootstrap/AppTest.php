<?php

declare(strict_types=1);

require "bootstrap/Route.php";
require "bootstrap/View.php";
require "bootstrap/Controller.php";
require "bootstrap/App.php";

use PHPUnit\Framework\TestCase;

class AppTest extends TestCase
{
    private \bootstrap\App $app;
    private string $url = "user/system";
    private array $profile = array("user", "admin");

    /**
     * @param $object
     * @param string $method
     * @param array $parameters
     * @return mixed
     * @throws \Exception
     */
    private function callMethod($object, string $method , array $parameters = [])
    {
        try {
            $className = get_class($object);
            $reflection = new \ReflectionClass($className);
        } catch (\ReflectionException $e) {
            throw new \Exception($e->getMessage());
        }

        $method = $reflection->getMethod($method);
        $method->setAccessible(true);

        return $method->invokeArgs($object, $parameters);
    }

    public function testLoadFileController()
    {
        $this->app = new \bootstrap\App($this->url);
        $this->app->_userProfiles = $this->profile;
        $this->app->getRoutes();
        $this->assertTrue($this->callMethod($this->app, 'loadFileController'));
        if ($this->url == "" || $this->url == "admin")
            $this->assertTrue($this->callMethod($this->app, 'isIndex'));
        $this->assertTrue(true);
    }

}