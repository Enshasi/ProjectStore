
<div class="form-group">
    <x-form.input lable="Name" class="form-control-lg" name="name" :value="$user->name" />
</div>

<div class="form-group">
    <x-form.input lable="Email" type="email" name="email" :value="$user->email" />
</div>


<div class="form-group">
    <button type="submit" class="btn btn-primary">Save</button>
</div>
