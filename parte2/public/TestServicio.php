<?php
require_once dirname(dirname(__FILE__)).'/vendor/autoload.php';
$wsdl = "http://localhost/comercio/parte2/public/servicioweb.php?wsdl";
$client = new nusoap_client($wsdl, 'wsdl');

$result=$client->call('filtrar_salario', array('minimo'=>1000, "maximo"=>1200));
//print_r($result1).'\n';

// Check for a fault
if ($client->fault) {
    echo '<h2>Fault</h2><pre>';
    print_r($result);
    echo '</pre>';
} else {
    // Check for errors
    $err = $client->getError();
    if ($err) {
        // Display the error
        echo '<h2>Error</h2><pre>' . $err . '</pre>';
    } else {
        // Display the result
        echo '<h2>Result</h2><pre>';
        print_r($result);
        echo '</pre>';
    }
}
echo '<h2>Request</h2><pre>' . htmlspecialchars($client->request, ENT_QUOTES) . '</pre>';
echo '<h2>Response</h2><pre>' . htmlspecialchars($client->response, ENT_QUOTES) . '</pre>';
echo '<h2>Debug</h2><pre>' . htmlspecialchars($client->debug_str, ENT_QUOTES) . '</pre>';