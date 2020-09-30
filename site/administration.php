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
      

    <h1> Pannel d'administration <h1>

    <button onclick="window.location.href = 'reserver.php';" type="button" class="btn btn-primary">Reserver</button>
  

    <h3>Derniere Reservation :</h3>

    <?php

      $att = ListerAttribuer($con);

      $i=0;

      foreach ($att as $ligne)
      {
        $i++;
        echo '<p> <button type="button" onclick="window.location.href = \'users.php?modif=1&user=' . $ligne["pseudo"] . '\';"  class="btn btn-link">' . $ligne["pseudo"] . "</button>  -  " . $ligne["nom"] . ' - ' . $ligne["date"] . ' ' .$ligne["duration"] ."H ";
        echo '<button onclick="window.location.href = \'modifReservation.php?idattr='. $ligne['idattr'] .'\';" type="button" class="btn btn-warning">Modifier</button></p>';
        if ($i >=3) {
          break;
        }
      }

      
      echo ' <button onclick="window.location.href = \'attribution.php\';" type="button" class="btn btn-dark">Tout voir</button>';


    ?>

  </div>
  <?php include('./php/footer.php');?>
</body>

</html>