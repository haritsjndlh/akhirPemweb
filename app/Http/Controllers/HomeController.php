<?php

namespace App\Http\Controllers;

use App\Models\Badge;
use App\Models\Color;
use App\Models\Income;
use App\Models\expense;
use App\Models\FastPayment;
use App\Models\Transaction;
use App\Models\category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    
    public function index()
    {
        $badge = Badge::all();
        $fp = FastPayment::select('*')
                ->where('user_id', Auth::user()->id)
                ->get();
        $totalin = DB::table('transactions')
             ->select(DB::raw('sum(fee) as fee'))
             ->where('fee', '>=' ,'0')
             ->where('user_id', Auth::user()->id)
             ->get();
        $totalex = DB::table('transactions')
             ->select(DB::raw('sum(fee) as fee'))
             ->where('fee', '<' ,'0')
             ->where('user_id', Auth::user()->id)
             ->get();
        $transaksi = Transaction::select('*')
             ->where('user_id', Auth::user()->id)
             ->get();
        
        return view('/home', compact('badge', 'fp', 'totalin', 'totalex', 'transaksi'));
        
    }

    public function store(Request $request){
        $fp = new FastPayment;
        $fp->description = $request->input('deskripsi');
        $fp->fee = $request->input('fee');
        $fp->badge_id = $request->input('badge');
        $fp->user_id = Auth::user()->id;

        $fp->save();
        return redirect('/home')->with('success');
    }

    public function edit(Request $request){
        $name_wallet = $request->input('namaDompet');
        $saldo = $request->input('Saldo');
        $id_user = Auth::user()->id;

        DB::update('update users set name_wallet = ?,saldo =? where id = ?',[$name_wallet,$saldo, $id_user]);

        return redirect('/home')->with('success');
    }

    public function getAll(){
        $fp = FastPayment::all();
        return view('/home', compact('fp'));
    }

    public function update(Request $request, $id){
        $description = $request->input('deskripsi');
        $fee = $request->input('fee');
        $badge = $request->input('badge');

        DB::update('update fast_payments set description = ?,fee =?,badge_id=? where id = ?',[$description,$fee,$badge, $id]);
        
        return redirect('/home')->with('success');
    }

    public function destroy($id)
    {
        DB::delete('delete from fast_payments where id = ?',[$id]);
        return redirect('/home')->with('flash_message', 'Fast Payment deleted!');  
    }
}
