<?php
if (isset($_SESSION['c'])) {
  echo '
  <div class="btn-group" role="group">
    
  <button onclick="window.location.href = \'deconnexion.php\' " type="button" class="btn btn-danger">se deconnecter</button>

</div>
  
  ';
}
?>



<div class="footer">
<p>&copy; 2020 CultuPlon<p>
</div>