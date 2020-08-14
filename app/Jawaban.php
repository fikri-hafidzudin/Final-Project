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
}
