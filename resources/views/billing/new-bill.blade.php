@extends('welcome')

@push('title','New Billl -')

@section('body')

    <nav class="navbar bg-dark border-bottom border-body" data-bs-theme="dark">
        <div class="container-fluid">
          <a class="navbar-brand" href="{{route('billing')}}"><i class="bi bi-arrow-left btn" style="background-color: tomato"></i></a>
        </div>
    </nav>

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