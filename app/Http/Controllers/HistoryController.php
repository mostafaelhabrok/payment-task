<?php

namespace App\Http\Controllers;

use App\Models\History;


class HistoryController extends Controller
{

    public function index()
    {
        $result = History::all();
        
        return view('history/history',array('data' => json_encode($result)));
    }

    public function delete($id)
    {
        if(History::destroy($id)) $res = response()->json(array('success' => true , 'message' => 'Deleted Successfully'));
        else $res = response()->json(array('success' => false , 'message' => 'Delete Error'));

        return $res;
    }

    public function insertPaymentData($last4,$exp_month,$exp_year,$token_id,$card_holder,$amount,$status,$message)
    {
        $history = new History;

        $history->last4 = $last4;
        $history->exp_month = $exp_month;
        $history->exp_year = $exp_year;
        $history->token_id = $token_id;
        $history->card_holder = $card_holder;
        $history->amount = $amount;
        $history->status = $status;
        $history->message = $message;

        return $history->save();
    }

}
