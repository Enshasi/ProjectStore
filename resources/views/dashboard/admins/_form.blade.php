
<div class="form-group">
    <x-form.input lable="Name" class="form-control-lg" name="name" :value="$admin->name" />
</div>

<div class="form-group">
    <x-form.input lable="Email" type="email" name="email" :value="$admin->email" />
</div>


<fieldset>
    <legend>{{ __('Roles') }}</legend>

    @foreach ($roles as $role)
    <div class="form-check">
        <input class="form-check-input" type="checkbox" name="roles[]" value="{{ $role->id }}"   >
        <label class="form-check-label">
            {{ $role->name }}
        </label>
    </div>
    @endforeach
</fieldset>

<div class="form-group">
    <button type="submit" class="btn btn-primary">Save</button>
</div>
