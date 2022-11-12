<?php

namespace App\Http\Controllers;

use App\Models\Argument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MainController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $serveur_ftp="ftpupload.net";
        $login_ftp="b7_32978788";
        $mp_ftp="Spectre2014";

        $conn_id = ftp_connect($serveur_ftp, 21) or die ('Connection impossible<br />');

        $login_result = ftp_login($conn_id, $login_ftp, $mp_ftp) or die ('identifiants impossible<br />');

        // Vérification de la connexion
        if ((!$conn_id) || (!$login_result)) {
            echo "La connexion FTP a échoué !";
            exit;
        } else {
            echo "Connexion au serveur " .$serveur_ftp. " pour l'utilisateur ".$login_ftp;
        }

        ftp_pasv($conn_id, true);

        $file_ftp="statement.htm";
        $chemin_extraction= "data/";

        //echo '<br>' . $chemin_extraction;
        $status = ftp_get($conn_id, $chemin_extraction.$file_ftp,"./htdocs/data/".$file_ftp, FTP_BINARY);

        if($status) {
            echo "<br/>Envoie confirmé<br/>";
        } else {
            echo  "Erreur";
        }

        $file = file_get_contents('data/statement.htm');
        $data = json_decode($file);
        //echo ($file);

        $dom = new \DOMDocument();
        $dom->loadHTML($file);

        $xpath = new \DOMXPath($dom);
        
        //dd($xpath);

        $tbody = $dom->getElementsByTagName('tbody')->item(0);


        foreach ($xpath->query('//table/tr', $tbody) as $key => $tr) {
            if($key === 7) {
                var_dump($tr->nodeValue);
            }
        }

 

        return view('index', ['']);
    }
}