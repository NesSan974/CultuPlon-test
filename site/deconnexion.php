<?php

require_once("./bdd/connexion.php");
$con = connexionBDD();

session_destroy();

echo '<script>document.location.href = \'index.php\' </script> ';
?>