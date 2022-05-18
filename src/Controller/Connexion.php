<?php
$CheminRacine = str_replace('src/Controller/Connexion.php', '', $_SERVER['SCRIPT_FILENAME']);
require_once($CheminRacine.'_identification/chemin_acces.php');
require_once (__CHEMIN_SRCLINK__.'head_database.php');
require_once(__CHEMIN_SRCLINK__.'session.php');
if($_SERVER["REQUEST_METHOD"]=="POST")
{
    // ce fichier gere le systeme de connexion 
    // il recupere le mail et le mot de passe 
    //1. je teste si le mail est valide 
    if (isset($_POST["action"]) and  !empty($_POST) and  $_POST["action"]=="login_user") {
        if (isset($_POST["email"])   and isset($_POST["password"])) {
            //je recupere les informatiions du formulaire
            $email = htmlspecialchars($_POST["email"]);
            $password = htmlspecialchars($_POST["password"]);
            //je selectionne les mot de et le mail
            //je recupere la liste des produit
            $dt = $datatabase->login($email, $password);
            if ($dt) {
                echo "success";
                //header("Location: http://localhost/glace/index.php");
            //  }else{
            //    echo "les identifiants sont incorectes";

            //  }
            }
        }
    }    
    if (isset($_POST["action"]) and  !empty($_POST) and  $_POST["action"]=="panier_add") {
        $panier = $datatabase->equalReference();
        //je teste si les donnes sont envoyes
        $prix = $_POST["prix"];
        $qt = $_POST["qte"];
        $idproduit = $_POST["idproduit"];
        $idpanier = 1;
        //ici je teste si le produit est dejà selectionner dans le panier
        $select= $datatabase-> SelectProduit($idproduit);
        var_dump($select);
        if ($select) {
            //sinon j'ajoute le produit dans le panier
            $panierCompo = $datatabase->addPanierCompo($qt, $idpanier, $idproduit, $prix);
            header("location: http://localhost/glace/index.php");
        }
    }
    //je cree une instance panier compo
    if (isset($_POST["action"]) and !empty($_POST) and $_POST["action"]=="update") {
        $qt = intval($_POST["qt"]);
        $id = intval($_POST["idcompo"]);
        $updatapanier = $datatabase->Update($qt, $id);
        header("location: http://localhost/glace/index.php#step-2");
    }
    if (isset($_POST["action"]) and !empty($_POST) and $_POST["action"]=="delete") {
        $id = intval($_POST["idcompo"]);
        $updatapanier = $datatabase->deleteCompo($id);
        header("location: http://localhost/glace/index.php#step-2");
    }
    if (isset($_POST["action"]) and !empty($_POST) and $_POST["action"]=="panier_valider") {
        $status = $_POST["status"];
        $id = $_SESSION["id"];
        $valider = $datatabase->validerpanier(1, $id);
    }
}

?>