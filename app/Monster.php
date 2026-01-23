<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Monster extends Model
{
    use HasFactory;
    //LIAISONS
    public function type(){
        return $this->belongsTo(Type::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }

    //UTILITAIRES
    public function shortDescription($limit = 45, $cut = '[...]'){
        return Str::limit($this->description, $limit, $cut);
    }
}
