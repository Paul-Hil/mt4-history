<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;

use App\Models\Historic;
use Illuminate\Http\Request;

use App\Http\Controllers\MainController;

class HistoricController extends Controller
{   
    public function index(Request $request) 
    {
        $mainController = new MainController;
        $result = $mainController->getHeaderDatas($request);
        $dataToView['file_updated_at'] = $result['file_updated_at'];
        $dataToView['balance'] = $result['balance'];
        $dataToView['average'] = $result['average'];
        $dataToView['year'] = $result['year'];
        $dataToView['profitYear'] = $result['profitYear'];
        $dataToView['profitTotal'] = $result['profitTotal'];

        $dataToView['historic'] = Historic::all();

        return view('historic.index', ['data' => $dataToView]);
    }

    public function add(Request $request) 
    {
        $mainController = new MainController;
        $result = $mainController->getHeaderDatas($request);
        $dataToView['file_updated_at'] = $result['file_updated_at'];
        $dataToView['balance'] = $result['balance'];
        $dataToView['average'] = $result['average'];
        $dataToView['year'] = $result['year'];
        $dataToView['profitYear'] = $result['profitYear'];
        $dataToView['profitTotal'] = $result['profitTotal'];

        if($request->isMethod('post')) {
            $validator = Validator::make($request->all(), [
                'name' => 'required|max:100',
                'price' => 'required',
                'quantity' => 'required|numeric',
                'date' => 'required',
                'comment' => 'string'
            ]);
    
            if ($validator->fails()) {
                return redirect()->route('history.add')
                    ->withInput()
                    ->withErrors($validator, 'form');
            } else {
    
                $itemHistoric = new Historic;
    
                $itemHistoric->name = $request->input("name");
                $itemHistoric->price = $request->input("price");
                $itemHistoric->quantity = $request->input("quantity");
                $itemHistoric->date = $request->input("date");
                $itemHistoric->comment = $request->input("comment");
    
                $itemHistoric->save();
    
                return to_route('history.item', ['id' => $itemHistoric->id]);
            }
        }

        return view('historic.addItem', ['data' => $dataToView]);
    }
}