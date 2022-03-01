<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Billetage extends Model
{
    use HasFactory;

    const BILLETS = 1;
    const PIECES = 2;
    const CENTIMES = 3;

    protected $table = 'billetages';
    protected $primaryKey = 'id';
    protected $softDelete = false;
    protected $fillable = [
        'nominal',
        'quantite',
        'montant',
        'type_monnaie',
        'operation_id',
    ];
}
