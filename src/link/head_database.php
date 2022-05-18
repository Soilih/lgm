<?php 
require_once(__CHEMIN_SRCONFIGDB__.'Database.php');
//intance de classe database 
$datatabase = new Database();
$datatabase->getConnection();
$produit = $datatabase->fetchData();
// $user = $datatabase->EqualUsersPanier();
$nbproduct = $datatabase->CountProduit();

?>