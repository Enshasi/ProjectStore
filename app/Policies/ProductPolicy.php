<?php

namespace App\Policies;

use App\Models\User;
use App\Models\product;
use Illuminate\Auth\Access\HandlesAuthorization;

// class ProductPolicy extends ModelPolicy
class ProductPolicy
{
    use HandlesAuthorization;

    // public function before($user, $ability)
    // {
    //     if ($user->super_admin) {
    //         return true;
    //     }
    // }
    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny( $user)
    {
        return $user->hasAbility('products.view');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\product  $product
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view( $user, product $product)
    {
        return $user->hasAbility('products.view') && $product->store_id == $user->store_id ;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create( $user)
    {
        return $user->hasAbility('products.create');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\product  $product
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update( $user, product $product)
    {
        return $user->hasAbility('products.update') && $product->store_id == $user->store_id ;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\product  $product
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete( $user, product $product)
    {
        return $user->hasAbility('products.delete') && $product->store_id == $user->store_id ;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\product  $product
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore( $user, product $product)
    {
        return $user->hasAbility('products.restore') && $product->store_id == $user->store_id ;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\product  $product
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete( $user, product $product)
    {
        return $user->hasAbility('products.forceDelete') && $product->store_id == $user->store_id ;
    }
}
