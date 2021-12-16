<?php

declare(strict_types=1);

require "bootstrap/View.php";

use PHPUnit\Framework\TestCase;

class ViewTest extends TestCase
{

    public function testRender()
    {
        $view = new \bootstrap\View();
        $this->assertTrue($view->render("../resources/view/user/init"));
    }

}