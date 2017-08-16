<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //具体配置这行的原因可以查看博客  http://blog.163.com/hesion_x/blog/static/265149063201712262520340/
         Schema::defaultStringLength(191);  //手动配置迁移命令migrate生成的默认字符串长度
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
