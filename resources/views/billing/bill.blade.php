@extends('welcome')

@push('title', 'Bills @')

@php
    $account_name = ($isDefault)?$defaultData['name']:'__name__';
    $account_number = ($isDefault)?$defaultData['account_number']:'';
    $ifsc_code = ($isDefault)?$defaultData['ifsc_code']:'';
    $bank_name = ($isDefault)?$defaultData['bank_name']:'';
    $pancard_number = ($isDefault)?$defaultData['pancard_number']:'';
    $address = ($isDefault)?$defaultData['address']:'__address__';
    $mobile1 = ($isDefault)?$defaultData['mobile1']:'__mobile_no__';
    $mobile2 = ($isDefault)?$defaultData['mobile2']:'__mobile_no__';
    $gst = ($isDefault)?$defaultData['gst']:'__gstin__';
    $logo = ($isDefault)?$defaultData['logo']:'';
    $signature = ($isDefault)?$defaultData['signature']:'';
    $email = ($isDefault)?$defaultData['email']:'__email__';
@endphp

@php
    date_default_timezone_set("Asia/Calcutta");
@endphp

@section('body')
    <div class="bill container pb-5 bg-light mt-4" style="min-width: 1042px;">
        {{-- Header --}}
        <section class="header m-0 p-0">
            <div class="row m-0 p-0 mb-5">
                <div class="col-3-p-0 m-0"><img src="{{asset('storage/logo/'.$logo)}}" class="p-0 m-0" alt="logo" style="width: 70px; height: 70px; margin-bottom: -30px !important;"></div>
                <div class="col-3-p-0 m-0 text-center" style="margin-top: -50px !important;"><h3><b>TAX INVOICE</b></h3></div>
                <div class="col-3-p-0 m-0"></div>
            </div>
            <div class="row m-0 p-0">
                <div class="col-6 m-0 p-0">
                    <h3><b>{{$account_name}}</b></h3>
                </div>
                <div class="col-6 m-0 p-0" style="text-align: right">
                    <b>Mobile no. :</b> {{$mobile1}} <br> {{$mobile2}}
                </div>
            </div>
            <div class="row p-0 m-0">
                {{$address}}
            </div>
            <div class="row p-0 m-0">
                <div class="col-6 m-0 p-0">
                    {{$email}}
                </div>
                <div class="col-6 m-0 p-0" style="text-align: right">
                    <b>GSTIN : </b>{{$gst}}
                </div>
            </div>
        </section>
        <hr>
        {{-- row 1 --}}
        <div class="row m-0 p-0">
            <div class="col-6 p-0 m-0" style="text-align: left">
                <b>BILL INVOICE NUMBER : </b>@php $yearHeader = ( date('m') > 6) ? date('Y') + 1 : date('Y'); echo substr(($yearHeader-1), -2); echo '/'; echo substr($yearHeader, -2); @endphp/PRL{{$data['id']}}
            </div>
            <div class="col-6 p-0 m-0" style="text-align: right">
                <b>Date :</b> {{date('d/m/Y h:i A')}}
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
                            <button type="button" class="btn m-0 p-0">{{(!empty($data['account_name']))?$data['account_name']:$account_name}}</button>
                        </div>
                        <div class="btn-group m-0 p-0" role="group" aria-label="Basic example">
                            <button type="button" class="btn m-0 p-0"><b>ACCOUNT NUMBER :</b></button>
                            <button type="button" class="btn m-0 p-0">{{(!empty($data['account_number']))?$data['account_number']:$account_number}}</button>
                        </div><br>
                        <div class="btn-group m-0 p-0" role="group" aria-label="Basic example">
                            <button type="button" class="btn m-0 p-0"><b>IFSC CODE :</b></button>
                            <button type="button" class="btn m-0 p-0">{{(!empty($data['ifsc_code']))?$data['ifsc_code']:$ifsc_code}}</button>
                        </div><br>
                        <div class="btn-group m-0 p-0" role="group" aria-label="Basic example">
                            <button type="button" class="btn m-0 p-0"><b>BANK NAME :</b></button>
                            <button type="button" class="btn m-0 p-0">{{(!empty($data['bank_name']))?$data['bank_name']:$bank_name}}</button>
                        </div><br>
                        <div class="btn-group m-0 p-0" role="group" aria-label="Basic example">
                            <button type="button" class="btn m-0 p-0"><b>PANCARD NUMBER :</b></button>
                            <button type="button" class="btn m-0 p-0">{{(!empty($data['pancard_number']))?$data['pancard_number']:$pancard_number}}</button>
                        </div>
                    </td>
                    <th class="p-4">
                        <p class="m-0 p-0" style="font-size: 12px; opacity: 0.3;">
                            AUTHORIZED SIGNATORY
                        </p>
                        <div class="for" style="position: relative; top: 0; bottom: 0; left: 0; right: 0; z-index: 2 !important; font-size: 12px;">
                            for , PARI ROAD LINES <br> <img src="{{asset('storage/signature/'.$signature)}}" alt="sign" style="height: 80px; width: 200px;">
                        </div>
                    </th>
                </tr>
            </table>
        </div>
    </div>
@endsection