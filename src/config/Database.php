<?php 
  
class Database 
{
    private $host = "127.0.0.1:3307";
    private $database_name = "lgmdatabase";
    private $username = "root";
    private $password = "";
    public $bdd;
    public $port = "3307";
    
    public function getConnection(){
        $this->bdd = null;
        try{
            $this->bdd = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->database_name, $this->username, $this->password , 
            array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8' , 
                PDO::ATTR_ERRMODE=> PDO::ERRMODE_WARNING ) 
        );
        }catch(PDOException $exception){
            die("<h1 style='color:red ; text-align:center ; font-size:20px;padding-top:30%'> <strong> Impossible de se connecter à la base de donneés... </strong> </h1>");
        }
        return $this->bdd;
    }
    /**
     * list Product 
     *
     * @return void
     */
    public function fetchData(){
            $result=($this->bdd)->query("SELECT * FROM produit");
            $data = $result->fetchAll(PDO::FETCH_ASSOC);
            return $data;
    }

    /**
     * Nombre de produit 
    */
    /**
     * list Product 
     *
     * @return void
     */
    public function CountProduit(){
        $result=($this->bdd)->query("SELECT * FROM produit");
        $count = $result->rowCount();
        return $count;
    }
    
    /**
     * Detail produit width id 
     */
    public function DetailProduit($id){
        $stm =($this->bdd)->prepare("SELECT * FROM produit  WHERE produit.idproduit = ?  ORDER BY idproduit ASC   ");
        $stm->execute(array($id));
        $data= $stm->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    /**
     * Login 
     */
        
    public function login($email , $pass) 
    {
        $req= ($this->bdd)->prepare("SELECT * FROM user WHERE email = ? AND mdp = ? ");
        $req->execute(array($email ,$pass ));
        $data = $req->fetchAll(PDO::FETCH_ASSOC);
        $count = $req->rowCount();
        if($count == 1 ){
          
           foreach($data as $value)
            {
            session_start();
            $_SESSION["id"] = $value["id"];
            $_SESSION["nom"] =$value["nom"];
            $_SESSION["prenom"] = $value["prenom"];
            $_SESSION["telephone"] = $value["telephone"];
            $_SESSION["societe"] = $value["societe"];
            $_SESSION["email"] = $value["email"];
           
            }
        }
        else{
            echo "les identifiants sont incorrectes ....";
        }
        return  $data;
    }
    
    /**
     * Code reference produit
     */
    public function GenereCode($c = NULL){
        $date = date('my');
        $num = rand(1, 10000);
        $ref_panier = "LGM".$date.'-'.$num;
            if(is_null($c)){
                return "LGM0522-2659";
            }else{
                return   $ref_panier;
            }
      
    }
    
    /**
     * creePanier
     *
     * @return void
     */
 
    public function creePanier($reference )
    {
        //je teste s'il existe une reference 
        //je securise un peu le panier 
        if(!isset($_SESSION)){
            session_start();
        }
        else
        {
            $id = $_SESSION["id"];
            $req= ($this->bdd)->prepare("INSERT INTO panier(dateCreation ,status,reference,id_user) values(NOW(),0 , ? , ?)");
            $req->execute(array( $reference,$id ));
            $id = ($this->bdd) ->lastInsertId();
            if($id>0){
                echo "le panier est bien cree";
                header("location: http://localhost/glace/index.php");
            }else{
                echo "nonnnn";
            }
        }           
    }     
    /**
     * une fonction qui teste si l'utilisateur a dejà un
     * instancier un panier 
    */
    public function EqualUsersPanier()
    {       
            if(!isset($_SESSION)){
            session_start();
            }
            $id_userDB = 0;
            $id_user =  $_SESSION["id"];
            $req=($this->bdd)->prepare("SELECT id_user , status  FROM panier where id_user = ? AND status != 1   ");
            $req->execute(array($id_user));
            $data = $req->fetchAll(PDO::FETCH_ASSOC);
            foreach($data as $value){
                $id_userDB = $value["id_user"];
            }
        return   $id_userDB  ;
    }
     /**
     * Comparaison des refernce panier 
    */
    public function equalReference($par = NULL ){
        if(!isset($_SESSION)){
            session_start();
        }
        $id = $_SESSION["id"];
        $id_sessiondb = $this->EqualUsersPanier();
        if(is_null($par)){
            $code = $this->GenereCode("fffff");
        }else{
            $code = $this->GenereCode();  
        }
        $req = ($this->bdd)->query("SELECT reference FROM panier ");
        $data=$req->fetchAll(PDO::FETCH_ASSOC);
        $control = "";
        $ref="";
        foreach($data as $value)
        {
            $ref = $value["reference"];
            if($ref== $code)
            {
            $control=1;
            
            }
        }
        if($control !=1){
            if($id != $id_sessiondb){
                $this->creePanier($code);
                header("location: http://localhost/glace/index.php");
            }
         }else{
           
           //$this->equalReference("kk"); 
        }
    }

    /**
     * Creer un panniercompo
    */
    public function addPanierCompo($qt , $idpanier , $idproduit , $prix ){
        $req= ($this->bdd)->prepare("INSERT INTO  paniercompo(quantite ,prix , idpanier , idproduit )
        values(?,?,?,?) ");
        $req->execute(array($qt , $prix , $idpanier , $idproduit));
        $id = ($this->bdd) ->lastInsertId();
        if($id>0){
            echo "le produit est ajouter au panier";
        }else{
            echo "nonnnnnnn"; 
        }

    }

    /**
     * List des panier 
    */

    public function ListPanierUser($iduser){
      $req = ($this->bdd)->prepare(" SELECT * FROM paniercompo , panier , produit , user where paniercompo.idpanier = panier.id
      AND    paniercompo.idproduit =produit.idproduit AND panier.id_user = user.id
      AND    panier.id_user = ?
       ");
      $req->execute(array($iduser));
      $data = $req ->fetchAll(PDO::FETCH_ASSOC);
      return $data;
    }

    /**
     * Recuperation idpanier 
    */
    public function Idpanier($id , $iduser){
        //ici je recupere id panier de l'utilisateur 
        //connecte 
        $req = ($this->bdd) ->prepare("SELECT id , id_user   FROM panier where panier.id = ? AND panier.id_user = ?");
        $req->execute(array($id , $iduser));
        $data = $req->fetch();
        return $data;
    }
    
    /**
     * Delete panier compo 
    */

    public function deleteCompo($id){
        $req=($this->bdd)->prepare("DELETE FROM  paniercompo where idcompo = ?");
        $req->execute(array($id));
    }

    /**
     * Update commande compo 
     */

     public function Update($qt , $idcompo ){
         $req = ($this->bdd)->prepare("UPDATE paniercompo SET quantite = ?  WHERE idcompo = ? ");
         $req->execute(array($qt,$idcompo));
     }

    /**
      * valider panier 
    */
    public function validerpanier($status , $idpanier , $iduser ){
        $req = ($this->bdd)->prepare("UPDATE panier SET  status = ? WHERE id = ? ");
        $req->execute(array($status,$idpanier)); 
    }
    /**
     * tester si le produit est dejà ajouter dans le panier 
    */
    public function SelectProduit($id)
    {
     $req=($this->bdd)->prepare("SELECT * FROM produit where idproduit = ?");
        $req->execute(array($id));
        $data = $req->fetchAll(PDO::FETCH_ASSOC);
        $count = $req->rowCount();
        if($count > 1 ){
            echo "le produit est dejà selectionne .... ";
        }else{
            echo "le produit est dejà ajouter au panier ... ";
        }
        return $data;
    }

    /**
     * recuperation idpanier de l'utilisateur connecté 
    */
    public function idpanierUser($iduser){
        $idpanier = 0;
        $req=($this->bdd)->prepare("SELECT * from panier where panier.id_user = ? AND status != 1  ");
        $req->execute(array($iduser));
        $data= $req->fetchAll(PDO::FETCH_ASSOC);
        $count = $req->rowCount();
        if($count==1) {
           foreach($data as $value)  {
            $idpanier = $value["id"]; 
            var_dump($idpanier); 
           }
        }
        return $idpanier;
    }

    
   

}
?>