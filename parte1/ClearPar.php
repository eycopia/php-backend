<?php

/**
 * Name: ClearPar.php
 *
 * Author: Jorge Copia <eycopia@gmail.com>
 *
 * Description: dado un conjunto de parentesis, devolver solo aquellas que tengan pareja
 */
class ClearPar
{

    public function buildWithRegex($string){
        $regex = "(\(\))";
        preg_match_all($regex, $string, $result);
//        echo "<pre>";print_r($result);exit;
        return join('',$result[0]);
    }

    public function build($string)
    {
        $this->matchParentheses($string);
        $newString = '';
        foreach ($this->pares as $par){
            if(count($par) >= 2){
                $newString .= '()';
            }
        }
        return $newString;
    }


    private $subQuery = array();

    private $pares = array();

    private function matchParentheses($sqlLower){
        if(count($this->subQuery) == 0 ){
            $this->subQuery['openBracket'] = $this->getPositions( '(', $sqlLower);
            $this->subQuery['closeBracket'] = $this->getPositions(')', $sqlLower);
            while(count($this->subQuery['openBracket']) > 0){
                $this->pares[] = $this->emparejar($this->subQuery['closeBracket'],
                    $this->subQuery['openBracket']);
            }
        }
    }


    /**
     * Busca todas las posiciones del carecter o string $char en $sql
     * @param  string $char  string a buscar
     * @param  string $sql  fuente de donde buscar
     * @return array
     */
    public function getPositions($char, $sql){
        $positions = array();
        $pos = -1;
        while (($pos = strpos($sql, $char, $pos+1)) !== false) {
            $positions[] = $pos;
        }
        return $positions;
    }


    /**
     * Busca posiciones de string de Apertura y Cierre como (), [] o palabras
     * @param  array &$cierre   posiciones de Apertura
     * @param  array &$apertura posiciones de Cierre
     * @return array datos emparejados
     */
    public function emparejar(&$cierre, &$apertura){
        $match = null;
        foreach ($cierre as $c) {
            $par = null;
            foreach ($apertura as $a) {
                if($a  > $c ){ break; }
                else{ $par = array($a, $c); }
            }
            if(!is_null($par)){
                $match = $par;
                break;
            }
        }
        if(count($cierre) == 1){
            $apertura =  $cierre  = array();
        }else{
            $apertura = array_diff($apertura, array($match[0]));
            $cierre = array_diff($cierre, array($match[1]));
        }
        return $match;
    }
}