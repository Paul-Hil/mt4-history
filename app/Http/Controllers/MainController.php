<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        if (is_null(Trade::first())) {
            MainController::updateFileMT4();
        }

        $dataToView = [];
        $tradesList = [];

        foreach(Day::all() as $day)
        {
            $date = str_replace(" 00:00:00", "", $day['date']);

            $tradesList[$date]['label'] = $day['label'];;
            $tradesList[$date]['profit'] = $day['profit'];
            $tradesList[$date]['commission'] = $day['commission'];
            $tradesList[$date]['profit_total'] = $day['profit_total'];

            foreach(Trade::all()->where('day_id', $day['id']) as $trade) {
                $tradesList[$date]['tradesList'][] = $trade;
            }
        }

        $dataToView['tradesByDays'] = $tradesList;

        $account = Account::firstOrFail();
        $dataToView['account'] = $account['name'];
        $dataToView['file_updated_at'] = $account['file_updated_at'];
        $dataToView['balance'] = $account['balance'];
        $dataToView['profit'] = $account['profit'];
        $dataToView['average'] = $account['average'];

        return view('index', ['data' => $dataToView]);
    }
}
