<?php

function connexionBDD(){
 
    include("paramCon.php");
    
    $dsn='mysql:host='.$lehost.';dbname='.$dbname;

    try { 
        $connex = new PDO($dsn, $user, $pass); 
        //echo "bdd oui";
        
    } catch (PDOException $e) {
        //echo "bdd non";        
        die();
    }

    return $connex;
    
}


function deconnexionBDD($connex){
    $connex = null;
}

?>