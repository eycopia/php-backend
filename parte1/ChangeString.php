<?php

/**
 * Name: ChangeString.php
 *
 * Author: Jorge Copia <eycopia@gmail.com>
 *
 * Description: Intercambia una letra por la siguiente en el abecedario
 */
class ChangeString
{
    private $abc;

    public function __construct()
    {
        $abc = str_replace(' ', '', "a, b, c, d, e, f, g, h, i, j, k, l, m, n, ñ, o, p, q, r,s, t, u, v, w, x, y, z");
        $this->abc = explode(',', $abc);
    }

    public function build($string)
    {
        $letters = str_split($string);
        $newString = '';
        foreach ($letters as $letter){
            if(preg_match('/[a-z]/i', $letter)){
                $newString .= $this->changeLetter($letter);
            }else{
                $newString .= $letter;
            }
        }
        return $newString;
    }

    /**
     * Busca la siguiente letra en el abcedario
     * @param string $letter
     * @return string
     */
    private function changeLetter($letter){
        $isLower = ctype_lower($letter);
        $letter = strtolower($letter);
        $rs = '';
        if($letter == 'z'){
            $rs = $isLower ? 'a' : 'A';
        }else{
            $pos = array_search($letter, $this->abc) + 1;
            $rs = $isLower ? $this->abc[$pos] : strtoupper($this->abc[$pos]);
        }
        return $rs;
    }

}
