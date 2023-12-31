<?php

namespace App\Http\Controllers;

use App\Models\default_profile;
use App\Models\invoice;
use App\Models\profiles;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Redis;

class billingController extends Controller
{
    public function index(Request $request){
        $invoices = invoice::all()->sortDesc();
        $data = $invoices->makeHidden('complex_data')->toarray();
        return view('billing.index')->with(['data' => $data]);
    }
    
    public function newBill(Request $request){
        return view('billing.new-bill');
    }

    public function invoiceEditor(Request $request){
        $invoice = invoice::find($request->id);
        if($invoice){

            $defaultid = default_profile::find(1);

            $defaultdetails = profiles::find($defaultid->default);

            if($defaultdetails){
                $defaultdetailsisdata = true;
                $defaultdetailsdata = $defaultdetails->toArray(); 
            }else{
                $defaultdetailsisdata = false;
                $defaultdetailsdata = null; 
            }

            $invoice_data = $invoice->toarray();
            $invoice_data['complex_data'] = json_decode($invoice['complex_data'], true);
            return view('billing.invoice-editor')->with(['id'=>$request->id, 'invoice_data' => $invoice_data,'isDefault'=>$defaultdetailsisdata,'defaultData'=>$defaultdetailsdata]);
        }else{
            return redirect()->route('billing');
        }
    }

    public function invoiceDelete(Request $request){
        $invoice = invoice::find($request->id);
        if($invoice){
            $data = $invoice->makeHidden('complex_data')->toarray();
            return view('billing.delete-bill')->with(['data' => $data]);
        }else{
            return redirect()->route('billing');
        }
    }

    public function Update(Request $request){

        date_default_timezone_set("Asia/Calcutta");

        $complexDataArray = array();

        for($i = 0; $i < count(request()->date); $i++){
            $complexDataArray[$i] = [
                'date' => request()->date[$i],
                'vehicle' => request()->vehicle[$i],
                'from_to' => request()->from_to[$i],
                'particular' => request()->particular[$i],
                'material' => request()->material[$i],
                'frieght' => request()->frieght[$i],
                'halting' => request()->halting[$i],
                'other' => request()->other[$i],
                'deduction' => request()->deduction[$i],
                'trip' => request()->trip[$i],
                'advance' => request()->advance[$i],
                'balance' => request()->balance[$i],
            ];
        }

        $requested_data = request()->all();
        unset($requested_data['_token']);
        unset($requested_data['id']);
        $requested_data['complex_data'] = json_encode($complexDataArray);

        
        $invoice = invoice::find($request->id);
        foreach($invoice->makeHidden('id','created_at','updated_at')->toarray() as $key => $data){
            $invoice[$key] = trim($requested_data[$key]);
        }

        if($invoice->save()){
            $response = [
                'success' => true,
                'message' => 'Updated successfully'
            ];

            return response()->json($response, 200); 
        }else{
            $response = [
                'success' => false,
                'message' => 'Internal Server Error'
            ];

            return response()->json($response, 500); 
        }

    }

    public function Save(Request $request){

        $validator = $request->validate([
            'billed_to' => 'required|min:3'
        ],[
            'billed_to.required' => "The vender name to field is required",
            'billed_to.min' => "The vender name to field must be at least 3 characters."
        ]);

        date_default_timezone_set("Asia/Calcutta");
        $requested_data = request()->all();
        $invoice = invoice::create($requested_data);
        return redirect()->route('billing');

    }

    public function InvoiceShared(Request $request){
        $invoice = invoice::find($request->id);
        if($invoice){

            $defaultid = default_profile::find(1);

            $defaultdetails = profiles::find($defaultid->default);

            if($defaultdetails){
                $defaultdetailsisdata = true;
                $defaultdetailsdata = $defaultdetails->toArray(); 
            }else{
                $defaultdetailsisdata = false;
                $defaultdetailsdata = null; 
            }

            $invoice_data = $invoice->toarray();
            $invoice_data['complex_data'] = json_decode($invoice['complex_data'], true);
            return view('billing.bill')->with(['id'=>$request->id, 'data' => $invoice_data,'isDefault'=>$defaultdetailsisdata,'defaultData'=>$defaultdetailsdata]);
        }else{
            return redirect()->route('billing');
        }
    }

    public function Delete(Request $request){
        $invoice = invoice::find(trim($request->id));
        if($invoice){
            if($invoice->delete()){
                return redirect()->route('billing')->with(['delete'=> true, 'message-deleted'=> "Invoice has been deleted successfully."]);
            }else{
                return redirect()->route('billing')->with(['delete'=> false, 'message-deleted'=> "Unable to delete invoice."]);
            }
        }else{
            return redirect()->route('billing')->with(['delete'=> false, 'message-deleted'=> "Unable to delete invoice."]);
        }
    }
}
