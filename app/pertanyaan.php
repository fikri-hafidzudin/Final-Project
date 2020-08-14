<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pertanyaan extends Model
{
    protected $table = "pertanyaan";

    public function jawaban(){
        return $this -> hasMany('App\Jawaban', 'pertanyaan_id');
    }

    public function tags(){
        return $this->belongsToMany('App\Tag', 'tags_has_pertanyaan', 'pertanyaan_id','tag_id');
    }
}
