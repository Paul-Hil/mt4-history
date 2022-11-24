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
        //MainController::updateFileMT4();

        $daysList = Day::all();

        $dataToView = Controller::getDatasToDisplay($daysList);

        return view('index', ['data' => $dataToView]);
    }

    public function tradesByDays(Request $request)
    {
        $monthSelected = Route::current()->parameter('month');
        $daysList = Day::whereMonth('date', $monthSelected)->get();

        $dataToView = Controller::getDatasToDisplay($daysList);

        return view('index', ['data' => $dataToView]);    }
}
