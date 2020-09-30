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
      if ( !isset($_GET['idattr']) ) {
        echo '<script> document.location.href = \'users.php\'; </script>';
        die();
      }
      
      $pseudo ='';
      $date_heure;
      $date = '';
      $heure_debut;
      $duration;
      $ordID;
      $ordName;
      $res = ListerReservationById($con, $_GET['idattr']);
      foreach ($res as $ligne){
        $date_heure = $ligne['date'];
        $duration = $ligne['duration'];
        $ordID = $ligne['reford'];
        $pseudo = $ligne['pseudo'];
      }
      for ($i=0; $i<=9; $i++ ) {
        $date = $date . $date_heure[$i];
      }
      $heure_debut = $date_heure[11]. $date_heure[12];
      $ordName = listerOrdinateursById($con, $ordID)[1];
      //echo $ordName;
      echo '<br> mofication de la reservation n° ' . $_GET['idattr'] . "pseudo = " . $pseudo;
      echo '<h3> modifier : </h3>
        <form method="POST">
            <p>date : <input type="date" name="P_mod-date" value ="' . $date . '"> </p>
            <p> à : <select name="P_Hdeb" class="form-control">';
            
            for ($i=7; $i < 19 ; $i++) { 
              echo '<option ';
              if ($i == $heure_debut) {
                echo 'selected';
              }
              
              echo' >'. $i .'</option> ';
            }
            echo '</select>
            <p>durée : <input type="number" name="P_mod-duration" value="'.$duration.'"> 
            </p> 
            <p>Ordinateurs :  </p> <select name="P_mod-ord" class="form-control" value=""> </p>';

            $res = listerOrdinateurs($con);
            foreach ($res as $ligne) {
              echo '<option ';
              if ($ligne['nom'] == $ordName) {
                echo 'selected';
              }
              
              echo '>'. $ligne['nom'] .'</option> ';
            }
            echo ' </br>
              <input name="P_mod-submit" type="submit" class="btn btn-warning" value="Modifier">
            </form>


            <button onclick="window.location.href =\'?suppr=1&idattr='. $_GET['idattr'] .'\'" type="button" class="btn btn-danger">Supprimer</button>
      ';





      //rebouclage

      //suppression
      if ( isset($_GET["suppr"])){
        echo 'suppression de la reservation...';
        SupprimerAttribution($con ,  $_GET['idattr'] ) ;
        echo ' <script> document.location.href = \'administration.php\'; </script>'; //pour enleever les "?user=XX"
      }


      //modification
      if (isset($_POST['P_mod-submit'])){
        $res = ListerReservationById($con, $_GET['idattr']);
        if ( isset($_POST['P_mod-date']) ){
          $date = $_POST['P_mod-date'];
        }
        if ( isset($_POST['P_mod-duration']) ){
          $duration = $_POST['P_mod-duration'];
        }
        if ( isset($_POST['P_mod-ord']) ){
          $ordID = GetOrdIdByName($con, $_POST['P_mod-ord'])[0];
        }
        $res = ListerAttribuer($con);
        if ( $_POST['P_Hdeb'] + $_POST['P_mod-duration'] >= "19" ) {
          echo '<div class="alert alert-danger" role="alert"> Reservation hors horraire d\'ouverture (7H-19H), veuillez ré-essayer</div>';
        }
        else {
          $date = $date . ' ' . $_POST['P_Hdeb'] . ':00:00';
          $isOk=true;
          $res = ListerAttribuerByOrd($con, $_POST["P_mod-ord"]);
          
          foreach ($res as $ligne){
            if ($ligne['idattr'] != $_GET['idattr']){
            
              $moisDB = $ligne['date'][5] . $ligne['date'][6];
              $jourDB = $ligne['date'][8] . $ligne['date'][9];
              $heureDB = $ligne['date'][11] . $ligne['date'][12];
              if ( $moisDB == $date[5].$date[6] ) {
                if ( $jourDB == $date[8].$date[9] ) {
                  if ( ($heureDB <= $_POST['P_Hdeb'] && $heureDB + $ligne['duration'] > $_POST['P_Hdeb'] ) || ($heureDB >= $_POST['P_Hdeb'] && $heureDB < $_POST['P_Hdeb'] + $_POST['P_mod-duration']) ) {
                    echo 'Plage Horraire déjà utilisé par cet ordinateur';
                  
                    $isOk=false;
                    break;
                    
                  }
                }
            
              }
            }
            
          }
          if ($isOk) {
            AttribuerUpdate($con, $_GET['idattr'], $ordID, $date, $duration);
            echo ' <script> document.location.href = \'administration.php\'; </script>';
          }
        
        }
      } //echo ' <script> document.location.href = \'XX.php\'; </script>';
    ?>


    





    
  </div>

  <?php include('./php/footer.php');?>
</body>

</html>