<?php

//ATTRIBUER

function ListerAttribuer($connex)
{
    $sql = "SELECT ATTRIBUER.idattr, ATTRIBUER.date, ATTRIBUER.duration, USERS.pseudo, ORDINATEURS.nom FROM ATTRIBUER INNER JOIN USERS ON refuser=iduser INNER JOIN ORDINATEURS ON reford=idord order by idattr DESC; ";
    $res = $connex->query($sql);
    return $res;
}

function ListerAttribuerByOrd($connex, $ord){
    $sql = "SELECT ATTRIBUER.idattr, ATTRIBUER.date, ATTRIBUER.duration, USERS.pseudo, ORDINATEURS.nom FROM ATTRIBUER INNER JOIN USERS ON refuser=iduser INNER JOIN ORDINATEURS ON reford=idord WHERE ORDINATEURS.nom='". $ord ."'; ";
    $res = $connex->query($sql);
    return $res;
}

function ListerReservationById($connex, $id){
    $sql = "SELECT ATTRIBUER.idattr, ATTRIBUER.date, ATTRIBUER.duration, ATTRIBUER.reford, USERS.pseudo, ORDINATEURS.nom  FROM ATTRIBUER INNER JOIN USERS ON refuser=iduser INNER JOIN ORDINATEURS ON reford=idord WHERE ATTRIBUER.idattr='". $id ."'; ";
    $res = $connex->query($sql);
    return $res;
}

function ListerReservationByUser($connex, $pseudo){
    $sql = "SELECT ATTRIBUER.idattr, ATTRIBUER.date, ATTRIBUER.duration, USERS.pseudo, ORDINATEURS.nom FROM ATTRIBUER INNER JOIN USERS ON refuser=iduser INNER JOIN ORDINATEURS ON reford=idord WHERE USERS.pseudo='". $pseudo ."'; ";
    $res = $connex->query($sql);
    return $res;
}


function AttribuerUpdate($connex,$id, $idord, $date, $duration){

    $sql = "UPDATE ATTRIBUER SET ATTRIBUER.date = '". $date ."', ATTRIBUER.duration = ". $duration .", ATTRIBUER.reford = '". $idord ."' WHERE idattr =".$id."; ";
    $res = $connex->query($sql);
    return $res;
}

function AjouterAttribuer($connex, $refuser, $reford, $date, $duration){
    $sql = "INSERT INTO ATTRIBUER (RefUser , RefOrd , Date , Duration) VALUES ('" . $refuser ."','".$reford."','".$date."','".$duration."')";
    $res = $connex->query($sql);
    return $res;
}


function SupprimerAttribution($connex , $id){
    $sql = "DELETE FROM ATTRIBUER WHERE idattr=". $id .";";
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

function GetUserIdByPseudo($connex, $pseudo){
    $sql = "SELECT * FROM USERS WHERE USERS.pseudo ='".$pseudo."';";
    $prep = $connex->query($sql);
    $res = $prep->fetch(PDO::FETCH_NUM); //pour avoir un tableau
    return $res;
}


function UserUpdate($connex,$id, $pseudo, $age, $mail){
    $sql = "UPDATE USERS SET pseudo = '". $pseudo ."', age = ". $age .", email = '". $mail ."' WHERE iduser =".$id."; ";//echo $sql;
    $res = $connex->query($sql);
    return $res;
}

function listerUsers($connex){
    $sql = "SELECT iduser, pseudo, nom, prenom, age, email FROM USERS order by iduser";
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
    $sql = "INSERT INTO ORDINATEURS (nom) VALUES ('" . $nom ."')";
    $res = $connex->query($sql);
    return $res;
}


function SupprimerOrdinateur($connex, $nom){
    $sql = "DELETE FROM ORDINATEURS WHERE ORDINATEURS.nom = '".$nom . "';";
    $res = $connex->query($sql);
    return $res;
}


function listerOrdinateurs($connex){
    $sql = "SELECT idord, nom FROM ORDINATEURS order by idord";
    $res = $connex->query($sql);
    return $res;
}


function listerOrdinateursById($connex, $id){
    $sql = "SELECT idord, nom FROM ORDINATEURS WHERE idord='". $id ."';" ;
    $prep = $connex->query($sql);
    $res = $prep->fetch(PDO::FETCH_NUM); //pour avoir un tableau
    return $res;
}


function GetOrdIdByName($connex, $nom){
    $sql = "SELECT idord FROM ORDINATEURS WHERE ORDINATEURS.nom ='".$nom."';";
    $prep = $connex->query($sql);
    $res = $prep->fetch(PDO::FETCH_NUM); //pour avoir un tableau
    return $res;
}

function OrdinateurRecherche($connex, $chaine){
    $sql="SELECT idord, nom FROM ORDINATEURS WHERE nom LIKE '%". $chaine ."%';";
    $result=$connex->query($sql);
    return $result;
}

function OrdinateurUpdate($connex, $id, $nom){
    $sql = "UPDATE ORDINATEURS SET nom = '". $nom ."' WHERE idord =". $id ."; ";
    //echo $sql;
    $res = $connex->query($sql);
    return $res;
}


//CONNEXION
function listerConnexionByPass($connex, $pass) {
    $sql="SELECT * FROM CONNEXION WHERE password=? ;";
    $res=$connex->prepare($sql);
    $res->execute(array($pass));
    return $res;
}



?>