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


    <h1> Ordinateurs <h1>

    <form class="search" method="post">

      <input type="text" name="P_ordName">
      <input type="submit" class="btn btn-success" value="Ajouter/Créer">

    </form>

    <form class="search" method="POST">
      <input type="text" name="rechercher" placeholder="Rechercher"> 
      <input type="submit" class="btn btn-primary" value=" Go ! ">
    </form>


    <?php





      if (isset($_POST['P_ordName'])) {
        AjouterOrdinateur($con, $_POST['P_ordName']);
      }



      if ( isset($_POST['rechercher']) ) {
        $res = OrdinateurRecherche($con, $_POST['rechercher']);

        echo '<table>';
            foreach ($res as $ligne) {
                echo '<tr>';
                    echo '<td> '. $ligne["nom"] . "</td>";
                    echo '<td> '. '<button onclick="window.location.href = \'?ord='. $ligne["nom"] .'\';" type="button" class="btn btn-warning">Modifier</button>'. '</td>';
                    echo '<td> '. '<button onclick="window.location.href = \'?suppr=1&ord='. $ligne["nom"] .' \';" type="button" class="btn btn-danger">Supprimer</button>'. '</td>';
                echo '</tr>';
            }
        echo '</table>';
      }





      if ( isset($_GET["suppr"]) && isset( $_GET['ord']) ){
        echo 'suppre de ' . $_GET['ord'];
        SupprimerOrdinateur($con, $_GET['ord']);
        echo ' <script> document.location.href = \'computers.php\'; </script>';


      } else if ( isset( $_GET['ord']) ){
        echo 'mofication de '. $_GET['ord'];
      }


    ?>

  </div>


  <?php include('./php/footer.php');?>
</body>

</html>