@extends('layouts.dashboard')
@section('title' , 'dashboard')
@section('titlePage' , 'Profiles Create')
@section('breadcrumb')
@parent
<li class="breadcrumb-item active">Profiles</li>
@endsection
@section('content')

<form method="post" action="{{ route('dashboard.profile.update')}}" enctype="multipart/form-data">
    @csrf
    @method('patch')
    <div class="form-group d-flex justify-content-between w-100">
        <div class="w-50">
            <x-form.input lable="First Name" type="text" name='first_name'  :value="$user->profile->first_name"/>

        </div>
        <div class="w-50 ml-2">

            <x-form.input lable="Last Name" type="text" name='last_name'  :value="$user->profile->last_name"/>
        </div>
    </div>

    <div class="form-group d-flex justify-content-between w-100">
        <div class="w-50">
            <x-form.input lable="birthday" type="date" name='birthday'  :value="$user->profile->birthday"/>

        </div>
        <div class="w-50 ml-2 d-flex">
            <div>
                <label for="">Male</label>
                <input type="radio" class='form-check' name="gender" value="male"  @checked($user->profile->gender === 'male') />

            </div>
            <div class='ml-4'>

                <label for="">Female</label>
                <input type="radio"class='form-check '  name="gender"   value="female" @checked($user->profile->gender === 'female') />
            </div>

        </div>
    </div>

    <div class="form-group d-flex justify-content-between w-100">
        <div class="w-50">
            <x-form.input lable="street_address" type="text" name='street_address'  :value="$user->profile->street_address"/>

        </div>
        <div class="w-50 ml-2">

            <x-form.input lable="city" type="text" name='city'  :value="$user->profile->city"/>
        </div>
        <div class="w-50 ml-2">

            <x-form.input lable="state" type="text" name='state'  :value="$user->profile->state"/>
        </div>
    </div>
    <div class="form-group d-flex justify-content-between w-100">
        <div class="w-50">
            <x-form.input lable="postal_code" type="text" name='postal_code'  :value="$user->profile->postal_code"/>

        </div>
    </div>

    <div class=" d-flex justify-content-between">
        <div class="w-50">

            <label>Countries</label>
            <select class='form-control' name="country">
                <option value=""></option>
                @foreach ($countries as $countrie )
                <option value="{{$countrie}}" @selected($countrie === $user->profile->country )>{{$countrie}}</option>
                @endforeach
            </select>
        </div>
            <div class="w-50 ml-3">

                <label>language</label>

                <select class='form-control' name="locale">
                    <option value=""></option>
                    @foreach ($languages as $language )
                    <option value="{{$language}}" @selected($language === $user->profile->locale )>{{$language}}</option>
                    @endforeach
                </select>
            </div>
    </div>


    <div class="form-group">
        <button type="submit" class='btn btn-success mt-2'>Update</button>


    </div>
</form>

@endsection
