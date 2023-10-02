@extends('welcome')

@push('title','New Billl -')

@section('body')

    @include('billing.includes.navbar')

    <form class="container mt-4" action="{{route('save-bill')}}" method="POST">
        <h2><b>New Bill</b></h2>
        <hr>
        @csrf
        <span class="text-danger">
            @error('billed_to')
                {{$message}}
            @enderror
        </span>
        <input type="text" class="form-control" name="billed_to" placeholder="Vender name" value="{{old('billed_to')}}">
        <button class="btn text-light mt-4" style="background-color: tomato">
            Generate new invoice
        </button>
    </form>
@endsection