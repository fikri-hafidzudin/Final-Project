<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KomentarJawaban extends Model
{
    protected $table = "komentar_jawaban";
    protected $fillable = ["isi"];
    
    public function jawaban(){
        return $this -> belongsTo('App\Jawaban', 'jawaban_id');
    }
}
