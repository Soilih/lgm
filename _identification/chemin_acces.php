<?php
// if(!isset($_SESSION['userMail'])&&!isset($_SESSION['userPsw'])){session_start();}
if($CheminRacine ){
}else{
    $CheminRacine = str_replace('index.php', '', $_SERVER['SCRIPT_FILENAME']);
}

define("__CHEMIN_STRUCTURE__", $CheminRacine."_moteur/structure/");
define("__CHEMIN_CORPS__", $CheminRacine."_moteur/corps/");
define("__SITE_THEME__" ,$CheminRacine."public/" );
define("__CHEMIN_IDENTIFICATION__", $CheminRacine."_identification/");
define("__CHEMIN_TEMPLATE__", $CheminRacine."Template/");
define("__CHEMIN_SRCONFIG__", $CheminRacine."_config/");
define("__CHEMIN_SRCONFIGDB__", $CheminRacine."src/config/");
define("__CHEMIN_SRCLINK__", $CheminRacine."src/link/");
define("__CHEMIN_CONTROLER__", $CheminRacine."src/Controller/");
// require_once(__CHEMIN_CONTROL__.'control_url.php');
// require_once(__CHEMIN_CONTROL__.'control_structure.php');
?>
