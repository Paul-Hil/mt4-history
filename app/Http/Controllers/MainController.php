<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Routing\Redirector;
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

        if(empty(TradeClose::first()))
        {
            Controller::updateFileMT4();
        }

        $year = $request->input('year');

        for ($month=1; $month <= 12; $month++)
        {
            if(empty($year)) {
                $year = date('Y');
            }

            $monthsList[$month] = Day::whereYear('date', $year)->whereMonth('date', $month)->get();

            $dateVanished = Carbon::parse($month."/01/0000")->locale('fr-FR');
            $monthFR = ucfirst($dateVanished->translatedFormat('F'));

            $dataToView[$monthFR] = Controller::getDatasToDisplay($monthsList[$month], false);
        }

        $account = Account::firstOrFail();
        $dataToView['account'] = $account['name'];
        $dataToView['file_updated_at'] = $account['file_updated_at'];
        $dataToView['balance'] = $account['balance'];
        $dataToView['profit'] = $account['profit'];
        $dataToView['average'] = $account['average'];
        $dataToView['year'] = $year;

        $tradesList_closeToday = TradeClose::orderBy('id', 'desc')->take(20)->get();
        
        foreach($tradesList_closeToday as $key => $trade)
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

        $dataToView['profit_tradesOpen'] = $profit_tradesOpen;


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

        $dataToView['profit_month_brut'] = $month_profit;
        $dataToView['profit_month_net'] = $month_profit + $commission;
        $dataToView['commission_month'] = $commission;

        return view('tradeByDays', ['data' => $dataToView]);
    }
}
