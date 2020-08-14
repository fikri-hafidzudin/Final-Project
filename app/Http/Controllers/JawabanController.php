<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\pertanyaan;
use App\Jawaban;
use DB;

class JawabanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {       
        $jawaban = new Jawaban;
        $jawaban->isi = $request["isi"];
        $jawaban->pertanyaan_id = $request["pertanyaan_id"];
        $jawaban->user_id = Auth::user()->id;
        $jawaban->save();
        
        return redirect()->route('pertanyaanbaru.show', [$jawaban->pertanyaan_id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $jawaban = Jawaban::find($id); 
        return view('jawaban.edit', compact('jawaban'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $jawaban = Jawaban::find($id);
        $jawaban->isi   = $request["isi"];
        $jawaban->save();

        return redirect()->route('pertanyaanbaru.show', [$jawaban->pertanyaan_id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $jawaban = Jawaban::find($id);
        Jawaban::destroy($id);
        //return redirect('/pertanyaanbaru');
        return redirect()->route('pertanyaanbaru.show', ['pertanyaanbaru' => $jawaban->pertanyaan_id]);
    }
}
