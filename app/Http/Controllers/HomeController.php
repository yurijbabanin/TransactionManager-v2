<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Transactions;

class HomeController extends Controller
{
    public function home(){
        $transaction = Transactions::all();
        $data = array('transaction' => $transaction);
    	return view('home', $data);
    }

    public function save(Request $request){
        $title = $request->input('title');
        $note = $request->input('note');
        $sum = $request->input('sum');
        $transaction = new Transactions();

        $transaction->title = $title;
        $transaction->note = $note;
        $transaction->sum = $sum;
        $transaction->author_id = 1;
        $transaction->save();
        return redirect('/');

    }

    public function show($id){
        $transaction = Transactions::find($id);
        $tax = round($transaction-> sum *18/118, 2);

        $data = array('transaction' => $transaction,
                        'tax'=> $tax);

        return view('show', $data);
    }

    public function delete($id){
        $transaction = Transactions::find($id);
        $transaction->delete();
        return redirect('/');
    }

}
