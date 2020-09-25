<?php

//ATTRIBUER

function ListerAttribuer($connex)
{
    $sql = "SELECT ATTRIBUER.idattr, ATTRIBUER.date, ATTRIBUER.duration, USERS.pseudo, ORDINATEURS.nom FROM ATTRIBUER INNER JOIN USERS ON refuser=iduser INNER JOIN ORDINATEURS ON reford=idord order by idattr; ";
    $res = $connex->query($sql);
    return $res;
}

function AjouterAttribuer($connex, $refuser, $reford, $date, $duration){
    $sql = "INSERT INTO USERS(RefUser , RefOrd , Date , Duration) VALUES ('" . $refuser ."','".$reford."','".$date."','".$duration."')";
    $res = $connex->query($sql);
    return $res;
}


//USERS

function AjouterUser($connex, $nom, $prenom, $pseudo, $age, $mail)
{
    $sql = "INSERT INTO USERS(nom, prenom, pseudo, age, email) VALUES ('" . $nom ."','".$prenom."','".$pseudo."','".$age."','".$mail."')";
    $res = $connex->query($sql);
    return $res;
}

function SupprimerUser($connex, $pseudo){
    $sql = "DELETE FROM USERS WHERE USERS.pseudo ='".$pseudo."';";
    $res = $connex->query($sql);
    return $res;
}

function listerUsers($connex){
    $sql = "SELECT * FROM USERS order by iduser";
    $res = $connex->query($sql);
    return $res;
}

function UsersRecherche($connex, $chaine){
    $sql="SELECT iduser, pseudo, prenom, nom FROM USERS WHERE pseudo LIKE '%". $chaine ."%'  ORDER BY pseudo ;";
     // permet de rechercher un client dont le pseudo contient la chaine envoyé
    //"like" permet de mettre un model. %-> remplace une chaine de carac (meme vide) / _-> remplace un carac. ex: _oi -> loi/toi/roi... | %et -> Rejet/Regret/et/sommet..
    $result=$connex->query($sql);
    return $result;
}


//ORDINATAEURS
function AjouterOrdinateur($connex, $nom)
{
    $sql = "INSERT INTO USERS(nom) VALUES ('" . $nom ."')";
    $res = $connex->query($sql);
    return $res;
}


function SupprimerOrdinateur($connex, $nom){
    $sql = "DELETE FROM ORDINATEURS WHERE ORDINATEURS.nom =".$nom;
    $res = $connex->query($sql);
    return $res;
}

function listerOrdinateurs($connex){
    $sql = "SELECT * FROM ORDINATEURS order by idord";
    $res = $connex->query($sql);
    return $res;
}



function OrdinateurRecherche($connex, $chaine){
$sql="SELECT idord, nom FROM ORDINATEURS WHERE nom LIKE '%". $chaine ."%';";
    $result=$connex->query($sql);
    return $result;
}


?>