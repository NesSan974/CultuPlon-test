<?php

require_once("./bdd/connexion.php");
$con = connexionBDD();

?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>title</title>
  <meta name="author" content="">
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link href="css/style.css" rel="stylesheet">
</head>

<body>

	<?php include('./php/header.php');?>

	<div class="section">
		
		<h3>Connexion</h3>

		<form method="post"  action="./administration.php">	
			
			<div class="case"> <label for="pseudo">Pseudo : </label> <input name="pseudo" type="text" id="pseudo" /><br /></div>
			<div class="case"> <label for="password">Mot de Passe : </label> <input type="password" name="password" id="password" /></div>
			<input type="submit" name="P_Submit" value="Connexion" />
			
		</form>

	</div>

	<?php include('./php/footer.php');?>
</body>

</html>