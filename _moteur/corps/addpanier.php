<div class="container-fluid">
    <div class="row">
        <div class="col-lg-8 col-xl-12 col-md-6 col-sm-6">
            <div id="flex-container">
                <?php 
                   $id = $_SESSION["id"];
                    $idpanier = $datatabase->idpanierUser($id);
                    var_dump($idpanier);
                   //ici je mets l'id de la session de l'utilisateur 
                   //connecte à l'aplication 

                   $panier = $datatabase->ListPanier();

                    foreach($panier as $value): ?>
                        <div class="flex-item" id="flex">
                            <img  src="<?=  $value["image"]; ?>"  id="img-glace">
                            <h4 id="titre"><?= $value["libelle"] ?> </h4>
                            <p id="prix"><?=  number_format($value["prix"], 2, ',', '€') 
                              ."€"; ?> </p>
                            <form class="user" method="POST" action="./src/Controller/Connexion.php" >
                                <input id="qt" type="number" min="1" name="qt" value="1">
                                <input type="hidden" name="idcompo" value="<?= $value["idcompo"]; ?>">
                                <input type="hidden" name="action" value="update">
                            <button class="btn btn-sm btn-success">upadate</button>
                            </form>
                            <form class="user" method="POST" action="./src/Controller/Connexion.php" >
                                <input type="hidden" name="idcompo" value="<?= $value["idcompo"]; ?>">
                                <input type="hidden" name="action" value="delete">
                            <button class="btn btn-sm btn-danger">suprimer</button>
                            </form>
                        </div>
                    <?php endforeach ?>
                    <br>
          
            </div>
        </div>
    </div>
</div>