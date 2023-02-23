<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VotacaoAlmoco extends Model
{
    use HasFactory;
    protected $table = 'votacaoalmocos';
    protected $fillable = ['otimo', 'bom', 'regular', 'ruim', 'almoco_id'];

    public function almoco() {
        //belongsTo (pertence a)
        return $this->belongsTo('App\Models\Almoco');
    }

}
