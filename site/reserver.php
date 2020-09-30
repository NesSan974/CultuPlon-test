<?php

require_once("./bdd/connexion.php");
require("./bdd/fonctionBDD.php");
$con = connexionBDD();

?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>CultuPlon - reserver</title>
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

    <h1>Reservation</h1>
    
    <form method="POST">

      <?php echo '<p>Pseudo : <input type="text" name="P_pseudo" ';           if (isset($_GET['user'])) { echo 'value ="' . $_GET['user'] . '"';  }                  echo ' > </p>'; 
      

      
      echo '<p>Ordinateurs :  </p> <select name="P_ord" class="form-control">';
        
        $res = listerOrdinateurs($con);
          foreach ($res as $ligne) {
            echo '<option>'. $ligne['nom'] .'</option> ';
          }
        
        ?>
      </select>


      <p>date : <input type="date" name="P_date">

      <p> à : <select name="P_Hdeb" class="form-control">
        <?php
        for ($i=7; $i < 19 ; $i++) { 
          echo '<option>'. $i .'</option> ';
        }
        ?>
      </select>
      Heures


    </p>
      
      <p> pendant <input type="number" name="P_duration"> Heure(s)</p>
      
      </br>

      <input name="P_new-submit" type="submit" class="btn btn-success" value="Ajouter/Créer"> 
      <!-- <input onclick="window.location.href = 'users.php?';" type="button" class="btn btn-success" value="Ajouter/Créer"> -->
    </form>
    

    <?php 

        if (isset($_POST["P_new-submit"])) {


          if ($_POST["P_pseudo"] == '' ){
            echo '<div class="alert alert-danger" role="alert"> Veuillez renseigner un pseudo </div>';
          }
          if ($_POST["P_ord"] == '' ){
            echo '<div class="alert alert-danger" role="alert"> Veuillez renseigner un ordinateur </div>';
          }
          
          if ($_POST["P_date"] == '' ){
            echo '<div class="alert alert-danger" role="alert"> Veuillez renseigner une date </div>';
          }
          if ($_POST["P_duration"] == '' ){
            echo '<div class="alert alert-danger" role="alert"> Veuillez renseigner une durée </div>';
          }


            
          
          
          if ($_POST['P_pseudo'] !='' && $_POST["P_ord"] !='' && $_POST["P_date"] !='' && $_POST["P_duration"] !='') {


            $res = ListerAttribuer($con);

            if ( $_POST["P_Hdeb"] + $_POST["P_duration"] > "19" ) {
              echo '<div class="alert alert-danger" role="alert"> Reservation hors horraire d\'ouverture (7H-19H), veuillez ré-essayer</div>';
            }
            
            else {
              $dateqsd = $_POST['P_date'] . ' ' . $_POST['P_Hdeb'] . ':00:00';
              $isOk=true;

              $res = ListerAttribuerByOrd($con, $_POST["P_ord"]);
              
              foreach ($res as $ligne){

                $moisDB = $ligne['date'][5] . $ligne['date'][6];
                $jourDB = $ligne['date'][8] . $ligne['date'][9];
                $heureDB = $ligne['date'][11] . $ligne['date'][12];

                if ( $moisDB == $dateqsd[5].$dateqsd[6] ) {

                  if ( $jourDB == $dateqsd[8].$dateqsd[9] ) {

                    if ( ($heureDB <= $_POST["P_Hdeb"] && $heureDB + $ligne['duration'] > $_POST["P_Hdeb"] ) || ($heureDB >= $_POST["P_Hdeb"] && $heureDB < $_POST["P_Hdeb"] + $_POST["P_duration"]) ) {
                      echo 'Plage Horraire déjà utilisé par cet ordinateur';
                      $isOk=false;
                      break;
                      
                    }
                  }
              
                }
                
              }
            
              if ($isOk) {
              
              $iduser = GetUserIdByPseudo($con, $_POST['P_pseudo']);
              $idord = GetOrdIdByName($con, $_POST['P_ord']);

              AjouterAttribuer($con, $iduser[0], $idord[0], $dateqsd, $_POST["P_duration"]);
              echo ' <script> document.location.href = \'administration.php\'; </script>';
              //echo ' <div class="alert alert-success" role="alert">  Ajout de '.$_POST['P_new-nom'].' '.$_POST['P_new-prenom'].' '.$_POST['P_new-pseudo'].' '.$_POST['P_new-age'].' '.$_POST['P_new-mail'].' </div>';

              }
            
            }

          }
      }

    ?>

  </div>

  <?php include('./php/footer.php');?>
</body>

</html>



<?php



  /*

    premier cas :

    d         d+duration(a) 
    |----------|--------|-------------------|
          |-------------|
        Hdeb       Hdeb+duration(b)


        
        2eme cas :

                d                           d+duration(a)
                |---------------|---------------|
    |---------------------------|------------------------------|
  Hdeb                  Hdeb+duration(b)

  */





?>