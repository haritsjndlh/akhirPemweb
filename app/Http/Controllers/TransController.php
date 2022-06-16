<?php

namespace App\Http\Controllers;

use App\Models\category;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class TransController extends Controller
{
    //
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
        $transaksi = Transaction::select('*')
             ->where('user_id', Auth::user()->id)
             ->get();
        $category = Category::all();
        
        return view('/transaksi', compact('transaksi', 'category'));
    }

    public function store(Request $request){
        $trans = new Transaction;

        $trans->description = $request->input('deskripsi');
        $trans->fee = $request->input('fee');
        $trans->tanggal = $request->input('tanggal');
        $trans->category_id = $request->input('category');
        $trans->user_id = Auth::user()->id;

        $trans->save();
        return redirect('/transaksi')->with('success');
    }

    public function update(Request $request, $id){
        $description = $request->input('deskripsi');
        $fee = $request->input('fee');
        $tanggal = $request->input('tanggal');
        $category = $request->input('category');

        DB::update('update transactions set description = ?,fee =?,tanggal =?,category_id=? where id = ?',[$description,$fee,$tanggal,$category, $id]);

        return redirect('/transaksi')->with('success');
    }

    public function destroy($id)
    {
        DB::delete('delete from transactions where id = ?',[$id]);
        return redirect('/transaksi')->with('flash_message', 'Transaction deleted!');  
    }
}
