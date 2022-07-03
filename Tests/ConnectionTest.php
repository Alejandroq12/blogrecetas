<?php
use PHPUnit\Framework\TestCase;

final class ConnectionTest extends TestCase{
    public function testDbConnection():void{
        $this->assertIsObject(ConnectionTest::conn());
    }
}

?>