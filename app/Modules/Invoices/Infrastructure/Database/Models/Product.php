<?php 

namespace App\Modules\Invoices\Infrastructure\Database\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    public $incrementing = false;
    protected $keyType = 'string';
    
    protected $fillable = [
        'name',
        'price',
        'currency',
    ];

    public function invoices() : BelongsToMany
    {
        return $this->belongsToMany(Invoice::class, 'invoice_product_lines', 'product_id', 'invoice_id');
    }    


}

