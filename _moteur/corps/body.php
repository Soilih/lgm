
<body id="page-top">
    <div id="wrapper">
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <?php 
                require_once(__CHEMIN_TEMPLATE__.'profile.php');
                var_dump($_SESSION);
                ?>
                <div class="container-fluid">
                    <div class="row">
                        <!-- Content Column -->
                        <div class="col-lg-12 mb-4">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Gestion commandes  </h6>
                                </div>
                                <div class="card-body">
                                <div id="smartwizard">
                                    <ul class="nav">
                                    <li>
                                        <a class="nav-link" href="#step-1">
                                         Liste des produits  <span class="badge  badge-md badge-primary"><?= $nbproduct; ?></span>
                                        </a>
                                       
                                    </li>
                                    <li>
                                        <a class="nav-link" href="#step-2">
                                        Ajouter panier 
                                        </a>
                                    </li>
                                    <li>
                                        <a class="nav-link" href="#step-3">
                                        Valider panier 
                                        </a>
                                    </li>
                                    </ul>
                                <div class="tab-content">
                                    <div id="step-1" class="tab-pane" role="tabpanel">
                                        <div class="container-fluid">
                                            <div class="row">
                                               <?php 
                                                foreach ($produit as $value): ?> 
                                                    <div class="col-xs-12 col-md-2 col-sm-4" id="col-card">
                                                        <div class="card" id="card-produit">
                                                            <div class="card-body">
                                                            <form class="user" method="POST" action="./src/Controller/Connexion.php">
                                                                <img  src="<?=  $value["image"]; ?>" id="img-produit" class="img-responsive">
                                                                <h3 id="titre"> <?=  $value["libelle"]; ?> </h3>
                                                                <p id="prix"><?=  number_format($value["prix"], 2, ',', '€')   ."€"; ?></p>
                                                                    <input type="hidden" name="prix" value="<?= $value["prix"];  ?>">
                                                                    <input type="hidden"  name="idproduit" value="<?= $value["idproduit"]; ?>">
                                                                    <input type="hidden"  name="qte" value="1">
                                                                    <input name="action" value="panier_add" type="hidden">
                                                                    <button type="submit" id="panier" class="btn btn-danger"> <i class="fas fa-shopping-cart"></i> ajouter panier </a> </button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php endforeach ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="step-2" class="tab-pane" role="tabpanel">
                                        <?php 
                                         require_once(__CHEMIN_CORPS__.'addpanier.php')
                                        ?>
                                    </div>
                                    <div id="step-3" class="tab-pane" role="tabpanel">
                                        <?php 
                                         require_once(__CHEMIN_CORPS__.'validerpanier.php')
                                        ?>
                                    </div>
                                </div>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php 
            require_once(__CHEMIN_TEMPLATE__.'footer.php');
            ?>
        </div>
    </div>
