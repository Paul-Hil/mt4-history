<?php

namespace App\Http\Controllers;

use App\Models\Argument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Routing\Redirector;
use Carbon\Carbon;
use Illuminate\Support\Facades\Route;

use App\Models\Trade;
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

        for ($month=1; $month <= 12; $month++) 
        {
            $year = date('Y');
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


        return view('index', ['data' => $dataToView]);
    }

    public function tradesByDays(Request $request)
    {
        $monthSelected = Route::current()->parameter('month');
        $yearSelected = Route::current()->parameter('year');

        $daysList = Day::whereYear('date', $yearSelected)->whereMonth('date', $monthSelected)->get();

        $dataToView = Controller::getDatasToDisplay($daysList);

        $dateVanished = Carbon::parse($monthSelected."/01/".$yearSelected)->locale('fr-FR');
        $dateFR = ucfirst($dateVanished->translatedFormat('F Y'));
        $monthFR = substr($dateFR, 0 ,-4);

        if(!$dataToView) {
            return redirect()->back()->withErrors(['msg' => "- Aucune données disponible pour $monthFR -"]);
        }

        $dataToView['date'] = $dateFR;
        $month_profit = 0;

        foreach($dataToView['tradesByDays']as $datasPerDay) {
            foreach($datasPerDay['tradesList'] as $trade) {
                $month_profit += $trade['profit'];

            }
        }

        var_dump($month_profit);

        ///// TODOOOOOOOOOOOOO
        // $dataToView['profit_month'] = ;
        // $dataToView['commission_month'] = $dateFR;

        return view('tradeByDays', ['data' => $dataToView]);   
    }
}
