<?php

declare(strict_types=1);

require "bootstrap/View.php";
require "bootstrap/Controller.php";

use PHPUnit\Framework\TestCase;

class ControllerTest extends TestCase
{
    /**
     * This works for abstract methods.
     */
    public function testHandlerRequestPost() {
        $stub = $this->getMockForAbstractClass(\bootstrap\Controller::class);
        $_POST["_method"] = "_set";
        $this->assertTrue($stub->handlerRequestPost());
        unset($_POST["csrf_token"]);
    }

    public function testHandlerRequestCSRF() {
        $stub = $this->getMockForAbstractClass(\bootstrap\Controller::class);
        $_POST["_method"] = "_set";
        $stub->handlerRequestPost();
        $_SESSION['csrf_token'] = "123";
        $_POST["csrf_token"] = "123";
        $this->assertTrue($stub->handlerRequestCSRF());
        unset($_SESSION['csrf_token']);
        unset($_POST["csrf_token"]);
    }
}