@props(['name'  , 'type'=>'text'  , 'value' => false , 'lable' => false])


<label >{{$lable}}</label>
<input type="{{$type}}" name='{{$name}}'
 {{$attributes->class([
    'form-control' ,
     'is-invalid'  =>  $errors->has($name)
 ])}}
 value="{{old($name , $value)}}">

 @error($name)
     <div class="invalid-feedback">{{$message}}</div>
 @enderror
