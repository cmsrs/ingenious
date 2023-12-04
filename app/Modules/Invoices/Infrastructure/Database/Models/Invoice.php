<?php

namespace App\Modules\Invoices\Infrastructure\Database\Models;

//use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Invoice extends Model
{
    //use HasFactory;

    protected $fillable = [
        'id',
        'number',
        'date',
        'due_date',
        'company_id',
        'status',
        'created_at',
        'updated_at',
    ];

    public $incrementing = false;
    protected $keyType = 'string';
    

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function products() : BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'invoice_product_lines', 'invoice_id', 'product_id')
            ->withPivot('quantity')
            ;
    }

    public function getDataToShow($invoice){
        $data = [
            'invoice_number' => $invoice->number,
            'invoice_date' => $invoice->date,
            'due_date' => $invoice->due_date,
            'status' => $invoice->status,            
            'company' => [
                'name' => $invoice->company->name,
                'street_address' => $invoice->company->street,
                'city' => $invoice->company->city,
                'zip_code' => $invoice->company->zip,
                'phone' => $invoice->company->phone,
            ],
            // 'billed_company' => [
            //     'name' => $invoice->billedCompany->name,
            //     'street_address' => $invoice->billedCompany->street,
            //     'city' => $invoice->billedCompany->city,
            //     'zip_code' => $invoice->billedCompany->zip,
            //     'phone' => $invoice->billedCompany->phone,
            //     'email_address' => $invoice->billedCompany->email,
            // ],
        ];

        $products = [];
        $i = 0;
        //$pp = $invoice->products() ->wherePivot('invoice_id', $invoiceId) ->get()-> toArray();
        $pp = $invoice->products->toArray();
        $totalPrice = 0;
        foreach($pp as $product){
            $p = [];
            $p['name'] = $product['name'];
            $p['price'] = $product['price'];
            $p['quantity'] = $product['pivot']['quantity'];
            $p['amount'] = $p['price'] * $p['quantity'];
            $totalPrice += $p['amount'];

            $products[$i] = $p;
            $i++;
        }

        $data['products'] = $products;
        $data['total_price'] = $totalPrice;        
        return $data;
    }

}
