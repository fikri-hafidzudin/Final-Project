<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pertanyaan;
use App\Jawaban;
use App\Tag;
use Illuminate\Support\Facades\Auth;
use DB;

class NewPertanyaanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

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
        $listTag = Tag::all();
        return view('pertanyaan.create',compact('listTag'));
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
        $pertanyaan1->user_id   = Auth::user()->id;
        $pertanyaan1->save();

        $tag = $request['tag'];
        DB::table('tags_has_pertanyaan')->insert(
            ['tag_id' => $tag, 'pertanyaan_id' => $pertanyaan1->id]
        );

        return redirect('/pertanyaanbaru')->with('success', 'Pertanyaan anda telah diajukan');
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

        return redirect('/pertanyaanbaru');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pertanyaan = pertanyaan::destroy($id);
        $pertanyaan->tag->delete();
        $pertanyaan->delete();
        // DB::table('tags_has_pertanyaan')->dropForeign('')
        //     ->where('pertanyaan_id', '=', $pertanyaan->id)->delete();
        return redirect('/pertanyaanbaru');
    }

    public function tepat($id)
    {   
        $jawaban = Jawaban::find($id);
        $pertanyaan = pertanyaan::find($jawaban->pertanyaan_id);
        $pertanyaan->jawaban_tepat_id = $id;
        $pertanyaan->save();

        return redirect()->route('pertanyaanbaru.show', [$jawaban->pertanyaan_id]);
    }
}

