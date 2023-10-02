@extends('welcome')

@push('title','Delete Invoice -')

@section('body')
@include('billing.includes.navbar')

<form class="container mt-4" action="{{route('delete-bill')}}" method="POST">
    <h2><b>Are you sure?</b></h2>
    <hr>
    @csrf
    <input type="hidden" name="id" value="{{$data['id']}}">
    <div class="container mt-4">
        <div class="row text-center" style="color: tomato; font-size: 45px;">
            <i class="bi bi-receipt"></i>
        </div>
        <div class="alert alert-primary">
            <h4><b>{{$data['billed_to']}}</b></h4>
        </div>
        <div class="d-flex mb-3" style="justify-content: space-around; align-items: center">
            <button type="submit" class="btn btn-success" style="min-width: 100px;">
                <i class="bi bi-check-lg"></i>
            </button>
            <a class="btn btn-danger" href="{{route('billing')}}"  style="min-width: 100px;">
                <i class="bi bi-x"></i>
            </a>
        </div>
    </div>
</form>
@endsection