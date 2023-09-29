@extends('welcome')
@php
    $i = 0;
@endphp
@push('title','Billing -')

@section('body')
<style>
    ul{
        list-style-type: none
    }
    a{
        text-decoration: none
    }
</style>
    <section class="container m-auto mt-4">
        <nav class="navbar bg-body-tertiary" style="background-color: tomato">
            <div class="container-fluid">
              <a class="navbar-brand"><b>Pari road lines</b></a>
              <form class="d-flex" role="search">
                <a href="{{route('new-bill')}}" class="btn text-light" style="background-color: tomato; font-size: 20px" type="submit"><i class="bi bi-plus"></i></a>
              </form>
            </div>
          </nav>

          <hr>
          @if (Session::get('delete'))
            @if (Session::get('delete'))
            <div class="alert alert-success">
                {{Session::get('message-deleted')}}
            </div>
            @else
            <div class="alert alert-danger">
                
            </div>
            @endif
          @endif

          <ul class="m-0 p-0 mb-3 mt-2">
            @foreach ($data as $invoice)
            <li class="m-0 p-0 mt-3">
                <a class="row m-0 p-0">
                    <div class="card p-0">
                        <p class="d-inline-flex gap-1">
                            <div style="font-size: 40px">
                                <div class="row">
                                    <div class="col-6" style="display: flex; justify-content: center; align-items: center; color: tomato">
                                        <i class="bi bi-receipt"></i>
                                    </div>
                                    <div class="col-6" style="display: flex; justify-content: center; align-items: center;">
                                        <b>₹ {{(!empty($invoice['net_payble_amount']))?$invoice['net_payble_amount']:"0.00"}}</b>
                                    </div>
                                </div>
                                <div class="row ps-4 mt-3 alert alert-primary" style="font-size: 14px;">
                                    Vender name :
                                    <hr class="m-0 p-0"><b class="m-0 p-0" style="font-size: 17px">{{$invoice['billed_to']}}</b>
                                </div>
                                <div class="row mt-2 m-0">
                                    <div class="col-6" style="font-size: 12px">
                                        Generated At : {{date('d/m/Y h:i A',strtotime($invoice['created_at']))}}
                                    </div>
                                    <div class="col-6" style="text-align: right" style="font-size: 14px;">
                                        <i class="bi bi-chevron-down btn text-light" style="background-color: tomato;"  type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample{{$i}}" aria-expanded="false" aria-controls="collapseExample"></i>
                                    </div>
                                </div>
                            </div>
                          </p>
                          <div class="collapse" id="collapseExample{{$i}}">
                            <div class="card card-body">
                                <div class="row">
                                    <div class="col-3" style="text-align: center">
                                        <i class="bi bi-eye btn btn-dark"  onclick="location.href='{{route('invoice-editor',$invoice['id'])}}'"></i>
                                    </div>
                                    <div class="col-3" style="text-align: center">
                                        <i class="bi bi-printer btn btn-warning"></i>
                                    </div>
                                    <div class="col-3" style="text-align: center">
                                        <i class="bi bi-share btn btn-success"  onclick="sharemyinvoice('{{$invoice['id']}}','{{$invoice['billed_to']}}')"></i>
                                    </div>
                                    <div class="col-3" style="text-align: center">
                                        <i class="bi bi-trash btn btn-danger"   onclick="location.href='{{route('invoice-delete',$invoice['id'])}}'"></i>
                                    </div>
                                </div>
                            </div>
                          </div>
                    </div>
                </a>
            </li>
            @php
                $i++;
            @endphp
            @endforeach
          </ul>
    </section>

    <script>
        function sharemyinvoice(id,billed_to){
            if (navigator.share) {
                navigator.share({
                    title: "Invoice for - "+billed_to,
                    text: 'Bill no. : '+id+", Bill URL : ",
                    url: "{{url('invoice')}}/"+id
                })
                    .then(() => console.log('Successful share'))
                    .catch((error) => console.log('Error sharing', error));
            }
        }
    </script>
@endsection