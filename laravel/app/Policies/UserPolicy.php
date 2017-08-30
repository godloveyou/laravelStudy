<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

/**
*在 Laravel 中可以使用 授权策略 (Policy) 来对用户的操作权限进行验证，在用户未经授权进行操作时将返回 403 禁止访问的异常
* $ php artisan make:policy UserPolicy
*/
class UserPolicy
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

    public function update(User $currentUser, User $user)
    {
        return $currentUser->id === $user->id;
    }

    public function destroy(User $currentUser, User $user)
    {
      return $currentUser->is_admin && $currentUser->id !== $user->id;
    }
}
