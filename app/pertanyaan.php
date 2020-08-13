<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pertanyaan extends Model
{
    protected $table = "pertanyaan";

    public function jawaban(){
        return $this -> hasMany('App\Jawaban', 'pertanyaan_id');
    }
}
