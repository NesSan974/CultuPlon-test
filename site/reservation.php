<?php

require_once("./bdd/connexion.php");
require("./bdd/fonctionBDD.php");
$con = connexionBDD();

?>


<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>Cultuplon - resa</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
  <meta name="author" content="">
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link href="css/style.css" rel="stylesheet">
</head>

<body>
  <?php include('./php/header.php'); ?>

  <div class="section">

    <?php include ('./php/nav.php');?>

    <?php
      if (!isset($_GET['user'])) {
        echo ' <script> document.location.href = \'users.php\'; </script>';
        die();
      }

      echo 'reservation de '. $_GET['user'];

      echo '<button onclick="window.location.href = \'reserver.php?user='. $_GET['user'] .'\';" type="button" class="btn btn-primary">Nouvelle Reservation</button>';

      
      $res = ListerReservationByUser($con, $_GET['user']);


      foreach ($res as $ligne) {
        
        echo '<h4> no. de resa : ' . $ligne['idattr'] . '</h4>';
        echo '<p> <b>date : </b>'. $ligne["date"];
        echo ' <b>durée de :  </b>' . $ligne["duration"] . 'H';
        echo ' <b>ordi :  </b>' . $ligne["nom"] . ' </p>';
        echo '<button onclick="window.location.href = \'modifReservation.php?idattr='. $ligne['idattr'] .'\';" type="button"  class="btn btn-warning">Modifier</button>';
        echo '<button onclick="window.location.href = \'?suppr=1&idattr='. $ligne['idattr'] .'&user='. $_GET['user'] .'\';" type="button" class="btn btn-danger">Supprimer</button>';
      }



      if ( isset($_GET["suppr"])){
        echo 'suppression de la reservation...';
        SupprimerAttribution($con ,  $_GET['idattr'] ) ;
        echo ' <script> document.location.href = \'users.php\'; </script>'; //pour enleever les "?user=XX"
      }



    ?>


    





    
  </div>

  <?php include('./php/footer.php');?>
</body>

</html>