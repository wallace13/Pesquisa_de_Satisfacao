<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VotacaoCafe extends Model
{
    use HasFactory;
    protected $table = 'votacaocafes';
    protected $fillable = ['otimo', 'bom', 'regular', 'ruim', 'cafe_id'];

    public function cafe() {
        //belongsTo (pertence a)
        return $this->belongsTo('App\Models\Cafe');
    }

}
