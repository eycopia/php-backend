<?php require_once dirname(__FILE__) . "/CompleteRange.php";

/**
 * Name: CompleteRangeTest.php
 *
 * Author: Jorge Copia <eycopia@gmail.com>
 *
 * Description:
 */
class CompleteRangeTest extends PHPUnit_Framework_TestCase
{
    private $obj;

    public function setUp()
    {
        $this->obj = new CompleteRange();
    }

    public function test_rango1_5()
    {
        $rango = array(1,2,4,5);
        $expected = array(1,2,3,4,5);
        $this->assertEquals($expected, $this->obj->build($rango));
    }

    public function test_rango2_9()
    {
        $rango = array(2,4,9);
        $expected = array(2,3,4,5,6,7,8,9);
        $this->assertEquals($expected, $this->obj->build($rango));
    }

    public function test_rango55_60()
    {
        $rango = array(55,58,60);
        $expected = array(55,56,57,58,59,60);
        $this->assertEquals($expected, $this->obj->build($rango));
    }
}
