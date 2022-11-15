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

        ftp_pasv($conn_id, true);

        $file_ftp="statement.htm";
        $chemin_extraction= "data/";

        //echo '<br>' . $chemin_extraction;
        $status = ftp_get($conn_id, $chemin_extraction.$file_ftp,"./htdocs/data/".$file_ftp, FTP_BINARY);

        $file = file_get_contents('data/statement.htm');
        $data = json_decode($file);
        //echo ($file);

        $dom = new \DOMDocument();
        $dom->loadHTML($file);

        $xpath = new \DOMXPath($dom);
        
        $tbody = $dom->getElementsByTagName('tbody')->item(0);

        $label = ['date', 'profit'];
        $data = [];
        
        foreach ($xpath->query('//table/tr', $tbody) as $line => $tr) {
            if($line >= 7) {
                $count = 0;

                foreach ($xpath->query("td[@class]", $tr) as $key => $td) {
                    if($key === 2 || $key === 6) {
                        $data[$line][$label[$count]] = $td->nodeValue;
                        $count += 1;
                    }
                }
            }
        }

        $tradesByDay = [];

        foreach($data as $key => $trade)
        {                
            $randomNumber = rand(1,60);

            if(count($trade) === 2) 
            {
                $time = substr($trade['date'], 11);
                $tradesByDay[date("d-m-Y", strtotime(str_replace(".", "/", substr($trade['date'], 0,10))))][date('H:i:s', strtotime($time."+$randomNumber seconds"))] = $trade['profit'];
            }
        }

        foreach($tradesByDay as $date => $oneDay)
        {
            $result = 0;

            foreach($oneDay as $tradeValue) 
            {
                $result += $tradeValue;
            }

            $tradesByDay[$date]["Profit"] = $result;
            $tradesByDay[$date]["Commission"] = -(count($oneDay) * 0.10);
            $tradesByDay[$date]["Profit total"] = $result - (count($oneDay) * 0.10);


        }
       dd($tradesByDay);

        return view('index', ['data' => $tradesByDay]);
    }
}