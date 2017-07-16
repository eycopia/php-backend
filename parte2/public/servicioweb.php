<?php
error_reporting(0);
require_once dirname(dirname(__FILE__)).'/vendor/autoload.php';
$server = new nusoap_server();

$server->configureWSDL('Employee Web Service', 'urn:server');

$server->wsdl->schemaTargetNamespace = 'urn:server';

$server->register(
    'filtrar_salario',
    array('minimo' => 'xsd:string',
        'maximo' => 'xsd:string'
    ),
    array('return' => 'xsd:Array'),
    'urn:server',
    'urn:server#Comercio',
    'rpc',
    'encoded',
    'Busca un empleado por rango salaria'
);

function filtrar_salario($minimo, $maximo){
    $minimo = str_replace(array('$', ','), '', $minimo);
    $maximo = str_replace(array('$', ','), '', $maximo);
    if(is_numeric($minimo) && is_numeric($maximo)){
        $e = new \App\Employee();
        $rs = $e->filtrarPorSalario($minimo, $maximo);
    }else{
        $rs = array('Error' => 'true', 'message' => 'Debe ingresar los montos en formato numerico');
    }
    return  $rs;
}

$HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : '';
$server->service($HTTP_RAW_POST_DATA);