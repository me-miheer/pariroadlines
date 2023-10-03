@extends('welcome')

@push('title','Invoice Editor -')

@php
    $account_name = ($isDefault)?$defaultData['name']:'';
    $account_number = ($isDefault)?$defaultData['account_number']:'';
    $ifsc_code = ($isDefault)?$defaultData['ifsc_code']:'';
    $bank_name = ($isDefault)?$defaultData['bank_name']:'';
    $pancard_number = ($isDefault)?$defaultData['pancard_number']:'';
@endphp

@php
    date_default_timezone_set("Asia/Calcutta");
@endphp

@section('body')

    <style>
        /* Chrome, Safari, Edge, Opera */
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
        }

        /* Firefox */
        input[type=number] {
        -moz-appearance: textfield;
        }
        input{
            border-radius: 0 !important;
        }
        .input-group{
            border: 0 black solid !important;
        }
        .input-group-text{
            border: 0 black solid !important;
        }
        .form-control{
            border: 0 black solid !important;
        }
        body{
            min-width: 1042px;
        }
        .success-message{
            top:0;
            z-index: 99999999999 !important;
            left: 0;
            right: 0;
            background-color: #86c1a56e !important
        }
    </style>

    <div class="success-message alert alert-success mt-5 d-none" id="displayLoader" style="width: min-content; display: flex; justify-content: center; align-items: center; margin: auto; position: fixed;">
        <div class="spinner-border text-light" role="status">
            <span class="visually-hidden">Loading...</span>
          </div>&nbsp;&nbsp;Updating
    </div>
    <!-- As a link -->
    @include('billing.includes.navbar')

    <form action="javascript:void(0)" class="m-auto mt-4 ms-2 me-2 mb-2" style="font-size: 14px;" method="POST">
        @csrf
        <input type="hidden" name="id" value="{{$id}}">
       <div class="row m-0 p-0">
        <div class="col-8">
            <strong>BILL INVOICE NUMBER : </strong>@php $yearHeader = ( date('m') > 6) ? date('Y') + 1 : date('Y'); echo substr(($yearHeader-1), -2); echo '-'; echo substr($yearHeader, -2); @endphp/PRL{{$invoice_data['id']}}
        </div>
        <div class="col-4" style="text-align: right;">
            <strong>Date :</strong>{{date('d/m/Y h:i A')}}
        </div>
       </div>
       <hr>
       <div class="row mt-3">
            <div class="col-6">
                <table class="table table-bordered border-dark">
                    <tr>
                        <th class="p-0 m-0">
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><strong>BILLED TO :</strong></span>
                                <input type="text" class="form-control" onfocusout="doSubmit()"  placeholder="" name="billed_to" aria-label="Username" aria-describedby="basic-addon1" value="{{$invoice_data['billed_to']}}">
                            </div>
                        </th>
                    </tr>
                    <tr>
                        <th class="p-0 m-0">
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><strong>ADDRESS :</strong></span>
                                <input type="text" class="form-control" onfocusout="doSubmit()"   placeholder="" name="address" aria-label="Username" aria-describedby="basic-addon1" value="{{$invoice_data['address']}}">
                            </div>
                        </th>
                    </tr>
                    <tr>
                        <th class="p-0 m-0">
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><strong>GSTIN :</strong></span>
                                <input type="text" class="form-control" onfocusout="doSubmit()"   placeholder="" name="gstin" aria-label="Username" aria-describedby="basic-addon1" value="{{$invoice_data['gstin']}}">
                            </div>
                        </th>
                    </tr>
                </table>
            </div>
            <div class="col-6" style="display: flex; justify-content: center; align-items: center;">
                <button class="btn btn-info" style=" font-size: 50px;" onclick="location.href='{{route('invoice-share',$id)}}'"><i class="bi bi-printer"></i></button>
            </div>
       </div>
       <hr>
       <div class="row m-0 p-0">
        <table class="table table-bordered border-dark">
            <thead>
                <tr>
                    <th class="text-center">DATE/LR/ BILTY NUMBER</th>
                    <th class="text-center">VEHICLE NO./ PARTY BILL/ INVOICE NO.</th>
                    <th class="text-center">FROM - TO</th>
                    <th class="text-center">PARTICULAR</th>
                    <th class="text-center">MATERIAL NAME</th>
                    <th class="text-center">FRIEGHT AMOUNT</th>
                    <th class="text-center">HALTING CHARGES</th>
                    <th class="text-center">OTHER CHARGES</th>
                    <th class="text-center">DEDUCTION AMOUNT</th>
                    <th class="text-center">TRIP AMOUNT</th>
                    <th class="text-center">ADVANCE AMOUNT</th>
                    <th class="text-center">BALANCE AMOUNT</th>
                </tr>
            </thead>
            <tbody class="adding-table-rows">
                @if (!empty($invoice_data['complex_data']))
                    @foreach ($invoice_data['complex_data'] as $data)
                        <tr class="table-rows">
                            <td class="p-0"><textarea type="text"  onfocusout="doSubmit()"   name="date[]" class="form-control m-0 p-0" style="min-width:79px; text-align: center" placeholder="" oninput="resizeTextArea(this)">{{$data['date']}}</textarea></td>
                            <td class="p-0"><textarea type="text"  onfocusout="doSubmit()"   name="vehicle[]" class="form-control m-0 p-0" style="min-width:79px; text-align: center" placeholder="" oninput="resizeTextArea(this)">{{$data['vehicle']}}</textarea></td>
                            <td class="p-0"><textarea type="text"  onfocusout="doSubmit()"   name="from_to[]" class="form-control m-0 p-0" style="min-width:79px; text-align: center" placeholder="" oninput="resizeTextArea(this)">{{$data['from_to']}}</textarea></td>
                            <td class="p-0"><textarea type="text"  onfocusout="doSubmit()"   name="particular[]" class="form-control m-0 p-0" style="min-width:79px; text-align: center" placeholder="" oninput="resizeTextArea(this)">{{$data['particular']}}</textarea></td>
                            <td class="p-0"><textarea type="text"  onfocusout="doSubmit()"   name="material[]" class="form-control m-0 p-0" style="min-width:79px; text-align: center" placeholder="" oninput="resizeTextArea(this)">{{$data['material']}}</textarea></td>
                            <td class="p-0"><textarea type="text"  onfocusout="doSubmit()"   name="frieght[]" class="form-control m-0 p-0" style="min-width:79px; text-align: center" placeholder="" oninput="resizeTextArea(this)">{{$data['frieght']}}</textarea></td>
                            <td class="p-0"><textarea type="text"  onfocusout="doSubmit()"   name="halting[]" class="form-control m-0 p-0" style="min-width:79px; text-align: center" placeholder="" oninput="resizeTextArea(this)">{{$data['halting']}}</textarea></td>
                            <td class="p-0"><textarea type="text"  onfocusout="doSubmit()"   name="other[]" class="form-control m-0 p-0" style="min-width:79px; text-align: center" placeholder="" oninput="resizeTextArea(this)">{{$data['other']}}</textarea></td>
                            <td class="p-0"><textarea type="text"  onfocusout="doSubmit()"   name="deduction[]" class="form-control m-0 p-0" style="min-width:79px; text-align: center" placeholder="" oninput="resizeTextArea(this)">{{$data['deduction']}}</textarea></td>
                            <td class="p-0"><textarea type="text"  onfocusout="doSubmit()"   name="trip[]" class="form-control m-0 p-0" style="min-width:79px; text-align: center" placeholder="" oninput="resizeTextArea(this)">{{$data['trip']}}</textarea></td>
                            <td class="p-0"><textarea type="text"  onfocusout="doSubmit()"   name="advance[]" class="form-control m-0 p-0" style="min-width:79px; text-align: center" placeholder="" oninput="resizeTextArea(this)">{{$data['advance']}}</textarea></td>
                            <td class="p-0"><textarea type="text"  onfocusout="doSubmit()"   name="balance[]" class="form-control m-0 p-0" style="min-width:79px; text-align: center" placeholder="" oninput="resizeTextArea(this)">{{$data['balance']}}</textarea></td>
                        </tr>
                    @endforeach
                @else
                    <tr class="table-rows">
                        <td class="p-0"><textarea type="text"  onfocusout="doSubmit()"   name="date[]" class="form-control m-0 p-0" style="min-width:79px; text-align: center" placeholder="" oninput="resizeTextArea(this)"></textarea></td>
                        <td class="p-0"><textarea type="text"  onfocusout="doSubmit()"   name="vehicle[]" class="form-control m-0 p-0" style="min-width:79px; text-align: center" placeholder="" oninput="resizeTextArea(this)"></textarea></td>
                        <td class="p-0"><textarea type="text"  onfocusout="doSubmit()"   name="from_to[]" class="form-control m-0 p-0" style="min-width:79px; text-align: center" placeholder="" oninput="resizeTextArea(this)"></textarea></td>
                        <td class="p-0"><textarea type="text"  onfocusout="doSubmit()"   name="particular[]" class="form-control m-0 p-0" style="min-width:79px; text-align: center" placeholder="" oninput="resizeTextArea(this)"></textarea></td>
                        <td class="p-0"><textarea type="text"  onfocusout="doSubmit()"   name="material[]" class="form-control m-0 p-0" style="min-width:79px; text-align: center" placeholder="" oninput="resizeTextArea(this)"></textarea></td>
                        <td class="p-0"><textarea type="text"  onfocusout="doSubmit()"   name="frieght[]" class="form-control m-0 p-0" style="min-width:79px; text-align: center" placeholder="" oninput="resizeTextArea(this)"></textarea></td>
                        <td class="p-0"><textarea type="text"  onfocusout="doSubmit()"   name="halting[]" class="form-control m-0 p-0" style="min-width:79px; text-align: center" placeholder="" oninput="resizeTextArea(this)"></textarea></td>
                        <td class="p-0"><textarea type="text"  onfocusout="doSubmit()"   name="other[]" class="form-control m-0 p-0" style="min-width:79px; text-align: center" placeholder="" oninput="resizeTextArea(this)"></textarea></td>
                        <td class="p-0"><textarea type="text"  onfocusout="doSubmit()"   name="deduction[]" class="form-control m-0 p-0" style="min-width:79px; text-align: center" placeholder="" oninput="resizeTextArea(this)"></textarea></td>
                        <td class="p-0"><textarea type="text"  onfocusout="doSubmit()"   name="trip[]" class="form-control m-0 p-0" style="min-width:79px; text-align: center" placeholder="" oninput="resizeTextArea(this)"></textarea></td>
                        <td class="p-0"><textarea type="text"  onfocusout="doSubmit()"   name="advance[]" class="form-control m-0 p-0" style="min-width:79px; text-align: center" placeholder="" oninput="resizeTextArea(this)"></textarea></td>
                        <td class="p-0"><textarea type="text"  onfocusout="doSubmit()"   name="balance[]" class="form-control m-0 p-0" style="min-width:79px; text-align: center" placeholder="" oninput="resizeTextArea(this)"></textarea></td>
                    </tr>
                @endif
            </tbody>
        </table>
       </div>
       <div class="row p-0 m-0">
        <h6 style="font:bold; text-align:right;" style="font-size: 25px;"><i class="bi bi-plus btn btn-secondary" onclick="add_table_rows()"></i></h6>
       </div>
       <div class="row p-0 m-0">
        <table class="table table-bordered border-dark">
            <tbody>
                <tr>
                    <td class="p-0 m-0">
                        <div class="input-group input-group-shadow">
                            <span class="input-group-text" id="basic-addon1"><strong>HSN/SAC :</strong></span>
                            <input type="text" class="form-control" onfocusout="doSubmit()" value="{{$invoice_data['hsn']}}"   placeholder="" name="hsn" aria-label="Username" aria-describedby="basic-addon1">
                        </div>
                    </td>
                    <td style="font-weight: 600">
                        TOTAL TRIP AMOUNT
                    </td>
                    <td style="font-weight: 600">
                        <input type="text" name="trip_total" onfocusout="doSubmit()" value="{{$invoice_data['trip_total']}}"   class="form-control m-0 p-0" style="min-width:79px" placeholder="">
                    </td>
                </tr>
                <tr>
                    <td rowspan="3" class="p-0 m-0">
                        <div class="input-group input-group-shadow">
                            <span class="input-group-text" id="basic-addon1"><strong>REMARKS :</strong></span>
                            <textarea type="text" onfocusout="doSubmit()" value="{{$invoice_data['remark']}}"  class="form-control" name="remark" placeholder="" aria-label="Username" aria-describedby="basic-addon1" oninput='this.style.height = "";this.style.height = this.scrollHeight + "px"'></textarea>
                        </div>
                    </td>
                    <td style="font-weight: 600">
                        INVOICE VALUE
                    </td>
                    <td style="font-weight: 600">
                        <input type="text" onfocusout="doSubmit()"   class="form-control m-0 p-0" value="{{$invoice_data['invoice_value']}}" name="invoice_value" style="min-width:79px" placeholder="">
                    </td>
                </tr>
                <tr>
                    <td style="font-weight: 600">
                        TOTAL ADVANCE RECIEVED
                    </td>
                    <td style="font-weight: 600">
                        <input type="text" onfocusout="doSubmit()"   class="form-control m-0 p-0"  value="{{$invoice_data['total_advance']}}" name="total_advance" style="min-width:79px" placeholder="">
                    </td>
                </tr>
                <tr>
                    <td style="font-weight: 600">
                        BALANCE AMOUNT
                    </td>
                    <td style="font-weight: 600">
                        <input type="text" onfocusout="doSubmit()"   class="form-control m-0 p-0"  value="{{$invoice_data['balance_amount']}}" name="balance_amount" style="min-width:79px" placeholder="">
                    </td>
                </tr>
                <tr>
                    <td class="p-0 m-0">
                        <div class="input-group input-group-shadow">
                            <span class="input-group-text" id="basic-addon1"><strong>AMOUNT IN WORDS :</strong></span>
                            <input type="text" onfocusout="doSubmit()"   class="form-control" placeholder="" value="{{$invoice_data['amount_in_words']}}" name="amount_in_words" id="amount_in_words" aria-label="Username" aria-describedby="basic-addon1">
                        </div>
                    </td>
                    <td style="font-weight: 600">
                        NET PAYABLE AMOUNT
                    </td>
                    <td style="font-weight: 600">
                        <input type="text" onfocusout="doSubmit()" onkeyup="toWords(this.value)" onkeydown="toWords(this.value)" class="form-control m-0 p-0"  value="{{$invoice_data['net_payble_amount']}}" name="net_payble_amount" style="min-width:79px" placeholder="">
                    </td>
                </tr>
                <tr>
                    <td colspan="3" class="p-0 m-0">
                        <div class="input-group input-group-shadow">
                            <span class="input-group-text" id="basic-addon1"><strong>GST PLABLE ON REVERES CHARGES (TOTAL TAX AMOUNT) :</strong></span>
                            <input type="text" onfocusout="doSubmit()"   class="form-control" placeholder=""   value="{{$invoice_data['reverse_charge']}}" name="reverse_charge" aria-label="Username" aria-describedby="basic-addon1">
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
       </div>
       <div class="row p-0 m-0">
        <table class="table table-bordered border-dark">
            <tr>
                <th>
                    <p>1.ALL DISPUTE SUBJECT TO OUR LOCALJURISDICTION<br><br>2.GSTIN PAYBLE BY CONSIGNOR / CONSIGNEE /<br>TRANSPORTER<br><br>3.PENENLTY / INTEREST WILL CHARGED IF BILL IS NOT PAID ON<br>PRESENTATION.</p>
                </th>
                <th>
                    <table class="table">
                        <tr class="m-0 p-0">
                            <th class="m-0 p-0">
                                <div class="input-group input-group-shadow">
                                    <span class="input-group-text" id="basic-addon1"><strong>ACCOUNT NAME :</strong></span>
                                    <input type="text" onfocusout="doSubmit()"   class="form-control" placeholder=""   value="{{(!empty($invoice_data['account_name']))?$invoice_data['account_name']:$account_name}}" name="account_name" aria-label="Username" aria-describedby="basic-addon1">
                                </div>
                            </th>
                        </tr>
                        <tr class="m-0 p-0" >
                            <th class="m-0 p-0">
                                <div class="input-group input-group-shadow">
                                    <span class="input-group-text" id="basic-addon1"><strong>ACCOUNT NUMBER :</strong></span>
                                    <input type="text" onfocusout="doSubmit()"   class="form-control" placeholder=""   value="{{(!empty($invoice_data['account_number']))?$invoice_data['account_number']:$account_number}}" name="account_number" aria-label="Username" aria-describedby="basic-addon1">
                                </div>
                            </th>
                        </tr>
                        <tr class="m-0 p-0">
                            <th class="m-0 p-0">
                                <div class="input-group input-group-shadow">
                                    <span class="input-group-text" id="basic-addon1"><strong>IFSC CODE :</strong></span>
                                    <input type="text" onfocusout="doSubmit()"   class="form-control" placeholder=""   value="{{(!empty($invoice_data['ifsc_code']))?$invoice_data['ifsc_code']:$ifsc_code}}" name="ifsc_code" aria-label="Username" aria-describedby="basic-addon1">
                                </div>
                            </th>
                        </tr>
                        <tr class="m-0 p-0">
                            <th class="m-0 p-0">
                                <div class="input-group input-group-shadow">
                                    <span class="input-group-text" id="basic-addon1"><strong>BANK NAME :</strong></span>
                                    <input type="text" onfocusout="doSubmit()"   class="form-control" placeholder=""   value="{{(!empty($invoice_data['bank_name']))?$invoice_data['bank_name']:$bank_name}}" name="bank_name" aria-label="Username" aria-describedby="basic-addon1">
                                </div>
                            </th>
                        </tr>
                        <tr class="m-0 p-0">
                            <th class="m-0 p-0">
                                <div class="input-group input-group-shadow">
                                    <span class="input-group-text" id="basic-addon1"><strong>PANCARD NUMBER :</strong></span>
                                    <input type="text" onfocusout="doSubmit()"   class="form-control" placeholder=""   value="{{(!empty($invoice_data['pancard_number']))?$invoice_data['pancard_number']:$pancard_number}}" name="pancard_number" aria-label="Username" aria-describedby="basic-addon1">
                                </div>
                            </th>
                        </tr>
                    </table>
                </th>
                <th style="min-width: 400px;">
                    
                </th>
            </tr>
        </table>
       </div>
    </form>


    <script>
        function doSubmit(){
            $('#displayLoader').removeClass('d-none');
            const xhttp = new XMLHttpRequest();
            xhttp.onload = function() {
                setTimeout(() => {
                    $('#displayLoader').addClass('d-none');
                }, 200);
            }
            xhttp.open("POST", "{{route('update-bill')}}");
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send($('form').serialize());
        }

        function add_table_rows(){
            $('.adding-table-rows').append('<tr class="table-rows">\
                        <td class="p-0"><textarea type="text"  onfocusout="doSubmit()"   name="date[]" class="form-control m-0 p-0" style="min-width:79px; text-align: center" placeholder="" oninput="resizeTextArea(this)"></textarea></td>\
                        <td class="p-0"><textarea type="text"  onfocusout="doSubmit()"   name="vehicle[]" class="form-control m-0 p-0" style="min-width:79px; text-align: center" placeholder="" oninput="resizeTextArea(this)"></textarea></td>\
                        <td class="p-0"><textarea type="text"  onfocusout="doSubmit()"   name="from_to[]" class="form-control m-0 p-0" style="min-width:79px; text-align: center" placeholder="" oninput="resizeTextArea(this)"></textarea></td>\
                        <td class="p-0"><textarea type="text"  onfocusout="doSubmit()"   name="particular[]" class="form-control m-0 p-0" style="min-width:79px; text-align: center" placeholder="" oninput="resizeTextArea(this)"></textarea></td>\
                        <td class="p-0"><textarea type="text"  onfocusout="doSubmit()"   name="material[]" class="form-control m-0 p-0" style="min-width:79px; text-align: center" placeholder="" oninput="resizeTextArea(this)"></textarea></td>\
                        <td class="p-0"><textarea type="text"  onfocusout="doSubmit()"   name="frieght[]" class="form-control m-0 p-0" style="min-width:79px; text-align: center" placeholder="" oninput="resizeTextArea(this)"></textarea></td>\
                        <td class="p-0"><textarea type="text"  onfocusout="doSubmit()"   name="halting[]" class="form-control m-0 p-0" style="min-width:79px; text-align: center" placeholder="" oninput="resizeTextArea(this)"></textarea></td>\
                        <td class="p-0"><textarea type="text"  onfocusout="doSubmit()"   name="other[]" class="form-control m-0 p-0" style="min-width:79px; text-align: center" placeholder="" oninput="resizeTextArea(this)"></textarea></td>\
                        <td class="p-0"><textarea type="text"  onfocusout="doSubmit()"   name="deduction[]" class="form-control m-0 p-0" style="min-width:79px; text-align: center" placeholder="" oninput="resizeTextArea(this)"></textarea></td>\
                        <td class="p-0"><textarea type="text"  onfocusout="doSubmit()"   name="trip[]" class="form-control m-0 p-0" style="min-width:79px; text-align: center" placeholder="" oninput="resizeTextArea(this)"></textarea></td>\
                        <td class="p-0"><textarea type="text"  onfocusout="doSubmit()"   name="advance[]" class="form-control m-0 p-0" style="min-width:79px; text-align: center" placeholder="" oninput="resizeTextArea(this)"></textarea></td>\
                        <td class="p-0"><textarea type="text"  onfocusout="doSubmit()"   name="balance[]" class="form-control m-0 p-0" style="min-width:79px; text-align: center" placeholder="" oninput="resizeTextArea(this)"></textarea></td>\
                    </tr>');
        }

        function resizeTextArea(input){
            input.style.height = "";input.style.height = input.scrollHeight + "px"
        }

        var a = ['','one ','two ','three ','four ', 'five ','six ','seven ','eight ','nine ','ten ','eleven ','twelve ','thirteen ','fourteen ','fifteen ','sixteen ','seventeen ','eighteen ','nineteen '];
        var b = ['', '', 'twenty','thirty','forty','fifty', 'sixty','seventy','eighty','ninety'];

        function inWords (num) {
            if ((num = num.toString()).length > 9) return 'overflow';
            n = ('000000000' + num).substr(-9).match(/^(\d{2})(\d{2})(\d{2})(\d{1})(\d{2})$/);
            if (!n) return; var str = '';
            str += (n[1] != 0) ? (a[Number(n[1])] || b[n[1][0]] + ' ' + a[n[1][1]]) + 'crore ' : '';
            str += (n[2] != 0) ? (a[Number(n[2])] || b[n[2][0]] + ' ' + a[n[2][1]]) + 'lakh ' : '';
            str += (n[3] != 0) ? (a[Number(n[3])] || b[n[3][0]] + ' ' + a[n[3][1]]) + 'thousand ' : '';
            str += (n[4] != 0) ? (a[Number(n[4])] || b[n[4][0]] + ' ' + a[n[4][1]]) + 'hundred ' : '';
            str += (n[5] != 0) ? ((str != '') ? 'and ' : '') + (a[Number(n[5])] || b[n[5][0]] + ' ' + a[n[5][1]]) : '';
            return str;
        }

        function toWords(val){
            if(val.trim() != null){
                let wordData = inWords(val);
                if(wordData =='overflow'){
                    $('#amount_in_words').val('')
                }else{
                    $('#amount_in_words').val(wordData+"rupees only")
                }
            }
        }
    </script>
@endsection