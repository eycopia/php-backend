<?php

/**
 * Name: CompleteRange.php
 *
 * Author: Jorge Copia <eycopia@gmail.com>
 *
 * Description: Dado una coleccion incompleta, completar
 */
class CompleteRange
{

    /**
     * Completa el rango
     * @param array $range
     * @return array
     */
    public function build(array $range)
    {
        return range($range[0], $range[count($range) -1]);
    }
}