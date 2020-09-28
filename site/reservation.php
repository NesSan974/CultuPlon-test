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

      echo '<table>';
            foreach ($res as $ligne) {
              
                echo '<tr>';
                    echo '<td>no. de resa : ' . $ligne['idattr'] . '  </td>';
                    echo '<td> date : '. $ligne["date"] . "   </td>";
                    echo '<td> durée de : ' . $ligne["duration"] . 'H  </td>';
                    echo '<td> ordi : ' . $ligne["nom"] . '  </td>';

                    echo '<td> '. '<button onclick="window.location.href = \'?modif=1&idattr='. $ligne['idattr'] .'&user='. $_GET['user'] .'\';" type="button"  class="btn btn-warning">Modifier</button>'. '</td>';
                    echo '<td> '. '<button onclick="window.location.href = \'?suppr=1&idattr='. $ligne['idattr'] .'&user='. $_GET['user'] .'\';" type="button" class="btn btn-danger">Supprimer</button>'. '</td>';

                echo '</tr>';
            }
        echo '</table>';

        //rebouclage

        if( isset( $_GET['idattr'])){

          if ( isset($_GET["suppr"])){
            echo 'suppression de la reservation';
            SupprimerAttribution($con,$_GET['idattr']);
            echo ' <script> document.location.href = \'users.php?user=' . $_GET['user'] . '\'; </script>';
  
          } else if ( isset( $_GET['modif']) ){
            echo 'mofication de la reservation n° ' . $_GET['idattr'];

            $res = ListerAttribuerByOrd($connex, $ord);
            
            $date;
            $duration;
            $ord;
            echo '<h3 modifier :</h3>
            <div class= "modifier">
              <form method="POST">
                    <p>date : <input type="date" name="P_mod-date"> </p>
                    <p>durée : <input type="number" name="P_mod-duration"> 
                    <p>Ordinateurs :  </p> <select name="P_mod-ord" class="form-control">';
        
                    $res = listerOrdinateurs($con);
                    foreach ($res as $ligne) {
                      echo '<option>'. $ligne['nom'] .'</option> ';
                    }
                    echo ' </br>
                  <input name="P_mod-submit" type="submit" class="btn btn-warning" value="Modifier"> 
              </form>
            </div>
            ';
          
            if (isset($_POST['P_mod-submit'])){
              
              if (isset($_POST['P_mod-date']) && $_POST['P_mod-date'] != ''){
                $date = $_POST['P_mod-date'];
              }
              if (isset($_POST['P_mod-duration']) && $_POST['P_mod-duration'] != ''){
                $duration = $_POST['P_mod-duration'];
              }
              if (isset($_POST['P_mod-ord']) && $_POST['P_mod-ord'] != ''){
                $ordID = GetOrdIdByName($con, $_POST['P_mod-ord'])[0];
              }
              
              echo $ordID . ' '. $date . $duration;
              //AttribuerUpdate($con, $_GET['idattr'], $ordID, $date, $duration);



            }  //echo ' <script> document.location.href = \'XX.php\'; </script>';
          }
        }
    ?>


    





    
  </div>

  <?php include('./php/footer.php');?>
</body>

</html>