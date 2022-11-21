<?php

namespace App\Http\Controllers;

use App\Models\Argument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Routing\Redirector;
use Carbon\Carbon;

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
        $file = file_get_contents('data/statement.htm');
        //echo ($file);
        $dom = new \DOMDocument();
        $dom->loadHTML($file);

        $xpath = new \DOMXPath($dom);

        $tbody = $dom->getElementsByTagName('tbody')->item(0);
        $numberOfRow = count($xpath->query('//table/tr', $tbody));
        $label = ['type', 'levier', 'date', 'profit'];
        $data = [];

        foreach ($xpath->query('//table/tr', $tbody) as $line => $tr) 
        {
            if($line >= 7) {
                $count = 0;

                foreach ($xpath->query("td", $tr) as $key => $td) {

                    if($key === 2 || $key === 3 || $key === 8 || $key === 13) {

                        $data[$line][$label[$count]] = $td->nodeValue;
                        $count += 1;
                    }
                }
            }

            if($line === 0) {
                foreach ($xpath->query("td", $tr) as $key => $td) {
                    if($key === 0)  {
                        $account = $td->nodeValue;
                    }

                    if($key === 4) {
                        $time_file_update = $td->nodeValue;


                        $hours = substr($time_file_update, -5);
                        $time_file_update = Carbon::parse($hours)->locale('fr-FR');
                        $time_file_update = ucfirst($time_file_update->getTranslatedDayName('dddd')) ." ".  $time_file_update->translatedFormat('d F | ') . $hours;
                    }
                }
            }

            if(++$line === $numberOfRow) {
                foreach ($xpath->query("td", $tr) as $key => $td) {
                    if($key === 1) {
                        $balance = $td->nodeValue;
                    }

                    if($key === 3) {
                        $free_margin = $td->nodeValue;
                    }
                }
            }


            if(++$line === $numberOfRow) {
                foreach ($xpath->query("td", $tr) as $key => $td) {
                    if($key === 1) {
                        $profit = $td->nodeValue;
                    }                   
                }
            }
        }

        $dataToView = [];
        $dataToView['account'] = $account;
        $dataToView['time_file_update'] = $time_file_update;
        $dataToView['balance'] = $free_margin;
        $dataToView['profit'] = $profit;


        $tradesByDays = [];
        $count = 0;

        foreach($data as $key => $trade)
        {
            if(count($trade) === 4)
            {
                $date = date("d-m-Y", strtotime(str_replace(".", "/", substr($trade['date'], 0,10))));

                $dateVanished = Carbon::parse($date)->locale('fr-FR');
                $dateVanished = ucfirst($dateVanished->getTranslatedDayName('dddd')) ." ".  $dateVanished->translatedFormat('d F | Y');

                $tradesByDays[$date]['date_label'] = $dateVanished;

                $time = strtotime(substr($trade['date'], 11));
                $timeLessOneH = date("H:i:s", strtotime('-1 hours', $time));

                $tradesByDays[$date]['trades'][$timeLessOneH][$count]['profit'] = $trade['profit'];
                $tradesByDays[$date]['trades'][$timeLessOneH][$count]['levier'] = $trade['levier'];
                $tradesByDays[$date]['trades'][$timeLessOneH][$count]['type'] = $trade['type'];

                $count += 1;
            }
        }

        foreach($tradesByDays as $date => $oneDay)
        {
            $result = 0;
            $numberofTrade = 0;

            foreach($oneDay['trades'] as $tradesValue)
            {
                foreach($tradesValue as $trade)
                {
                    $result += floatval($trade['profit']);
                    $numberofTrade += 1;
                }

            }

            $commission = -($numberofTrade * 0.10);
            $tradesByDays[$date]["profit"] = floatval($result);
            $tradesByDays[$date]["commission"] = $commission;
            $tradesByDays[$date]["profit_total"] = $result + $commission;

            foreach($tradesByDays as $date => $trades)
            {
                if(substr($date, -4) !== date('Y'))
                {
                    unset($tradesByDays[$date]);
                }
            }
        }

        $dataToView['tradesByDays'] = $tradesByDays;

        return view('index', ['data' => $dataToView]);
    }

    public static function updateFileMT4()
    {
        $serveur_ftp="ftpupload.net";
        $login_ftp=getenv('LOGIN_FTP');
        $mp_ftp=getenv('MP_FTP');

        $conn_id = ftp_connect($serveur_ftp, 21) or die ('Connection impossible<br />');

        $login_result = ftp_login($conn_id, $login_ftp, $mp_ftp) or die ('identifiants impossible<br />');

        ftp_pasv($conn_id, true);

        $file_ftp="statement.htm";
        $chemin_extraction= "data/";

        $status = ftp_get($conn_id, $chemin_extraction.$file_ftp,"./htdocs/data/".$file_ftp, FTP_BINARY);

        return redirect()->route('index');
    }
}
