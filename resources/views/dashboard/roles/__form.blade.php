


@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as  $error)

            <li>{{$error}}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="form-group">
        <x-form.input lable="Name" type="text" name='name'  :value="$role->name"/>
</div>

<fieldset class="form-group">
    <legend>{{__('Abilites')}}</legend>
    @foreach (app('abilities') as $ability_code => $ability_name)
            <div class="row mb-2">
                <div class="col-md-6 ">
                    {{$ability_name}}
                </div>
                <div class="col-md-2">
                    <input type="radio" name="abilities[{{$ability_code}}]" value="allow" @checked(($role_abilities[$ability_code] ?? '') =='allow' )>Allow
                </div>
                <div class="col-md-2">
                    <input type="radio" name="abilities[{{$ability_code}}]" value="deny" @checked(($role_abilities[$ability_code] ?? '') =='deny' )>deny
                </div>
                <div class="col-md-2">
                    <input type="radio" name="abilities[{{$ability_code}}]" value="inherit" @checked(($role_abilities[$ability_code] ?? '') =='inherit' )>inherit
                </div>
            </div>
    @endforeach
</fieldset>
    {{-- <div class="form-group">
        <label >Parent Id</label>
        <select name="parent_id" class='form-control form-select'>
            <option value="">Primary Parent</option>
            @foreach ($parents as $parent)
                <option value="{{$parent->id}}" @selected(old('parent_id'  ,$roles->parent_id) == $parent->id)>{{$parent->name}}</option>
            @endforeach

        </select>
    </div> --}}

    {{-- <div class="form-group">
        <x-form.radio lable="Active" text="active"  name="status" :value="$roles->status" />
        <x-form.radio lable="Archived" text="archived"  name="status" :value="$roles->status" />
    </div> --}}















