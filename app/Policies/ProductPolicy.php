<?php

namespace App\Policies;

use App\Models\Staff;
use App\Models\Product;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProductPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\Staff  $staff
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(Staff $staff)
    {
        return $staff->hasPermission("view_product");
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\Staff  $staff
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(Staff $staff, Product $product)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(Staff $staff)
    {
        return $staff->hasPermission("add_product");
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\Staff $staff
     * @param  \App\Models\Product $product
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(Staff $staff, Product $product)
    {
        return $staff->hasPermission("edit_product");
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\Staff  $staff
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(Staff $staff, Product $product)
    {
        return $staff->hasPermission("delete_product");
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\Staff  $Staff
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(Staff $Staff, Product $product)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\Staff  $staff
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(Staff $staff, Product $product)
    {
        //
    }
}
