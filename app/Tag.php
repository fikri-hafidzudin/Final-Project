<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    public function pertanyaans(){
        return $this->belongsToMany('App\Pertanyaan');
    }
}
