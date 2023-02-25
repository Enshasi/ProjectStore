
@props(['lable' , 'text' , 'name'  , 'type' => 'radio'  , 'value' => false])

<div class="form-check">
    <input class="form-check-input"
    type="{{$type}}"
    name="{{$name}}"
    value="{{$text}}"
    @checked(old($text , $value) == $text)>
    <label class="form-check-label" >
      {{$lable}}
    </label>
</div>
