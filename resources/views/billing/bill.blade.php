@extends('welcome')

@push('title', 'PRL1 -')

@php
    date_default_timezone_set("Asia/Calcutta");
@endphp

@section('body')
    <div class="bill container pb-5 bg-light" style="min-width: 1042px;">
        {{-- row 1 --}}
        <div class="row m-0 p-0">
            <div class="col-6 p-0 m-0" style="text-align: left">
                <b>BILL INVOICE NUMBER : </b>@php $yearHeader = ( date('m') > 6) ? date('Y') + 1 : date('Y'); echo substr(($yearHeader-1), -2); echo '-'; echo substr($yearHeader, -2); @endphp/PRL{{$data['id']}}
            </div>
            <div class="col-6 p-0 m-0" style="text-align: right">
                <b>Date :</b> {{date('d/m/Y h:i A', strtotime($data['updated_at']))}}
            </div>
        </div>

        <hr>
        {{-- row 2 --}}
        <div class="row p-0 m-0 mt-3">
            <div class="col-6 p-0 m-0">
                <table class="table table-bordered border-dark p-0 m-0">
                    <tr class=" p-0 m-0">
                        <th class=" p-0 m-0"><b>BILLED TO : </b></th>
                        <td class=" p-0 m-0">{{$data['billed_to']}}</td>
                    </tr>
                    <tr class=" p-0 m-0">
                        <th class=" p-0 m-0"><b>ADDRESS : </b></th>
                        <td class=" p-0 m-0">{{$data['address']}}</td>
                    </tr>
                    <tr class=" p-0 m-0">
                        <th class=" p-0 m-0"><b>GSTIN : </b></th>
                        <td class=" p-0 m-0">{{$data['gstin']}}</td>
                    </tr>
                </table>
            </div>
        </div>

        <hr>
        {{-- row 3 --}}
        <div class="row p-0 m-0 mt-3">
            <table class="table table-bordered border-dark p-0 m-0">
                <tr class=" p-0 m-0">
                    <th class="text-center p-0 m-0">DATE/LR/ BILTY NUMBER</th>
                    <th class="text-center p-0 m-0">VEHICLE NO./ PARTY BILL/ INVOICE NO.</th>
                    <th class="text-center p-0 m-0">FROM - TO</th>
                    <th class="text-center p-0 m-0">PARTICULAR</th>
                    <th class="text-center p-0 m-0">MATERIAL NAME</th>
                    <th class="text-center p-0 m-0">FRIEGHT AMOUNT</th>
                    <th class="text-center p-0 m-0">HALTING CHARGES</th>
                    <th class="text-center p-0 m-0">OTHER CHARGES</th>
                    <th class="text-center p-0 m-0">DEDUCTION AMOUNT</th>
                    <th class="text-center p-0 m-0">TRIP AMOUNT</th>
                    <th class="text-center p-0 m-0">ADVANCE AMOUNT</th>
                    <th class="text-center p-0 m-0">BALANCE AMOUNT</th>
                </tr>
                @if (!empty($data['complex_data']))
                    @foreach ($data['complex_data'] as $item)
                        <tr>
                            <td class="text-center">{{$item['date']}}</td>
                            <td class="text-center">{{$item['vehicle']}}</td>
                            <td class="text-center">{{$item['from_to']}}</td>
                            <td class="text-center">{{$item['particular']}}</td>
                            <td class="text-center">{{$item['material']}}</td>
                            <td class="text-center">{{(!empty($item['frieght']))?$item['frieght']:"0.00"}}</td>
                            <td class="text-center">{{(!empty($item['halting']))?$item['halting']:"0.00"}}</td>
                            <td class="text-center">{{(!empty($item['other']))?$item['other']:"0.00"}}</td>
                            <td class="text-center">{{(!empty($item['deduction']))?$item['deduction']:"0.00"}}</td>
                            <td class="text-center">{{(!empty($item['trip']))?$item['trip']:"0.00"}}</td>
                            <td class="text-center">{{(!empty($item['advance']))?$item['advance']:"0.00"}}</td>
                            <td class="text-center">{{(!empty($item['balance']))?$item['balance']:"0.00"}}</td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td class="text-center"></td>
                        <td class="text-center"></td>
                        <td class="text-center"></td>
                        <td class="text-center"></td>
                        <td class="text-center"></td>
                        <td class="text-center">0.00</td>
                        <td class="text-center">0.00</td>
                        <td class="text-center">0.00</td>
                        <td class="text-center">0.00</td>
                        <td class="text-center">0.00</td>
                        <td class="text-center">0.00</td>
                        <td class="text-center">0.00</td>
                    </tr>
                @endif
            </table>
        </div>
        {{-- row 3 --}}
        <div class="row p-0 m-0 mt-5">
            <table class="table table-bordered border-dark p-0 m-0">
                <tr>
                    <th class="m-0 p-0 p-1" colspan="2"><b>HSN/SAC : </b>{{$data['hsn']}}</th>
                    <th class="m-0 p-0 p-1">TOTAL TRIP AMOUNT</th>
                    <th class="m-0 p-0 p-1">{{!empty($data['trip_total'])?$data['trip_total']:"0.00"}}</th>
                </tr>
                <tr>
                    <th class="m-0 p-0 p-1" colspan="2" rowspan="3"><b>REMARK : </b>{{$data['remark']}}</th>
                    <th class="m-0 p-0 p-1">INVOICE VALUE</th>
                    <th class="m-0 p-0 p-1">{{!empty($data['invoice_value'])?$data['invoice_value']:"0.00"}}</th>
                </tr>
                <tr>
                    <th class="m-0 p-0 p-1">TOTAL ADVANCE RECIEVED</th>
                    <th class="m-0 p-0 p-1">{{!empty($data['total_advance'])?$data['total_advance']:"0.00"}}</th>
                </tr>
                <tr>
                    <th class="m-0 p-0 p-1">BALANCE AMOUNT</th>
                    <th class="m-0 p-0 p-1">{{!empty($data['balance_amount'])?$data['balance_amount']:"0.00"}}</th>
                </tr>
                <tr>
                    <th class="m-0 p-0 p-1" colspan="2"><b>AMOUNT IN WORDS : </b>{{$data['amount_in_words']}}</th>
                    <th class="m-0 p-0 p-1">NET PAYABLE AMOUNT	</th>
                    <th class="m-0 p-0 p-1">{{!empty($data['net_payble_amount'])?$data['net_payble_amount']:"0.00"}}</th>
                </tr>
                <tr>
                    <th class="m-0 p-0 p-1" colspan="4"><b>GST PLABLE ON REVERES CHARGES (TOTAL TAX AMOUNT) : </b>{{!empty($data['reverse_charge'])?$data['reverse_charge']:"0.00"}}</th>
                </tr>
            </table>
        </div>
        {{-- row 4 --}}
        <div class="row m-0 p-0 mt-3">
            <table class="m-0 table-bordered border-dark">
                <tr class="m-0 p-0">
                    <th class="p-4">
                        1.ALL DISPUTE SUBJECT TO OUR LOCALJURISDICTION<br><br>2.GSTIN PAYBLE BY CONSIGNOR / CONSIGNEE /<br>TRANSPORTER<br><br>3.PENENLTY / INTEREST WILL CHARGED IF BILL IS NOT PAID ON<br>PRESENTATION.
                    </th>
                    <td class="p-4">
                        <div class="btn-group m-0 p-0" role="group" aria-label="Basic example">
                            <button type="button" class="btn m-0 p-0"><b>ACCOUNT NAME :</b></button>
                            <button type="button" class="btn m-0 p-0">{{$data['account_name']}}</button>
                        </div>
                        <div class="btn-group m-0 p-0" role="group" aria-label="Basic example">
                            <button type="button" class="btn m-0 p-0"><b>ACCOUNT NUMBER :</b></button>
                            <button type="button" class="btn m-0 p-0">{{$data['account_number']}}</button>
                        </div><br>
                        <div class="btn-group m-0 p-0" role="group" aria-label="Basic example">
                            <button type="button" class="btn m-0 p-0"><b>IFSC CODE :</b></button>
                            <button type="button" class="btn m-0 p-0">{{$data['ifsc_code']}}</button>
                        </div><br>
                        <div class="btn-group m-0 p-0" role="group" aria-label="Basic example">
                            <button type="button" class="btn m-0 p-0"><b>BANK NAME :</b></button>
                            <button type="button" class="btn m-0 p-0">{{$data['bank_name']}}</button>
                        </div><br>
                        <div class="btn-group m-0 p-0" role="group" aria-label="Basic example">
                            <button type="button" class="btn m-0 p-0"><b>PANCARD NUMBER :</b></button>
                            <button type="button" class="btn m-0 p-0">{{$data['pancard_number']}}</button>
                        </div>
                    </td>
                    <th class="p-4" style=" opacity: 0.5;">
                        AUTHORIZED SIGNATORY
                    </th>
                </tr>
            </table>
        </div>
    </div>
@endsection