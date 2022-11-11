<?php

$serveur_ftp="ftpupload.net";
$login_ftp="b7_32978788";
$mp_ftp="Spectre2014";

$conn_id = ftp_connect($serveur_ftp, 21) or die ('Connection impossible<br />');

$login_result = ftp_login($conn_id, $login_ftp, $mp_ftp) or die ('identifiants impossible<br />');

// Vérification de la connexion
if ((!$conn_id) || (!$login_result)) {
    echo "La connexion FTP a échoué !";
    echo "Tentative de connexion au serveur scola.legtux.org pour l'utilisateur scola";
    exit;
} else {
    echo "Connexion au serveur " .$serveur_ftp. " pour l'utilisateur ".$login_ftp;
}
ftp_pasv($conn_id, true);

$file_ftp="statement.htm";
$chemin_extraction="C:/wamp/www/mt4/data/";

$status = ftp_get($conn_id, $chemin_extraction.$file_ftp,"./htdocs/data/".$file_ftp, FTP_BINARY);

if($status)
{
    echo "Envoie confirmé";
} else {
   echo  "Erreur";
}
// $ftp = ftp_connect($serveur_ftp, 21);
// ftp_login($ftp, $login_ftp, $mp_ftp);


