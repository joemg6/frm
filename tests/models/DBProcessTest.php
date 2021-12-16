<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

final class DBProcessTest extends TestCase
{
    public function testGetAllRowsGroupBy()
    {
        $PDO = \Database::getInstance()->getConnection();
        $db = new \models\DBProcess($PDO);
        $this->assertIsArray($db->getAllRowsGroupBy("access_profile", "idAccess_profile", "typeProfile"));
/*        $db = new \models\DBProcess($PDO);
        echo "\n=== OUTPUT:\n.........................................\n";
        print_r($db->getAllRowsGroupBy("access_profile", "idAccess_profile", "typeProfile"));
        echo ".........................................\n";*/
    }

    public function testGetCountRowsTable(): void
    {
        $PDO = \Database::getInstance()->getConnection();
        $db = new \models\DBProcess($PDO);
        $this->assertEquals(
            '45',
            $db->getCountRowsTable("sismos")
        );
    }

    public function testGetRowValuesDB(): void
    {
        $PDO = \Database::getInstance()->getConnection();
        $db = new \models\DBProcess($PDO);
        $this->assertIsArray($db->getRowValuesDB('sismos', 'idSismos', 46));
        $db = new \models\DBProcess($PDO);
        echo "\n=== OUTPUT:\n.........................................\n";
        print_r($db->getRowValuesDB("sismos", 'idSismos', 46));
        echo ".........................................\n";
    }

}