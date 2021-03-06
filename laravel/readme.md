##Atom快捷键
Mac下如何安装本项目
1.克隆项目到本地，同时配置本地目录与虚拟机中目录之间的同步,配置在Homestead/Homestead.yaml中进行
2.拷贝一份.env文件,同时使用 php artisan key:generate为项目生成appkey
3.更改.env文件中的数据库连接及其他相关配置
4.安装包依赖 composer install
5.迁移数据库
进入homestead目录 使用 vagrant ssh连接到虚拟机中 使用php artisan migrate进行数据库迁移工作


基本操作
cmd-shift-D 复制当前行到下一行

删除和剪切
ctrl-shift-K 删除当前行

查找和替换
cmd-F 在buffer中查找
cmd-shift-f 在整个工程中查找


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


##创建模型过程
-- 1.创建表,同时更新相应的内容
$ php artisan make:migration create_aiticles_table --create="articles"

-- 2.创建模型
$ php artisan make:model Models/User

-- 3.创建模型工厂 database/factory包下
-- 4.创建seeder
$ php artisan make:seeder UsersTableSeeder
-- 5.在database.seeder的run方法中加入需要填充的表
-- 6.开始填充数据
$ php artisan db:seed --class=UsersTableSeeder

##授权策略的使用
-- 1.生成授权策略
$ php artisan make:policy ArticlesPolicy
-- 2.在app\Policies下找到相应的策略类,编写具体的方法
如:
  /**
     * @param User $currentUser
     * @param Article $article
     * @return bool
     * 微博删除策略：必须是微博发布者才能购删除自己微博
     */
    public function destory(User $currentUser, Article $article)
    {
        return $currentUser->id === $article->user_id;
    }

-- 3.降策略加入到AuthServiceProvider中
 protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
        \App\Models\User::class  => \App\Policies\UserPolicy::class,
        \App\Models\Article::class  => \App\Policies\ArticlesPolicy::class//配置自定义的策略
    ];

-- 4.在controller或者页面中进行验证授权.
在controller中使用方法
$this->authorize('destory',$article);




##多语言处理
https://fsdhub.com/books/laravel-essential-training-5.5/587/registration-failed-error-message
使用扩展包laravel-lang https://github.com/overtrue/laravel-lang/blob/master/README_CN.md

#通过路由传参与控制器进行交互；
- 使用 PATCH 动作来更新用户信息
- 使用 Auth 中间件来过滤请求
- 通过授权策略来授权用户进行编辑资料和删除用户的操作
- 通过 intended 方法来提供更加友好的重定向方式
- 使用数据填充的方式来生成假数据
- Faker 扩展包的基本使用
- 借助 Laravel 默认集成的分页功能为用户列表进行分页
- 通过授权给管理员来删除用户
- 对一个资源进行删除

##资源路由
resource 方法让我们少写了很多代码，且严格按照了 RESTful 架构对路由进行设计。
生成的资源路由列表信息如下所示：
HTTP 	请求			         URL		         动作	              作用
GET	  /users			       UsersController@index	 显示所有用户列表的页面
GET	  /users/{user}		   UsersController@show	   显示用户个人信息的页面
GET	  /users/create		   UsersController@create	 创建用户的页面
POST	/users			       UsersController@store	 创建用户
GET	  /users/{user}/edit UsersController@edit	   编辑用户个人资料的页面
PATCH	/users/{user}		   UsersController@update	 更新用户
DELETE	/users/{user}		 UsersController@destroy 删除用户
