<?php

namespace App\Modules\Invoices\Infrastructure\Database\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $table = 'companies';

    public $incrementing = false;
    protected $keyType = 'string';


    protected $fillable = [
        'name',
        'street',
        'city',
        'zip',
        'phone',
    ];

}

