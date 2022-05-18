<?php  
//$CheminRacine = str_replace('index.php', '', $_SERVER['SCRIPT_FILENAME']);
require_once("./_identification/variable.php");
require_once($CheminRacine.'_identification/chemin_acces.php');

//ici j'include le head 
require_once(__CHEMIN_STRUCTURE__.'head_action.php');

//ici j'include le body
require_once(__CHEMIN_SRCLINK__.'head_database.php');
require_once(__CHEMIN_CORPS__.'body.php');
// ici j'include le css 
require_once(__CHEMIN_SRCLINK__.'link_js.php');

?>
