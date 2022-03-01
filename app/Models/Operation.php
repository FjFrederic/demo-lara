<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Operation extends Model
{
    use HasFactory;

    const DEPOT = 'depot';
    const REMISE = 'remise';
    const RETRAIT = 'retrait';

    protected $table = 'operations';
    protected $primaryKey = 'id';
    protected $softDelete = false;
    protected $fillable = [
        'type',
        'commentaire',
    ];


    public function getBilletages()
    {
        return $this->hasMany(Billetage::class, 'operation_id', 'id');
    }

}
