<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{

    use HasFactory;

    protected $fillable = [
        'name',
        'gstin',
        'address1',
        'address2',
        'city',
        'state_id',
    ];

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }

    public function state()
    {
        return $this->belongsTo(State::class);
    }

}
