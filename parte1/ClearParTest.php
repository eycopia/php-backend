<?php  require_once dirname(__FILE__) . "/ClearPar.php";

/**
 * Name: ClearParTest.php
 *
 * Author: Jorge Copia <eycopia@gmail.com>
 *
 * Description:
 */
class ClearParTest extends PHPUnit_Framework_TestCase
{
    private $obj;

    public function setUp()
    {
        $this->obj = new ClearPar();
    }
    public function test_tresPares()
    {
        $expected = '()()()';
        $this->assertEquals($expected, $this->obj->build('()())()'));
        $this->assertEquals($expected, $this->obj->buildWithRegex('()())()'));
    }

    public function test_dosPares()
    {
        $expected = '()()';
        $this->assertEquals($expected, $this->obj->buildWithRegex('()(()'));
        $this->assertEquals($expected, $this->obj->build('()(()'));
    }

    public function test_NoPares()
    {
        $expected = '';
        $this->assertEquals($expected, $this->obj->buildWithRegex(')('));
        $this->assertEquals($expected, $this->obj->build(')('));
    }

    public function test_TresAperturasUnCierre()
    {
        $expected = '()';
        $this->assertEquals($expected, $this->obj->buildWithRegex('((()'));
        $this->assertEquals($expected, $this->obj->build('((()'));
    }
}
