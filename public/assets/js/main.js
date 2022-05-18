$(document).ready(function() {

$("#connexion").on("click" , function(e){
    e.preventDefault();
    var email = $("#email").val();
    var password = $("#pwd").val();
    //apel ajax 
    if(email=="" && password==""){
      alert("remplir les champs ...")
    }else{
      $.ajax({
        type:"POST",
        url :"http://localhost/glace/src/Controller/Connexion.php",
        data : 
        {
          action : "login_user" ,
          email : email,
          password:password
        },
        dataType: "html",
        cache: false,
        success: function(response){
          if(response=="success"){
            alert("okkkkkk");
           window.location.href="http://localhost/glace/index.php";
          }else{
            alert("les identifiants sont incorrectes h ");
          }
        }
  
  
      })
    }
   
  })
})
 
// // //traitement du formulaire de connexion 
// // function login_user(){
// //   var email = $("#email").val();
// //   var password = $("#password").val();
// //   if(email !="" && password != ""){
// //     //je fais un appel ajax 
// //     $.ajax({
// //       type:"POST", 
// //       url : "./../../../src/Controller/Connexion.php", 
// //       data : {
// //         action : "login_user" ,
// //         email : email,
// //         password:password
// //       },
// //       dataType: "html",

// //       success : function(response){
// //         //si le reponse est success
// //         if(response=="success"){
// //           alert("kkkkkkkkk");
// //           window.location.href = "";
// //         }else{
// //           alert("nonnnnnn");
// //         }
// //       }
// //     })

// //   }else{
// //     alert("saisir les identifiants");
// //   }
// // }
  
// });
