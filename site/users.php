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
      <nav>
        <div class="btn-group" role="group">
          <button onclick="window.location.href = 'users.php';" type="button" class="btn btn-secondary">Utilisateurs</button>
          <button onclick="window.location.href = 'administration.php';" type="button" class="btn btn-secondary">Home</button>
          <button onclick="window.location.href = 'computers.php';" type="button" class="btn btn-secondary">Ordinateurs</button>
        </div>
      </nav>


      <h1> Utilisateurs </h1>



      <?php
      if ( !isset($_POST['rechercheUser']) ) {
      ?>

        <h3>Nouvel utilisateur</h3>
        <div class= "adduser">
          <form method="POST">

                <p> nom :<input type="text" name="P_new-nom" placeholder="Ex : Durand.."> </p>

                <p>prenom : <input type="text" name="P_new-prenom" placeholder=" Ex : Rose.."> </p>

                <p>pseudo : <input type="text" name="P_new-pseudo" placeholder="Ex : DRose.."> </p>

                <p>age : <input type="text" name="P_new-age"> 
                
                <p>mail : <input type="text" name="P_new-mail">

              </br>

              <input style="text-align: right;" name="P_new-submit" type="submit" class="btn btn-success" value="Ajouter/Créer"> 
          </form>
        </div>

      <?php
      }
      ?>



      <form class="search" method="POST">
          <input type="text" name="rechercheUser" placeholder="Rechercher"> 
          <input type="submit" name="P_submitsearch" class="btn btn-primary" value=" Go ! ">
      </form>


      <?php

      if ( isset($_POST['rechercheUser']) ) {
        $res = UsersRecherche($con, $_POST['rechercheUser']);

          echo '<table>';
              foreach ($res as $ligne) {
                  echo '<tr>';
                      echo '<td> '. $ligne["nom"] . "</td>";
                      echo '<td> ' . $ligne["prenom"] . '</td>';
                      echo '<td> ' . $ligne["pseudo"] . '</td>';

                      echo '<td> '. '<button onclick="window.location.href = \'?user='. $ligne["pseudo"] .'\';" type="button" class="btn btn-warning">Modifier</button>'. '</td>';
                      echo '<td> '. '<button onclick="window.location.href = \'?suppr=1&user='. $ligne["pseudo"] .' \';" type="button" class="btn btn-danger">Supprimer</button>'. '</td>';
                  echo '</tr>';
              }
          echo '</table>';
      }



      if ( isset($_GET["suppr"]) && isset( $_GET['user']) ){
        echo 'suppre de ' . $_GET['user'];
        SupprimerUser($con,$_GET["user"]);
        
      } else if ( isset( $_GET['user']) ){
        echo 'mofication de '. $_GET['user'];
      }
      ?>









    </div>

    <?php include('./php/footer.php');?>
  </body>

</html>