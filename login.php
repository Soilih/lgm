<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>LGM</title>
        <?php  include("./src/link/link_css.php"); 
         
        ?>
    </head>
    
    <body class="bg-gradient-primary">
        <div class="container">
            <div class="row">
               
                <div class="col-lg-6 col-xl-6" id="connexion">
                    <div class="card"> 
                    <h5 class="card-header" id="connexion-form"><strong> CONNEXION </strong> </h5>
                        <div class="card-body">
                            <form class="user" method="POST" action="./src/Controller/Connexion.php" >
                                    <div class="form-group">
                                    <label for="email">Adresse E-mail:</label>
                                        <input type="email" name="email" required class="form-control" placeholder="Enter votre email" id="email">
                                    </div>
                                    <div class="form-group">
                                        <label for="pwd">Mot de passe :</label>
                                        <input type="password" name="password" class="form-control" placeholder="Entrer votre mot de passe" id="pwd">
                                    </div>
                                    <div class="form-group form-check">
                                        <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox"> Remember me
                                        </label>
                                    </div>
                                    <input type="hidden" name="action" value="login_user">
                                    <button  type="submit" id="connexion" class="btn btn-primary btn-user btn-block">
                                        Se connecter 
                                    </button>
                                <hr>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php  include("./src/link/link_js.php")  ?>
    </body>
</html>