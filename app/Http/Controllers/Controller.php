<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Artisan;
use Carbon\Carbon;

use App\Models\TradeClose;
use App\Models\TradeOpen;
use App\Models\Day;
use App\Models\Account;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public static function updateFileMT4()
    {
        $serveur_ftp="ftpupload.net";
        $login_ftp=getenv('LOGIN_FTP');
        $mp_ftp=getenv('MP_FTP');

        $conn_id = ftp_connect($serveur_ftp, 21) or die ('Connection impossible<br />');
        ftp_login($conn_id, $login_ftp, $mp_ftp) or die ('identifiants impossible<br />');

        ftp_pasv($conn_id, true);

        $file_ftp="statement.htm";
        $chemin_extraction= "data/";

        $status = ftp_get($conn_id, $chemin_extraction.$file_ftp,"./htdocs/".$file_ftp, FTP_BINARY);

        if($status) {
            Controller::updateDatasTable();
        }

        return redirect()->back();
    }

    public static function updateDatasTable()
    {
        $file = file_get_contents('data/statement.htm');
        //echo ($file);
        $dom = new \DOMDocument();
        $dom->loadHTML($file);

        $xpath = new \DOMXPath($dom);

        $data = Controller::getData_closeTrades($dom, $xpath);
    }

    public static function getData_closeTrades($dom, $xpath)
    {
        $tbody = $dom->getElementsByTagName('tbody')->item(0);
        $numberOfRow = count($xpath->query('//table/tr', $tbody));

        $label = ['open_trade', 'type', 'levier', 'close_trade', 'profit'];
        $data = [];

        // Récupère tout les infos concernant les trades cloturés
        foreach ($xpath->query('//table/tr', $tbody) as $line => $tr)
        {
            // Récupère tout les trades close
            if($line >= 3) {
                $count = 0;

                foreach ($xpath->query("td", $tr) as $key => $td) {
                    if($key === 1 || $key === 2 || $key === 3 || $key === 8 || $key === 13) {

                        $data[$line][$label[$count]] = $td->nodeValue;
                        $count += 1;
                    }
                }

                if(isset($data[$line]) && count($data[$line]) !== 5) {
                    unset($data[$line]);
                } else {

                    if(array_key_exists($line,$data))
                    {
                        if($data[$line]['type'] !== "sell" && $data[$line]['type'] !== "buy"){
                            unset($data[$line]);
                        }
                    }
                }
            }

            // Récupère les infos général lié au compte
            if($line === 0) {
                foreach ($xpath->query("td", $tr) as $key => $td) {
                    if($key === 0)  {
                        $account = $td->nodeValue;
                    }

                    if($key === 4) {

                        $time_file_update = $td->nodeValue;
                        $strArray = explode(' ',$time_file_update);
                        
                        $hours = substr($time_file_update, -5);

                        $time_file_update = Carbon::parse($strArray[0] ."/". date('n', strtotime($strArray[1])) ."/". $strArray[2] )->locale('fr-FR');
                        $time_file_update = ucfirst($time_file_update->getTranslatedDayName('dddd')) ." ".  $time_file_update->translatedFormat('d F | ') . $hours;
                    }
                }
            }

            // Récupère les infos comptable  lié au compte
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

        $tradesByDays = [];
        $count = 0;
        $previousKey = null;
        $inTradingClose = true;
        $tradesByDaysOpen=[];
        foreach($data as $key => $trade)
        {
            if($previousKey === null || $key === ($previousKey + 1) || $key === ($previousKey + 2))
            {
                if($inTradingClose) {
                    $date = date("d-m-Y", strtotime(str_replace(".", "/", substr($trade['close_trade'], 0,10))));

                    $dateVanished = Carbon::parse($date)->locale('fr-FR');
                    $dateVanished = ucfirst($dateVanished->getTranslatedDayName('dddd')) ." ".  $dateVanished->translatedFormat('d F | Y');

                    $tradesByDays[$date]['date_label'] = $dateVanished;

                    $time = strtotime(substr($trade['close_trade'], 11));
                    $timeLessOneH = date("H:i:s", strtotime('-1 hours', $time));

                    $tradesByDays[$date]['trades'][$timeLessOneH][$count]['profit'] = $trade['profit'];
                    $tradesByDays[$date]['trades'][$timeLessOneH][$count]['levier'] = $trade['levier'];
                    $tradesByDays[$date]['trades'][$timeLessOneH][$count]['type'] = $trade['type'];

                    $time = strtotime(substr($trade['open_trade'], 11));
                    $time_closeTrade = date("H:i:s", strtotime('-1 hours', $time));
                    $tradesByDays[$date]['trades'][$timeLessOneH][$count]['open_trade'] = $time_closeTrade;

                    $previousKey = $key;
                    $count += 1;
                } else {
                    $time = strtotime(substr($trade['open_trade'], 11));
                    $time_openTrade = date("H:i:s", strtotime('-1 hours', $time));

                    $tradesByDaysOpen[$count]['open_trade'] = $time_openTrade;

                    $tradesByDaysOpen[$count]['profit'] = $trade['profit'];
                    $tradesByDaysOpen[$count]['levier'] = $trade['levier'];
                    $tradesByDaysOpen[$count]['type'] = $trade['type'];

                    $previousKey = $key;
                    $count += 1;
                }
            } else {
                $inTradingClose = false;
                $time = strtotime(substr($trade['open_trade'], 11));
                $time_openTrade = date("H:i:s", strtotime('-1 hours', $time));

                $tradesByDaysOpen[$count]['open_trade'] = $time_openTrade;

                $tradesByDaysOpen[$count]['profit'] = $trade['profit'];
                $tradesByDaysOpen[$count]['levier'] = $trade['levier'];
                $tradesByDaysOpen[$count]['type'] = $trade['type'];

                $previousKey = $key;
                $count += 1;
            }
        }

        foreach(TradeOpen::all() as $tradeOpen) {
            $tradeOpen->delete();
        }

        $datesList = Day::whereYear('date', date('Y'))->whereMonth('date', date('m'))->get();
        foreach($datesList as $date) {
             $date->tradeClose()->delete();
             $date->delete();
        }

        $accountFirst = Account::first();
        if($accountFirst) {
            $accountFirst->delete();
        }

        foreach($tradesByDaysOpen as $tradeOpen) {
            $trade = TradeOpen::create([
                "openTime"  => $tradeOpen['open_trade'],
                "profit"    => $tradeOpen['profit'],
                "levier"    => $tradeOpen['levier'],
                "type"      => $tradeOpen['type']
            ]);
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

        foreach($tradesByDays as $date => $tradesByDay)
        {
            $day = Day::create([
                'date' => date("Y-m-d", strtotime($date)) . " 00:00:00",
                'label' => $tradesByDay['date_label'],
                'profit' => $tradesByDay['profit'],
                'commission' => $tradesByDay['commission'],
                'profit_total' => $tradesByDay['profit_total']
            ]);

            foreach($tradesByDay['trades'] as $time => $trades) {
                foreach ($trades as $trade)
                {
                    $trade = TradeClose::create([
                        'day_id'    => $day['id'],
                        'openTime'  => $trade['open_trade'],
                        'closeTime' => $time,
                        'profit'    => $trade['profit'],
                        'type'      => $trade['type'],
                        'levier'    => $trade['levier']
                    ]);
                }
            }
        }

        $nbOfDays = Day::all()->count();

        $profit = $free_margin - 505;
        $averageDaily = $profit / $nbOfDays;

        Account::create([
            'name' => $account,
            'file_updated_at' => $time_file_update,
            'balance' => $free_margin,
            'profit' => $profit,
            'average' => $averageDaily
        ]);

        return $data;
    }

    public function getDatasToDisplay($daysList, $filter = true)
    {
        $dataToView = [];
        $tradesList = [];

        foreach($daysList as $day)
        {
            $date = str_replace(" 00:00:00", "", $day['date']);

            $tradesList[$date]['label'] = $day['label'];;
            $tradesList[$date]['profit'] = $day['profit'];
            $tradesList[$date]['commission'] = $day['commission'];
            $tradesList[$date]['profit_total'] = $day['profit_total'];

            foreach(TradeClose::all()->where('day_id', $day['id'])->sortByDesc('openTime') as $trade) {
                $tradesList[$date]['tradesList'][] = $trade;
            }
        }


        if($filter)
        {
            $dataToView['tradesByDays'] = $tradesList;

            $account = Account::firstOrFail();

            $dataToView['account'] = $account['name'];
            $dataToView['file_updated_at'] = $account['file_updated_at'];
            $dataToView['balance'] = $account['balance'];
            $dataToView['profit'] = $account['profit'];
            $dataToView['average'] = $account['average'];

            if(empty($tradesList)) {
                return false;
            } else {
                return $dataToView;
            }
        } else {
            $nbOfTrades = 0;
            $profitPerMonth = 0;
            foreach($tradesList as $trade)
            {
                $profitPerMonth += $trade['profit'];
                $nbOfTrades += count($trade['tradesList']);
            }
            $dataToView['profitPerMonth'] = $profitPerMonth;
            $dataToView['nbOfTrades'] = $nbOfTrades;
            $dataToView['commission'] = $nbOfTrades / 10;
        }

        return $dataToView;
    }
}

