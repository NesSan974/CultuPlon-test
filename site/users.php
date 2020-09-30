<?php

require_once("./bdd/connexion.php");
require("./bdd/fonctionBDD.php");
$con = connexionBDD();

?>

<!DOCTYPE html>
<html>

  <head>
    <meta charset="utf-8">
    <title>CultuPlon - Administration</title>
    <meta name="author" content="">
    <meta name="description" content="">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="css/style.css" rel="stylesheet">
  </head>

  <body>
    <?php include('./php/header.php'); ?>
    <div class="section">

    <?php include ('./php/nav.php');?>


      <h1> Utilisateurs </h1>


      <h3>Nouvel utilisateur</h3>
      <div class= "adduser">
        <form method="POST">
              <p> nom :<input type="text" name="P_new-nom" placeholder="Ex : Durand.."> </p>
              <p>prenom : <input type="text" name="P_new-prenom" placeholder=" Ex : Rose.."> </p>
              <p>pseudo : <input type="text" name="P_new-pseudo" placeholder="Ex : DRose.."> </p>
              <p>age : <input type="number" name="P_new-age"> 
              <p>mail : <input type="text" name="P_new-mail">
            </br>
            <input name="P_new-submit" type="submit" class="btn btn-success" value="Ajouter/Créer"> 
        </form>
      </div>

      <?php

        //--new user

        if (isset($_POST['P_new-submit'])) {

          if ( $_POST['P_new-nom'] !='' && $_POST['P_new-prenom'] !='' && $_POST['P_new-pseudo'] !='' && $_POST['P_new-age'] !='' && $_POST['P_new-mail'] !='') {
            AjouterUser($con, $_POST['P_new-nom'], $_POST['P_new-prenom'], $_POST['P_new-pseudo'], $_POST['P_new-age'], $_POST['P_new-mail']);
            echo ' <div class="alert alert-success" role="alert">  Ajout de '.$_POST['P_new-pseudo'].' reussi </div>';
          }

          //message d'erreur approprié

          if ($_POST['P_new-nom'] =='') {
            echo '<div class="alert alert-danger" role="alert"> Veuillez renseigner un nom </div>';
          }

          if ($_POST['P_new-prenom'] == '' ) {
            echo '<div class="alert alert-danger" role="alert"> Veuillez renseigner un prenom </div>';
          }

          if ($_POST['P_new-pseudo'] == '' ) {
            echo '<div class="alert alert-danger" role="alert"> Veuillez renseigner un pseudo </div>';
          }

          if ($_POST['P_new-age'] == '' ) {
            echo '<div class="alert alert-danger" role="alert"> Veuillez renseigner un age </div>';
          }

          if ($_POST['P_new-mail'] == '' ) {
            echo '<div class="alert alert-danger" role="alert"> Veuillez renseigner une addresse mail </div>';
          }
          
        }

      ?>


      <form class="search" method="POST" action="users.php">
          <input type="text" name="rechercheUser" placeholder="Rechercher Pseudo"> 
          <input type="submit" name="P_submitsearch" class="btn btn-primary" value=" Go ! ">
      </form>


      <?php




    if ( !isset($_POST['rechercheUser']) && !isset($_GET['modif']) && !isset($_GET['suppr']) ) {
    
      $res = listerUsers($con);
      echo '<div class="container">';
        foreach ($res as $ligne) {

          echo '
          
            
              <div class="row">
                <div class="col">'
                  . $ligne["nom"] .
                '</div>
                <div class="col">'
                  . $ligne["prenom"] .
                '</div>
                <div class="col">'
                  . $ligne["pseudo"] .
                '</div>
                <div class="col">
                  <button onclick="window.location.href = \'?modif=1&user='. $ligne["pseudo"] .'\'" type="button" class="btn btn-warning">Modifier</button>
                </div>
                <div class="col">
                  <button onclick="window.location.href = \'reservation.php?user='. $ligne["pseudo"] . '\'" type="button" class="btn btn-info">Voir reservation</button>
                </div>
                <div class="col">
                 <button onclick="window.location.href = \'?suppr=1&user='. $ligne["pseudo"] .'\'" type="button" class="btn btn-danger">Supprimer</button><br>
                </div>


              </div>
            
          
          ';
                // echo '<button onclick="window.location.href = \'?modif=1&user='. $ligne["pseudo"] .'\';" type="button" class="btn btn-warning">Modifier</button>' ;
                // echo '<button onclick="window.location.href = \'reservation.php?user='. $ligne["pseudo"] . '\';" type="button" class="btn btn-info">Voir reservation</button>';
                // echo '<button onclick="window.location.href = \'?suppr=1&user='. $ligne["pseudo"] .'\';" type="button" class="btn btn-danger">Supprimer</button><br>';
        }
      echo' </div>';
    }



      //rebouclage

      //--recherche

      if ( isset($_POST['rechercheUser']) ) {
        $res = UsersRecherche($con, $_POST['rechercheUser']);

        echo '<div class="container">';
        foreach ($res as $ligne) {

          echo '
          
            
              <div class="row">
                <div class="col">'
                  . $ligne["nom"] .
                '</div>
                <div class="col">'
                  . $ligne["prenom"] .
                '</div>
                <div class="col">'
                  . $ligne["pseudo"] .
                '</div>
                <div class="col">
                  <button onclick="window.location.href = \'?modif=1&user='. $ligne["pseudo"] .'\';" type="button" class="btn btn-warning">Modifier</button>
                </div>
                <div class="col">
                  <button onclick="window.location.href = \'reservation.php?user='. $ligne["pseudo"] . '\';" type="button" class="btn btn-info">Voir reservation</button>
                </div>
                <div class="col">
                 <button onclick="window.location.href = \'?suppr=1&user='. $ligne["pseudo"] .'\';" type="button" class="btn btn-danger">Supprimer</button><br>
                </div>


              </div>
            
          
          ';
                // echo '<button onclick="window.location.href = \'?modif=1&user='. $ligne["pseudo"] .'\';" type="button" class="btn btn-warning">Modifier</button>' ;
                // echo '<button onclick="window.location.href = \'reservation.php?user='. $ligne["pseudo"] . '\';" type="button" class="btn btn-info">Voir reservation</button>';
                // echo '<button onclick="window.location.href = \'?suppr=1&user='. $ligne["pseudo"] .'\';" type="button" class="btn btn-danger">Supprimer</button><br>';
        }
      echo' </div>';


      }



      //--suppresion user

      if( isset( $_GET['user'])){

        if ( isset($_GET["suppr"])){
          echo 'suppression de ' . $_GET['user']. '...';
          SupprimerUser($con,$_GET["user"]);
          echo ' <script> document.location.href = \'users.php\'; </script>'; //pour enleever les "?user=XX"
        }

      //--modification user
         else if ( isset( $_GET['modif']) ){
          echo 'modification de <h4>'. $_GET['user'] . '</h4>';

          echo '<button onclick="window.location.href = \'reservation.php?user='. $_GET['user'] . '\';" type="button" class="btn btn-info">Voir reservation</button>';

          $pseudo;
          $age;
          $mail;

          $res = GetUserIdByPseudo($con, $_GET['user']);
          $pseudo = $res[3];
          $age = $res[4];
          $mail = $res[5];
          
          echo '<h3>actuellement :</h3> ';
          echo '<div class="container">';
      
            echo'
            <div class="col">
              pseudo : '
              . $pseudo .
            '</div>
            ';
            echo'
            <div class="col">
              age : '
              . $age .
            '</div>
            ';

            echo'
            <div class="col">
              e-mail : '
              . $mail .
            '</div>
            ';

          echo' </div>';
            


          //echo ' <script> document.location.href = \'users.php\'; </script>';
          echo '<h3 modifier :</h3>

            <form method="POST">
                  <p>pseudo : <input type="text" name="P_mod-pseudo"> </p>
                  <p>age : <input type="text" name="P_mod-age"> 
                  <p>mail : <input type="text" name="P_mod-mail">
                </br>
                <input name="P_mod-submit" type="submit" class="btn btn-warning" value="Modifier"> 
            </form>
          ';

          if (isset($_POST['P_mod-submit'])) {

            if (isset($_POST['P_mod-pseudo']) && trim( $_POST['P_mod-pseudo'] != '') ){
              $pseudo = $_POST['P_mod-pseudo'];
            }
            if (isset($_POST['P_mod-age']) && trim( $_POST['P_mod-age'] != '') ){
              $age = $_POST['P_mod-age'];
            }
            if (isset($_POST['P_mod-mail']) && trim( $_POST['P_mod-mail'] != '')){
              $mail = $_POST['P_mod-mail'];
            }
              
              UserUpdate($con,$res[0], $pseudo, $age, $mail);

              echo ' <script> document.location.href = \'users.php\'; </script>';

          }

        }
      }
      ?>



    </div>

    <?php include('./php/footer.php');?>
  </body>

</html>