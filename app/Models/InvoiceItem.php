<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceItem extends Model
{

    use HasFactory;

    protected $fillable = [
        'invoice_id',
        'inventory_id',
        'qty',
        'rate',
        'disc',
        'hsn',
        'unit_id'
    ];

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }

    public function inventory()
    {
        return $this->belongsTo(Inventory::class);
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

}
