<?php 
namespace App\Modules\Approval\Listeners;

use App\Modules\Approval\Api\Events\EntityApproved;
use App\Modules\Approval\Api\Events\EntityRejected;
use App\Domain\Enums\StatusEnum;
use App\Modules\Invoices\Infrastructure\Database\Models\Invoice;

class UpdateInvoiceStatus
{
    public function handle($event)
    {
        $invoiceId = $event->approvalDto->id->toString();
        $invoice = Invoice::find($invoiceId);

        if ($event instanceof EntityApproved) {
            $status = StatusEnum::APPROVED;
        } elseif ($event instanceof EntityRejected) {
            $status = StatusEnum::REJECTED;
        }
        
        $invoice->status = $status;
        $invoice->is_change_status = true;
        $invoice->save();
    }

}