<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KomentarPertanyaan extends Model
{
    protected $table = "komentar_pertanyaan";
    protected $fillable = ["isi"];
    
    public function pertanyaan(){
        return $this -> belongsTo('App\pertanyaan', 'pertanyaan_id');
    }

    public function user(){
        return $this -> belongsTo('App\User', 'user_id');
    }
}
