<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Almoco extends Model
{
    use HasFactory;
    protected $fillable = ['data', 'salada', 'complemento', 'principal', 'sobremesa', 'suco', 'user_id'];

    public function user() {
        //belongsTo (pertence a)
        return $this->belongsTo('App\Models\User');
    }
}
