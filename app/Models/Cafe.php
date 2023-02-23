<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cafe extends Model
{
    use HasFactory;
    protected $fillable = ['data', 'principal', 'opcao', 'user_id'];

    public function user() {
        //belongsTo (pertence a)
        return $this->belongsTo('App\Models\User');
    }
}
