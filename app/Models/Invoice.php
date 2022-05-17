<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{

    use HasFactory;

    protected $fillable = [
        'inv_ref',
        'inv_date',
        'customer_id',
        'chal_no',
        'chal_date',
        'po_no',
        'transporter_name',
        'lr_no',
        'vehicle_no'
    ];

    protected $dates = [
        'inv_date',
        'chal_date'
    ];

    public function invoiceItems()
    {
        return $this->hasMany(InvoiceItem::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

}
