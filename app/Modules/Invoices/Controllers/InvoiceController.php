<?php

namespace App\Modules\Invoices\Controllers;

use App\Modules\Invoices\Infrastructure\Database\Models\Invoice;
use Illuminate\Http\Request;
use App\Modules\Approval\Api\Dto\ApprovalDto;
use Illuminate\Routing\Controller;
use App\Domain\Enums\StatusEnum;
use App\Modules\Approval\Api\Dto\ApprovalDto\EntityApproved;
use App\Modules\Approval\Api\Dto\ApprovalDto\EntityRejected;
use App\Modules\Approval\Application\ApprovalFacade;
use Ramsey\Uuid\Uuid;
//use Illuminate\Contracts\Events\Dispatcher;
use App\Modules\Approval\Api\ApprovalFacadeInterface;

class InvoiceController extends Controller
{
    //public function __construct(Dispatcher $dispatcher, ApprovalFacadeInterface $approvalFacade)
    public function __construct(ApprovalFacadeInterface $approvalFacade)    
    {
        //$this->dispatcher = $dispatcher;
        $this->approvalFacade = $approvalFacade;
    }

    public function showInvoice(string $invoiceId)
    {
        $invoice = Invoice::find($invoiceId);

        if (!$invoice) {
            return response()->json(['message' => 'Invoice not found'], 404);
        }      
        
        $data = (new Invoice)->getDataToShow($invoice);

        return response()->json($data, 200);
    }

    public function approveInvoice(Request $request, string $id)
    {
        $invoice = Invoice::find($id);

        if (!$invoice) {
            return response()->json(['message' => 'Invoice not found'], 404);
        }

        $status = empty($invoice->is_change_status) ?  StatusEnum::DRAFT : StatusEnum::APPROVED;

        $approvalDto = new ApprovalDto(
            Uuid::fromString($id),
            $status,
           'Invoice'
        );
        //$f = new ApprovalFacade($this->dispatcher);
        //$f->approve($approvalDto);
        $this->approvalFacade->approve($approvalDto);

        return response()->json(['message' => 'Invoice approved successfully'], 200);
    }

    public function rejectInvoice(Request $request, string $id)
    {
        $invoice = Invoice::find($id);
        if (!$invoice) {
            return response()->json(['message' => 'Invoice not found'], 404);
        }

        $status = empty($invoice->is_change_status) ? StatusEnum::DRAFT  : StatusEnum::REJECTED;

        $approvalDto = new ApprovalDto(
            Uuid::fromString($id),
            $status,
            'Invoice'
        );

        //$f = new ApprovalFacade($this->dispatcher);        
        //$f->reject($approvalDto);
        $this->approvalFacade->reject($approvalDto);

        return response()->json(['message' => 'Invoice rejected successfully'], 200);
    }    

}