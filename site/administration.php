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
        <button onclick="window.location.href = 'computers.php';" type="button" class="btn btn-secondary">Oridnateurs</button>
      </div>
    </nav>
      

    <h1> Pannel d'administration <h1>

    <button onclick="window.location.href = 'reserver.php';" type="button" class="btn btn-primary">Reserver</button>
  

    <h3>Derniere Reservation :</h3>

    <?php

      $att = ListerAttribuer($con);

      $i=0;

      foreach ($att as $ligne)
      {
        $i++;
        echo "<p>" . $ligne["pseudo"] . "  -  " . $ligne["nom"] . ' - ' . $ligne["date"] . $ligne["duration"] ."H <p>";
        if ($i >=5) {
          break;
        }
      }

      echo ' <button onclick="window.location.href = \'attribution.php\';" type="button" class="btn btn-dark">Tout voir</button>';


    ?>

  </div>
  <?php include('./php/footer.php');?>
</body>

</html>