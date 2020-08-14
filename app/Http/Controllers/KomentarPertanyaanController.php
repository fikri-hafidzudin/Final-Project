<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\KomentarPertanyaan;
use App\Jawaban;
use DB;


class KomentarPertanyaanController extends Controller
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
        
        $komentarPertanyaan = new KomentarPertanyaan;
        $komentarPertanyaan->isi = $request["isi"];
        $komentarPertanyaan->pertanyaan_id = $request["pertanyaan_id"];
        $komentarPertanyaan->user_id = Auth::user()->id;
        $komentarPertanyaan->save();
        
        return redirect()->route('pertanyaanbaru.show', [$komentarPertanyaan->pertanyaan_id]);
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
        $komentarPertanyaan = KomentarPertanyaan::find($id); 
        return view('komentarPertanyaan.edit', compact('komentarPertanyaan'));
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
        
        $komentarPertanyaan = KomentarPertanyaan::find($id);
        $komentarPertanyaan->isi   = $request["isi"];
        $komentarPertanyaan->save();

        return redirect()->route('pertanyaanbaru.show', [$komentarPertanyaan->pertanyaan_id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $komentarPertanyaan = KomentarPertanyaan::find($id);
        KomentarPertanyaan::destroy($id);
        return redirect()->route('pertanyaanbaru.show', ['pertanyaanbaru' => $komentarPertanyaan->pertanyaan_id]);
    }
}
