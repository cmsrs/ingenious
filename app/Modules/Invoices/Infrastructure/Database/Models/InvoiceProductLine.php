<?php

namespace App\Modules\Invoices\Infrastructure\Database\Models;

use Illuminate\Database\Eloquent\Model;

class InvoiceProductLine extends Model
{
    protected $table = 'invoice_product_lines';

    public $incrementing = false;
    protected $keyType = 'string';

    
    protected $fillable = [
        'invoice_id',
        'product_id',
        'quantity', // add other columns if needed
    ];

}
