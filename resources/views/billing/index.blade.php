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
    .nav-list-hover:hover{
        background-color: ghostwhite;
    }
</style>
    <section class="container m-auto mt-4">
        <nav class="navbar bg-body-tertiary" style="background-color: tomato">
            <div class="container-fluid">
              <a class="navbar-brand bg-primary text-light" style="padding: 0px 10px;"><b>Pari Road Lines</b></a>
              <div class="d-flex">
                <a href="{{route('new-bill')}}" class="btn text-light" style="background-color: tomato; font-size: 20px" type="submit"><i class="bi bi-plus"></i></a>&nbsp;&nbsp;&nbsp;
                <a class="btn text-light" style="background-color: tomato; font-size: 20px" data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample"><i class="bi bi-list"></i></a>
              </div>
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
                                        <i class="bi bi-box-arrow-up-right btn btn-dark"  onclick="location.href='{{route('invoice-editor',$invoice['id'])}}'"></i>
                                    </div>
                                    <div class="col-3" style="text-align: center">
                                        <i class="bi bi-printer btn btn-warning" onclick="location.href='{{route('invoice-share',$invoice['id'])}}'"></i>
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


    {{-- Offcanvas  sidebar--}}
    <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasExampleLabel"><b>Menu</b></h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <hr>
        <div class="offcanvas-body">
          <div class="ul">
            <li style="list-style: none;" class="m-3">
                <a class="d-flex card border-2 p-2 nav-list-hover" href="{{route('profile')}}"><b style="font-size: 28px; cursor: pointer;" class="p-2"><i class="bi bi-people"></i> Profile</b></a>
            </li>
          </div>
        </div>
    </div>
    {{-- Offcanvas  sidebar--}}

    <script>
        function sharemyinvoice(id,billed_to){
            if (navigator.share) {
                navigator.share({
                    title: "Invoice for - "+billed_to,
                    text: 'Bill no. : PRL'+id+", Bill URL : ",
                    url: "{{url('billing/invoice')}}/"+id
                })
                    .then(() => console.log())
                    .catch((error) => console.log());
            }
        }
    </script>
@endsection