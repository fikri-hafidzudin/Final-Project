<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\pertanyaan;
use DB;

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
        $pertanyaan = pertanyaan::all();
        $votes = [];
        foreach($pertanyaan as $tanya){
            if(count($tanya->vote) != 0){
                $votes[] = DB::table('upvote_downvote_pertanyaan')
                    ->select(DB::raw('pertanyaan_id, sum(poin) as poin'))
                    ->where("pertanyaan_id", $tanya->id)
                    ->groupBy('pertanyaan_id')
                    ->get()->first();
                } else {
                    $votes[] = ['pertanyaan_id'=> $tanya->id];
                }
        }

        return view('pertanyaan.index', compact('pertanyaan','votes'));
    }
}
