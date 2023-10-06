


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
        <x-form.input lable="Name" type="text" name='name'  :value="$product->name"/>
    </div>
    <div class="form-group">
        <label >Description</label>
        <x-form.input lable="Description" type="text" name='description'  :value="$product->description"/>

    </div>
    <div class="form-group">
        <label >stores</label>
        <select name="store_id" class='form-control form-select'>
            <option value="">Primary Parent</option>
            @foreach ($stores as $store)
                <option value="{{$store->id}}" @selected(old('store_id'  ,$product->store_id) == $store->id)>{{$store->name}}</option>
            @endforeach

        </select>
    </div>
    <div class="form-group">
        <label >category</label>
        <select name="category_id" class='form-control form-select'>
            <option value="">Primary Parent</option>
            @foreach ($categories as $category)
                <option value="{{$category->id}}" @selected(old('category_id'  ,$product->category_id) == $category->id)>{{$category->name}}</option>
            @endforeach

        </select>
    </div>
    <div class="form-group">

        <x-form.input lable="Image" type="file" name='image' />
        @if($product->image)
        <img width="50" height="70" src="{{asset('uploads/products/'.$product->image)}}" alt="">
        @endif
    </div>

    <div class="form-group">

        <x-form.input lable="price" type="text" name='price'  :value="$product->price"/>

    </div>

    <div class="form-group">
        <x-form.input lable="compare price" type="text" name='compare_price'  :value="$product->compare_price"/>
    </div>
    <div class="form-group">
        <x-form.input lable="Quantity" type="text" name='quantity'  :value="$product->quantity"/>
    </div>
    <div class="form-group">
        <x-form.input lable="Tags" type="text" name='tags' :value="$tags" />
    </div>
    <div class="form-group">
        <x-form.radio lable="Active" text="active"  name="status" :value="$product->status" />
        <x-form.radio lable="Archived" text="archived"  name="status" :value="$product->status" />
        <x-form.radio lable="Draft" text="draft"  name="status" :value="$product->status" />
    </div>


@push('styles')
<link href="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.css" rel="stylesheet" type="text/css" />

@endpush
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify"></script>
<script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.polyfills.min.js"></script>
<script>
    var inputElm = document.querySelector('[name=tags]'),
    tagify = new Tagify (inputElm);
</script>
@endpush

