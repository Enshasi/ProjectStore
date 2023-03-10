<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Str;
class ModelPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
    public function __call($name   , $arguments){
        $class_name = str_replace('Policy', '', class_basename($this));
        $class_name = Str::plural(Str::lower($class_name));
        $ability = $class_name.''.Str::kebab($name);
        $user = $arguments[0];
        return $user->hasAbility($ability);
    }
}
