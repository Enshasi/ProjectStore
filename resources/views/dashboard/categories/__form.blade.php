


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
        <x-form.input lable="Name" type="text" name='name'  :value="$categories->name"/>
    </div>
    <div class="form-group">
        <label >Description</label>
        <x-form.input lable="Description" type="text" name='description'  :value="$categories->description"/>

    </div>
    <div class="form-group">
        <label >Parent Id</label>
        <select name="parent_id" class='form-control form-select'>
            <option value="">Primary Parent</option>
            @foreach ($parents as $parent)
                <option value="{{$parent->id}}" @selected(old('parent_id'  ,$categories->parent_id) == $parent->id)>{{$parent->name}}</option>
            @endforeach

        </select>
    </div>
    <div class="form-group">

        <x-form.input lable="Image" type="file" name='image' />
        @if($categories->image)

            <img width="100" height="100" src="{{asset('uploads/categories/'.$categories->image)}}" alt="">

        @endif
    </div>
    <div class="form-group">
        <x-form.radio lable="Active" text="active"  name="status" :value="$categories->status" />
        <x-form.radio lable="Archived" text="archived"  name="status" :value="$categories->status" />
    </div>



