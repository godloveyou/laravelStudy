<?php

namespace App\Policies;

use App\Models\Article;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ArticlesPolicy
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

    /**
     * @param User $currentUser
     * @param Article $article
     * @return bool
     * 微博删除策略：必须是微博发布者才能购删除自己微博
     */
    public function destroy(User $currentUser, Article $article)
    {
        return $currentUser->id === $article->user_id;
    }
}
