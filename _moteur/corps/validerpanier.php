<div class="container-fluid">
    <div class="row">
        <div class="col-lg-8 col-xl-12 col-md-6 col-sm-6">
            <div id="flex-container">
                <?php 
                    $id = $_SESSION["id"];
                    $idpanier = $datatabase->idpanierUser($id);
                    var_dump($idpanier);
                    $panier = $datatabase->ListPanier("SELECT 
                    * FROM  paniercompo , panier , produit , user where paniercompo.idpanier = panier.id
                    AND    paniercompo.idproduit =produit.idproduit AND panier.id_user = user.id
                    AND    panier.id_user = 7 ");
                    $total = 0;
                       foreach($panier as $value): ?>
                        <div class="flex-item" id="flex">
                            <img  src="<?=  $value["image"]; ?>"  id="img-glace">
                            <h4 id="titre"><?= $value["libelle"] ?> </h4>
                            <p id="prix"><?=  number_format($value["prix"], 2, ',', '€') 
                              ."€"; ?> </p>
                            <h5> <?= $value["quantite"]; ?></h5>
                        </div>
                      <?php  
                       $total +=$value["quantite"]*$value["prix"];
                       ?>
                    <?php endforeach ?>
                    <br>
                      <h5 style="float:right ; font-size:21px">Montant TTC  : <strong> <?= $total .'€'; ?> </strong> </h5>
                    <br>
                <form method="POST" action="./src/Controller/Connexion.php">
                    <input type="hidden"  value="0"  name="status">
                    <input name="action" value="panier_valider" type="hidden">
                    <button type="submit" id="btn-valider" class="btn btn-lg btn-success">Valider la commande</button>
                </form>
            </div>
        </div>
    </div>
</div>