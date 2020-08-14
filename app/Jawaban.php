<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jawaban extends Model
{
    protected $table = "jawaban";
    protected $fillable = ["isi"];
    public function pertanyaan(){
        return $this -> belongsTo('App\pertanyaan', 'pertanyaan_id');
    }

    public function komentar(){
        return $this -> hasMany('App\KomentarJawaban', 'jawaban_id');
    }

    public function user(){
        return $this -> belongsTo('App\User', 'user_id');
    }
}
