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
        $login_ftp=getenv('LOGIN_FTP');;
        $mp_ftp=getenv('MP_FTP');


        $conn_id = ftp_connect($serveur_ftp, 21) or die ('Connection impossible<br />');

        $login_result = ftp_login($conn_id, $login_ftp, $mp_ftp) or die ('identifiants impossible<br />');

        ftp_pasv($conn_id, true);

        $file_ftp="statement.htm";
        $chemin_extraction= "data/";

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

        $tradesByDays = [];

        foreach($data as $key => $trade)
        {

            if(count($trade) === 2)
            {
                $time = strtotime(substr($trade['date'], 11));
                $timeLessOneH = date("H:i:s", strtotime('-1 hours', $time));

                $tradesByDays[date("d-m-Y", strtotime(str_replace(".", "/", substr($trade['date'], 0,10))))]['trades'][$timeLessOneH][] = $trade['profit'];
                $date = $trade['date'];

            }
        }

        foreach($tradesByDays as $date => $oneDay)
        {
            $result = 0;
            $numberofTrade = 0;

            foreach($oneDay as $tradesValue)
            {
                foreach($tradesValue as $trades) {
                    foreach($trades as $trade) {
                        $result += $trade;
                        $numberofTrade += 1;
                    }
                }
            }

            $commission = -($numberofTrade * 0.10);

            $tradesByDays[$date]["profit"] = $result;
            $tradesByDays[$date]["commission"] = $commission;
            $tradesByDays[$date]["profit_total"] = $result + $commission;

            foreach($tradesByDays as $date => $trades)
            {
                if(date('Y', strtotime($date)) !== date('Y'))
                {
                    unset($tradesByDays[$date]);
                }
            }
        }

        return view('index', ['data' => $tradesByDays]);
    }
}
