<?php 
include_once "./API.php";
//declaration de variable 
$url = 'https://app.dolifact.fr/demo/api/index.php/thirdparties?sortfield=t.rowid&sortorder=ASC&limit=100';
$apikey = 'O3J2QPeT3swlJrQV8q815oTKpfs6W85r';
$data = false;
$method = "GET" ; 
$resulatt = api_dolibarr($method , $apikey , $url , $data );
 print_r(json_encode($resulatt ));
?>