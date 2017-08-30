##   cmd
- 生成控制器 php artisan make:controller UserController
- 生成模型   php artisan make:model User (此种方式生成的模型放置在app下)
- 生成模型同时指定命名空间  php artisan make:model Models/User (在app/Models下生成User模型)
- 生成模型同时生成迁移文件  php artisan make:model Models/User -m (增加-m或-migrate会同时帮我们生成迁移文件)

- 数据库迁移 php artisan migrate
- 数据库回滚 php artisan migrate:rollback
- 数据库重置 php artisan migrate:refresh        //refresh 的作用是重置数据库并重新运行所有迁移


约定优于配置』（convention over configuration），也称作按约定编程，这是一种软件设计范式，旨在减少软件开发人员需做决定的数量，获得简单的好处，而又不失灵活性。
如果所用工具的约定与你的期待相符，便可省去配置; 反之，你可以配置来达到你所期待的方式.
『约定优于配置』能极大提高开发效率，并且也更有利于团队协作。Laravel 项目中大量的使用了『约定优于配置』这种设计范式，这也是 Laravel 的另一个可爱之处。


##多语言处理
https://fsdhub.com/books/laravel-essential-training-5.5/587/registration-failed-error-message
使用扩展包laravel-lang https://github.com/overtrue/laravel-lang/blob/master/README_CN.md

#通过路由传参与控制器进行交互；
- 使用 PATCH 动作来更新用户信息；
- 使用 Auth 中间件来过滤请求；
- 通过授权策略来授权用户进行编辑资料和删除用户的操作；
- 通过 intended 方法来提供更加友好的重定向方式；
- 使用数据填充的方式来生成假数据；
- Faker 扩展包的基本使用；
- 借助 Laravel 默认集成的分页功能为用户列表进行分页；
- 通过授权给管理员来删除用户；
- 对一个资源进行删除；
