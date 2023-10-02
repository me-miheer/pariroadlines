@extends('welcome')

@push('title'. 'User -')

@section('body')

<style>
    li{
        list-style: none;
    }
    ul{
        margin: 0;
        padding: 0;
        margin: 10px 20px;
    }
</style>
    @include('billing.includes.navbar')

    @if (Session::get('profile_created_message'))
        @if (Session::get('profile_created') == true)
            <div class="alert alert-success">
                {{Session::get('profile_created_message')}}
            </div>
        @else
            <div class="alert alert-warning">
                {{Session::get('profile_created_message')}}
            </div>
        @endif
    @endif
    
    <div action="" class="p-0 m-0 container m-auto">
        <nav class="navbar mt-2">
            <div class="container-fluid">
                <form class="d-flex" action="{{route('update-profile')}}" method="POST">
                    @csrf
                    <select name="form_action" id="form-action" class="form-select" onchange="showapply(this)">
                        <option value=""> Please select any</option>
                        <option value="default">Default profile</option>
                        <option value="delete">Delete Profile</option>
                    </select>
                    &nbsp;&nbsp;
                    <input type="hidden" id="action_id" name="action_id">
                    <button type="submit" class="btn btn-primary d-none addon-for-apply">Apply</button>
                </form>
                <a href="{{route('new-profile')}}" class="btn text-light" style="background-color: tomato"><i class="bi bi-plus"></i></a>
            </div>
        </nav>
    
        <div class="conatiner m-3 alert alert-dark">
            Default profile : <u><b>{{(!empty($default['name']))?$default['name']:'No default profile found'}}</b></u>
        </div>

        <ul>
            @if ($data)
                @foreach ($data as $item)
                <li class="select-list card p-3 mt-4">
                    <h3><b>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" value="" name="radio-stacked" id="" onclick="setIdForAction({{trim($item['id'])}})">
                        <label class="form-check-label p-0 m-0" for="">
                          {{$item['name']}}
                        </label>
                    </div>
                </b></h3>
                <hr class="m-0 p-0">
                <strong class="mt-2b text-secondary" style="font-size: 12px">
                    {{$item['address']}}
                </strong>
                </li>
                @endforeach
            @endif
        </ul>
    </div>

    <script>
        function showapply(selectbox){
            if(selectbox.value === ''){
                $('.addon-for-apply').addClass('d-none')
            }else{
                $('.addon-for-apply').removeClass('d-none')
            }
        }

        function setIdForAction(id){
            $('#action_id').val(id);
        }
    </script>
@endsection