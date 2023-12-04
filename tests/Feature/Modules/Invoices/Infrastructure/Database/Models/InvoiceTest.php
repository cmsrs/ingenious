<?php

namespace tests\Feature\Modules\Invoices\Infrastructure\Database\Models;

use Tests\TestCase;
use App\Modules\Invoices\Infrastructure\Database\Models\Invoice;
use App\Modules\Invoices\Infrastructure\Database\Models\Company;
use App\Modules\Invoices\Infrastructure\Database\Models\Product;
use App\Modules\Invoices\Infrastructure\Database\Models\InvoiceProductLine;
use Illuminate\Foundation\Testing\RefreshDatabase;
//use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\DB;

class InvoiceTest extends TestCase
{
    use RefreshDatabase;

    public function testGetDataToShowWithPopulatedData()
    {
        //$databaseName = DB::connection()->getDatabaseName();
        //dd("Current database: $databaseName");        

        // Populate the database with sample data
        $this->seedDatabase();

        // Assuming you have data in your database for the given IDs
        $invoice = Invoice::find('2b9fbae0-8709-48f3-ad95-d5d29d7839af');

        $data = $invoice->getDataToShow($invoice);

        $this->assertEquals(641800707, $data['total_price']);
    }

    private function seedDatabase()
    {
        // Seed companies table
        Company::unguard();
        Company::create([
            'id' => 'eab1d897-7bac-4434-8f6a-1b92555d8b02',
            'name' => 'Satterfield, Mraz and Bruen',
            'street' => '83464 Narciso Mount',
            'city' => 'New Alanna',
            'zip' => '68387',
            'email' => 'aaa@wp.pl',
            'phone' => '(570) 919-0037',
        ]);
        Company::reguard();

        // Seed invoices table
        Invoice::unguard();        
        Invoice::create([
            'id' => '2b9fbae0-8709-48f3-ad95-d5d29d7839af',
            //'id' => '2b9fbae0-8709-48f3-ad95-d5d29d7839aw',            
            'number' => '758a70a5-6c61-3a6e-9b77-39e36391b99c',
            'date' => '1983-12-15',
            'due_date' => '1993-08-17',
            'company_id' => 'eab1d897-7bac-4434-8f6a-1b92555d8b02',
            'status' => 'approved',
            'created_at' => '2023-12-01 13:39:27',
            'updated_at' => '2023-12-04 11:04:09',
        ]);
        Invoice::reguard();

        // Seed products table
        Product::unguard();                
        Product::create([
            'id' => 'c895c73a-912e-47d6-90ee-891dea813b3a',
            'name' => 'snickers',
            'price' => 1541258,
            'currency' => 'usd',
        ]);
        Product::reguard();

        Product::unguard();                
        Product::create([
            'id' => 'c1de6173-9ebb-4214-bc18-b033b129fdfa',
            'name' => 'water',
            'price' => 4140114,
            'currency' => 'usd',
        ]);
        Product::reguard();

        Product::unguard();                
        Product::create([
            'id' => 'ff29ad00-7c42-4d2a-84ba-6d07d77db77d',
            'name' => 'water',
            'price' => 6661915,
            'currency' => 'usd',
        ]);
        Product::reguard();

        // Seed invoice_product_lines table
        InvoiceProductLine::unguard();                        
        InvoiceProductLine::create([
            'id' => '105f7fee-1d52-48cd-b5dd-ef93245b145f',
            'invoice_id' => '2b9fbae0-8709-48f3-ad95-d5d29d7839af',
            'product_id' => 'c895c73a-912e-47d6-90ee-891dea813b3a',
            'quantity' => 77,
        ]);
        InvoiceProductLine::reguard();

        InvoiceProductLine::unguard();                        
        InvoiceProductLine::create([
            'id' => '4d053189-3653-46a2-8f8d-85ab1376ae07',
            'invoice_id' => '2b9fbae0-8709-48f3-ad95-d5d29d7839af',
            'product_id' => 'c1de6173-9ebb-4214-bc18-b033b129fdfa',
            'quantity' => 99,
        ]);
        InvoiceProductLine::reguard();

        InvoiceProductLine::unguard();                        
        InvoiceProductLine::create([
            'id' => 'c27d1a32-f4d7-46ac-9d03-a769a770b402',
            'invoice_id' => '2b9fbae0-8709-48f3-ad95-d5d29d7839af',
            'product_id' => 'ff29ad00-7c42-4d2a-84ba-6d07d77db77d',
            'quantity' => 17,
        ]);
        InvoiceProductLine::reguard();

    }
}
