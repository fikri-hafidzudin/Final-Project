<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\KomentarJawaban;
use App\Jawaban;
use DB;

class KomentarJawabanController extends Controller
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
        $request->validate([
            'isi'  => 'required'
        ]);

        $jawaban = Jawaban::find($request["jawaban_id"]);
        $komentarJawaban = new KomentarJawaban;
        $komentarJawaban->isi = $request["isi"];
        $komentarJawaban->jawaban_id = $request["jawaban_id"];
        $komentarJawaban->user_id = Auth::user()->id;
        $komentarJawaban->save();
        
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $komentarJawaban = KomentarJawaban::find($id); 
        return view('komentarJawaban.edit', compact('komentarJawaban'));
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
        $request->validate([
            'isi'  => 'required'
        ]);
        
        $komentarJawaban = KomentarJawaban::find($id);
        $komentarJawaban->isi   = $request["isi"];
        $komentarJawaban->save();

        return redirect()->route('pertanyaanbaru.show', [$komentarJawaban->jawaban->pertanyaan_id]);
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $komentarJawaban = KomentarJawaban::find($id);
        KomentarJawaban::destroy($id);
        //return redirect()->route('pertanyaanbaru.show', ['pertanyaanbaru' => $komentarJawaban->jawaban->pertanyaan_id]);
        //return redirect('/pertanyaanbaru');
        return redirect()->route('pertanyaanbaru.show', [$komentarJawaban->jawaban->pertanyaan_id]);
    }
}
