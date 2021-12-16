<?php

require "bootstrap/Route.php";

use PHPUnit\Framework\TestCase;


class RouteTest extends TestCase
{
    private string $url = "user/System";
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

    /**
     * @param 	string $className
     * @param 	string $propertyName
     * @return	ReflectionProperty
     */
    public function getPrivateProperty( $className, $propertyName ) {
        $reflector = new ReflectionClass( $className );
        $property = $reflector->getProperty( $propertyName );
        $property->setAccessible( true );

        return $property;
    }

    public function testSplitUrl()
    {
        $router = new \bootstrap\Route($this->url, $this->profile);
        $router->splitUrl();
        $this->assertIsString(
            $router->getFirstPoint()
        );
        $this->assertIsString(
            $router->getEndPoint()
        );
    }

    public function testGetProfileRoute()
    {
        $router = new \bootstrap\Route($this->url, $this->profile);
        $router->splitUrl();
        $this->assertTrue($this->callMethod($router, 'getProfileRoute'));
    }

    public function testGet()
    {
        $router = new \bootstrap\Route($this->url, $this->profile);
        $router->splitUrl();
        $this->assertIsArray($router->get());
    }

}