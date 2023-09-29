<?php

namespace App\Http\Controllers;

use App\Models\invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

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
            $invoice_data = $invoice->toarray();
            $invoice_data['complex_data'] = json_decode($invoice['complex_data'], true);
            return view('billing.invoice-editor')->with(['id'=>$request->id, 'invoice_data' => $invoice_data]);
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
}
