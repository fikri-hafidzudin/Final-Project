<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\pertanyaan;

class NewPertanyaanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $pertanyaan = pertanyaan::all();
        return view('pertanyaan.index', compact('pertanyaan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pertanyaan.create');
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
            'judul'=> 'required',
            'isi'  => 'required'

        ]);

        $pertanyaan1 = new Pertanyaan;
        $pertanyaan1->judul = $request["judul"];
        $pertanyaan1->isi   = $request["isi"];
        $pertanyaan1->save();

        return redirect('/pertanyaan')->with('success', 'Pertanyaan anda telah diajukan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pertanyaan = pertanyaan::find($id);
        return view('pertanyaan.show', compact('pertanyaan'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pertanyaan = pertanyaan::find($id); 
        return view('pertanyaan.edit', compact('pertanyaan'));
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
         $pertanyaan = pertanyaan::find($id);
        $pertanyaan->judul = $request["judul"];
        $pertanyaan->isi   = $request["isi"];
        $pertanyaan->save();

        return redirect('/pertanyaan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        pertanyaan::destroy($id);
        return redirect('/pertanyaan');
    }
    }

