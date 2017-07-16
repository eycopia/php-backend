<?php require_once dirname(__FILE__) . "/ChangeString.php";

/**
 * Name: ChangeStringTest.php
 *
 * Author: Jorge Copia <eycopia@gmail.com>
 *
 * Description:
 */
class ChangeStringTest extends PHPUnit_Framework_TestCase
{
    private $obj;
    public function setUp()
    {
        $this->obj = new ChangeString();
    }
    public function test_simpleString()
    {
        $this->assertEquals('123 bcde*3', $this->obj->build('123 abcd*3'));
    }

    public function test_simpleString2()
    {
        $this->assertEquals("**Dbtb 52", $this->obj->build('**Casa 52'));
    }

    public function test_simpleString3()
    {
        $this->assertEquals("**Dbtb 52A", $this->obj->build("**Casa 52Z"));
    }
}
