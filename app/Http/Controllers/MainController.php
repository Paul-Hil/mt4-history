<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Route;

use App\Models\TradeOpen;
use App\Models\TradeClose;
use App\Models\Day;
use App\Models\Account;


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
        $monthsList = [];
        $dataToView = [];

        // Si la bdd est vide,
        if(empty(TradeClose::first()))
        {
            Controller::updateFileMT4();
        }

        $year = $request->input('year');

        if(empty($year)) {
            $year = date('Y');
        }

        for ($month=1; $month <= 12; $month++)
        {
            $monthsList[$month] = Day::whereYear('date', $year)->whereMonth('date', $month)->get();

            $dateVanished = Carbon::parse($month."/01/0000")->locale('fr-FR');
            $monthFR = ucfirst($dateVanished->translatedFormat('F'));

            $dataToView[$monthFR] = Controller::getDatasToDisplay($monthsList[$month], false);
        }

        $lastTradesClose = TradeClose::orderBy('id', 'desc')->take(20)->get();

        foreach($lastTradesClose as $key => $trade)
        {
            $date = substr(substr($trade->day()->get()[0]->date, 0, -9), 5);
            $day = substr($date, 3);
            $month = substr($date, 0, -3);
            $dataToView['trades_close'][$key]['date'] = $day ."-". $month;
            $dataToView['trades_close'][$key]['openTime'] = $trade['openTime'];
            $dataToView['trades_close'][$key]['closeTime'] = $trade['closeTime'];

            $dataToView['trades_close'][$key]['profit'] = $trade['profit'];
            $dataToView['trades_close'][$key]['levier'] = $trade['levier'];
            $dataToView['trades_close'][$key]['type'] = $trade['type'];
        }

        $profit_tradesOpen = 0;
        foreach(TradeOpen::all() as $key => $trade)
        {
            $dataToView['trades_open'][$key]['openTime'] = $trade['openTime'];
            $dataToView['trades_open'][$key]['profit'] = $trade['profit'];
            $dataToView['trades_open'][$key]['price'] = $trade['price'];
            $dataToView['trades_open'][$key]['type'] = $trade['type'];
            $profit_tradesOpen += $trade['profit'];
        }

        $result = MainController::getHeaderDatas($request);
        $dataToView['file_updated_at'] = $result['file_updated_at'];
        $dataToView['balance'] = $result['balance'];
        $dataToView['average'] = $result['average'];
        $dataToView['year'] = $result['year'];
        $dataToView['profitYear'] = $result['profitYear'];
        $dataToView['profitTotal'] = $result['profitTotal'];

        $dataToView['profit_tradesOpen'] = $profit_tradesOpen;

        $daysList = [];
        $daysList = Day::whereYear('date', $year)->get();
        $result = Controller::getDatasToDisplay($daysList, false);
        $dataToView['profitYear'] = $result['profitPerMonth'];

        $daysList = Day::all();
        $result = Controller::getDatasToDisplay($daysList, false);
        $dataToView['profitTotal'] = $result['profitPerMonth'];

        return view('index', ['data' => $dataToView]);
    }

    public function tradesByDays(Request $request)
    {
        $monthSelected = Route::current()->parameter('month');
        $yearSelected = Route::current()->parameter('year');

        $daysList = Day::whereYear('date', $yearSelected)->whereMonth('date', $monthSelected)->orderBy('date', 'desc')->get();

        $dataToView = Controller::getDatasToDisplay($daysList);

        $dateVanished = Carbon::parse($monthSelected."/01/".$yearSelected)->locale('fr-FR');
        $dateFR = ucfirst($dateVanished->translatedFormat('F Y'));
        $monthFR = substr($dateFR, 0 ,-4);

        if(!$dataToView) {
            return redirect()->back()->withErrors(['msg' => "- Aucune données disponible pour $monthFR $yearSelected -"]);
        }

        $dataToView['date'] = $dateFR;
        $month_profit = 0;
        $commission = 0;

        foreach($dataToView['tradesByDays']as $datasPerDay) {
            foreach($datasPerDay['tradesList'] as $trade) {
                $month_profit += $trade['profit'];
                $commission -= 0.10;
            }
        }

        $daysList = [];
        $daysList = Day::whereYear('date', $yearSelected)->get();
        $result = Controller::getDatasToDisplay($daysList, false);
        $dataToView['profitYear'] = $result['profitPerMonth'];

        $daysList = Day::all();
        $result = Controller::getDatasToDisplay($daysList, false);
        $dataToView['profitTotal'] = $result['profitPerMonth'];

        $dataToView['profit_month_brut'] = $month_profit;
        $dataToView['profit_month_net'] = $month_profit + $commission;
        $dataToView['commission_month'] = $commission;
        $dataToView['year'] = $yearSelected;

        return view('tradeByDays', ['data' => $dataToView]);
    }

    public function getHeaderDatas(Request $request)
    {
        $dataToView = [];
        $yearSelected = $request->input('year');

        if(empty($yearSelected)) {
            $yearSelected = date('Y');
        }

        $account = Account::firstOrFail();
        $dataToView['file_updated_at'] = $account['file_updated_at'];
        $dataToView['balance'] = $account['balance'];
        //$dataToView['profit'] = $account['profit'];
        $dataToView['average'] = $account['average'];
        $dataToView['year'] = $yearSelected;

        $daysList = [];
        $daysList = Day::whereYear('date', $yearSelected)->get();
        $result = Controller::getDatasToDisplay($daysList, false);
        $dataToView['profitYear'] = $result['profitPerMonth'];

        $daysList = Day::all();
        $result = Controller::getDatasToDisplay($daysList, false);
        $dataToView['profitTotal'] = $result['profitPerMonth'];

        return $dataToView;
    }
}
