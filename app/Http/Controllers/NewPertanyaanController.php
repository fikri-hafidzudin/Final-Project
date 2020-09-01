<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pertanyaan;
use App\Jawaban;
use App\Tag;
use App\VotePertanyaan;
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
        $votes = [];
        foreach($pertanyaan as $tanya){
            if(count($tanya->vote) != 0){
                $votes[] = DB::table('upvote_downvote_pertanyaan')
                    ->select(DB::raw('pertanyaan_id, sum(poin) as poin'))
                    ->where("pertanyaan_id", $tanya->id)
                    ->groupBy('pertanyaan_id')
                    ->get()->first();
                }
        }
       // dd(('' $votes));    
        return view('pertanyaan.index', compact('pertanyaan','votes'));
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

        $tags_arr = explode(',',$request['tags']);
        

        $tag_ids = [];
        foreach($tags_arr as $tag_name){
            $tags = Tag::where("tag", $tag_name)->first();
            if ($tags){
                $tag_ids[] = $tags->id;
            } else {
                $new_tag = Tag::create(
                    ["tag" => $tag_name]
                );
                $tag_ids[] = $new_tag->id;
            }
        }
        
        $pertanyaan1 = new Pertanyaan;
        $pertanyaan1->judul = $request["judul"];
        $pertanyaan1->isi   = $request["isi"];
        $pertanyaan1->user_id   = Auth::user()->id;
        $pertanyaan1->save();

        $pertanyaan1->tags()->sync($tag_ids);
        
        return redirect('/home')->with('success', 'Pertanyaan anda telah diajukan');
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
        $vote = DB::table('upvote_downvote_pertanyaan')
                     ->select(DB::raw('sum(poin) as poin'))
                     ->where("pertanyaan_id", $id)
                     ->groupBy('pertanyaan_id')
                     ->get()->first();
        
        return view('pertanyaan.show', compact('pertanyaan','vote'));
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
        $tags_arr = [];
        foreach($pertanyaan->tags as $tag){
            $tags_arr[] = $tag->tag;
        }
        
        $tag_name = (implode(",",$tags_arr));
        
        return view('pertanyaan.edit', compact('pertanyaan','tag_name'));
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
            'judul'=> 'required',
            'isi'  => 'required'
        ]);
        
        $tags_arr = explode(',',$request['tags']);
        
        $tag_ids = [];
        foreach($tags_arr as $tag_name){
            $tags = Tag::where("tag", $tag_name)->first();
            if ($tags){
                $tag_ids[] = $tags->id;
            } else {
                $new_tag = Tag::create(
                    ["tag" => $tag_name]
                );
                $tag_ids[] = $new_tag->id;
            }
        }
        
        $pertanyaan = pertanyaan::find($id);
        $pertanyaan->judul = $request["judul"];
        $pertanyaan->isi   = $request["isi"];
        $pertanyaan->save();

        $pertanyaan->tags()->sync($tag_ids);

        return redirect('/home');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pertanyaan = pertanyaan::find($id);
        $pertanyaan->jawaban_tepat_id = null;
        $pertanyaan->save();
        DB::table('komentar_pertanyaan')->where('pertanyaan_id', $pertanyaan->id)->delete();
        if(count($pertanyaan->jawaban)  != 0 ){
            DB::table('komentar_jawaban')->where('jawaban_id', $pertanyaan->jawaban->first()->id)->delete();}
        DB::table('jawaban')->where('pertanyaan_id', $pertanyaan->id)->delete();
        DB::table('tags_has_pertanyaan')->where('pertanyaan_id', $pertanyaan->id)->delete();
        $pertanyaan->delete();
       
        return redirect('/home');
    }

    public function tepat($id)
    {   
        $jawaban = Jawaban::find($id);
        $pertanyaan = pertanyaan::find($jawaban->pertanyaan_id);
        $pertanyaan->jawaban_tepat_id = $id;
        $pertanyaan->save();

        return redirect()->route('pertanyaanbaru.show', $jawaban->pertanyaan_id);
    }

    public function upvote($id)
    {   
        $user = Auth::user()->id;
        $vote = VotePertanyaan::create(
            [
                "pertanyaan_id" => $id,
                "user_id" => $user,
                "poin" => 10
            ]
        );

        return redirect()->route('pertanyaanbaru.show', $id);
    }

    public function downvote($id)
    {   
        $user = Auth::user()->id;
        $vote = VotePertanyaan::create(
            [
                "pertanyaan_id" => $id,
                "user_id" => $user,
                "poin" => -5
            ]
        );

        return redirect()->route('pertanyaanbaru.show', $id);
    }

}

