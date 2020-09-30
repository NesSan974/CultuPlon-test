<?php

require_once("./bdd/connexion.php");
require("./bdd/fonctionBDD.php");
$con = connexionBDD();

?>


<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>CultuPlon - Connexion</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
  <meta name="author" content="">
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link href="css/style.css" rel="stylesheet">
</head>

<body>
	<?php include('./php/header.php'); ?>

	<?php
		if ( isset($_SESSION['c']) ) {
			echo '<script>document.location.href = \'administration.php\' </script> ';
		}
	?>

	<div class="section">

	<form method="POST">
		<div class="form-group">
			<label>Pseudo </label>
			<input name="P_pseudo" type="text" class="form-control" aria-describedby="emailHelp">
			<!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
		</div>
		<div class="form-group">
			<label>Mot de passe </label>
			<input name="P_pass" type="password" class="form-control">
		</div>
		<button type="submit" class="btn btn-primary">Connexion</button>
	</form>


	<?php
	if ( ( isset($_POST['P_pseudo']) && trim( $_POST['P_pseudo'] ) != '' ) &&  ( isset($_POST['P_pass']) && trim ( $_POST['P_pass'] ) != '' ) ) {
		
		$_SESSION['c'] = hash("sha256", "non");
		

		// $s = $_POST['P_pseudo'] . ':' . hash("sha256", $_POST['P_pass'] );
		// echo $s . '<br>';

		//hash js

		$s = hash ("sha256", $_POST['P_pseudo'] . ":" . hash("sha256", $_POST['P_pass'] ) ) ; // sha256 ( pseudo:sha256(password) )

		// echo ' pseudo : '.hash ("sha256", $_POST['P_pseudo']) . '<br>';
		// echo 'mdp : ' . hash("sha256", $_POST['P_pass'] ). '<br>';

		$res = listerConnexionByPass($con, $s);
		// echo $s;


		if ($res->rowCount () == 1) {
			$_SESSION['c'] = $s;
			echo '<script>document.location.href = \'administration.php\' </script> ';
		}else{
			session_destroy();
			echo '<script>document.location.href = \'index.php\' </script> ';
		}

	}
	
	?>

</div>

<?php include('./php/footer.php');?>

</body>

</html>