<?php

require_once("./bdd/connexion.php");
require("./bdd/fonctionBDD.php");
$con = connexionBDD();

?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>title</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
  <meta name="author" content="">
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link href="css/style.css" rel="stylesheet">
</head>

<body>
  <?php include('./php/header.php'); ?>

  <div class="section">
    <nav>
      <div class="btn-group" role="group">
        <button onclick="window.location.href = 'administration.php';" type="button" class="btn btn-secondary">Home</button>
        <button onclick="window.location.href = 'computers.php';" type="button" class="btn btn-secondary">Ordinateurs</button>
      </div>
    </nav>

    <h1>Reservation</h1>
    
    <form method="POST">

      <p>Pseudo : <input type="text" name="P_pseudo"> </p>

      <p>Ordinateurs : <input type="text" name="P_ord" placeholder=" Ex : Rose.."> </p>

      <p>date : <input type="date" name="P_date"> 

      <p> pendant : <input type="text" name="P_duration"> Heure(s)</p>
      
      </br>

      <input name="P_new-submit" type="submit" class="btn btn-success" value="Ajouter/Créer"> 
      <!-- <input onclick="window.location.href = 'users.php?';" type="button" class="btn btn-success" value="Ajouter/Créer"> -->
    </form>
    
  


  </div>

  <?php include('./php/footer.php');?>
</body>

</html>