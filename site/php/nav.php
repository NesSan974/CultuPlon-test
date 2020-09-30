<?php



if ( !isset($_SESSION['c']) ) {
  
  echo '<script>document.location.href = \'index.php\' </script> ';

}
?>


<nav>

    <div class="btn-group" role="group">
      <button onclick="window.location.href = 'users.php';" type="button" class="btn btn-secondary">Utilisateurs</button>
      <button onclick="window.location.href = 'administration.php';" type="button" class="btn btn-secondary">Home</button>
      <button onclick="window.location.href = 'computers.php';" type="button" class="btn btn-secondary">Ordinateurs</button>
    </div>

</nav>