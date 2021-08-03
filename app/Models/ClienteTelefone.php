<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClienteTelefone extends Model
{
    protected $fillable = [

        'cliente_id',
        'telefone_tipo_id',
        'numero'

    ];
}
