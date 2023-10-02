@extends('welcome')

@push('title','New Billl -')

@section('body')

    @include('billing.includes.navbar')

    <form class="container mt-4" action="{{route('save-profile')}}" method="POST" enctype="multipart/form-data">
        <h2><b>New Profile</b></h2>
        <hr>
        @csrf
        <input type="text" class="form-control" name="name" placeholder="Name" value="{{old('name')}}"  enctype="multipart/form-data">
        <span class="text-danger">
            @error('name')
                {{$message}}
            @enderror
        </span>

        <input type="text" class="form-control mt-3" name="address" placeholder="Address" value="{{old('address')}}">
        <span class="text-danger">
            @error('address')
                {{$message}}
                <br>
            @enderror
        </span>

        <input type="text" class="form-control mt-3" name="email" placeholder="Email" value="{{old('email')}}">
        <span class="text-danger">
            @error('email')
                {{$message}}
                <br>
            @enderror
        </span>

        <input type="text" class="form-control mt-3" maxlength="10" name="mobile1" placeholder="Mobile1" value="{{old('mobile1')}}">
        <span class="text-danger">
            @error('mobile1')
                {{$message}}
                <br>
            @enderror
        </span>

        <input type="text" class="form-control mt-3" maxlength="10" name="mobile2" placeholder="Mobile2" value="{{old('mobile2')}}">
        <span class="text-danger">
            @error('mobile2')
                {{$message}}
                <br>
            @enderror
        </span>

        <input type="text" class="form-control mt-3" name="gst" placeholder="Gst" value="{{old('gst')}}">
        <span class="text-danger">
            @error('gst')
                {{$message}}
                <br>
            @enderror
        </span>

        <input type="text" class="form-control mt-3" name="account_number" placeholder="Account number" value="{{old('account_number')}}">
        <span class="text-danger">
            @error('account_number')
                {{$message}}
                <br>
            @enderror
        </span>

        <input type="text" class="form-control mt-3" name="ifsc_code" placeholder="IFSC code" value="{{old('ifsc_code')}}">
        <span class="text-danger">
            @error('ifsc_code')
                {{$message}}
                <br>
            @enderror
        </span>

        <input type="text" class="form-control mt-3" name="bank_name" placeholder="Bank name" value="{{old('bank_name')}}">
        <span class="text-danger">
            @error('bank_name')
                {{$message}}
                <br>
            @enderror
        </span>

        <input type="text" class="form-control mt-3" name="pancard_number" placeholder="Pancard number" value="{{old('pancard_number')}}">
        <span class="text-danger">
            @error('pancard_number')
                {{$message}}
                <br>
            @enderror
        </span>
        
        <label class="mt-3 mb-1"><b>Logo</b></label>
        <input type="file" class="form-control" name="logo" placeholder="logo" value="{{old('logo')}}">
        <span class="text-danger">
            @error('logo')
                {{$message}}
                <br>
            @enderror
        </span>
        
        <label class="mt-3 mb-1"><b>Signature</b></label>
        <input type="file" class="form-control" name="signature" placeholder="signature" value="{{old('signature')}}">
        <span class="text-danger">
            @error('signature')
                {{$message}}
                <br>
            @enderror
        </span>
        <button class="btn text-light mt-4 mb-5" style="background-color: tomato">
            Create new profile
        </button>
    </form>
@endsection