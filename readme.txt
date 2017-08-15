git常用命令:

1. 安装完成后第一步配置个人信息
$ git config --global user.name "Your Name"
$ git config --global user.email "email@example.com"

2. 创建版本库，并让其受到git管理
$ git init

3.添加到暂存区 git add 文件命名1  文件名2

4.提交 git commit -m "注释部分"

5.查看git历史记录 git log   或者  git log --pretty=oneline


6.回退
Git必须知道当前版本是哪个版本，在Git中，用HEAD表示当前版本，也就是最新的提交，上一个版本就是HEAD^，上上一个版本就是HEAD^^，
当然往上100个版本写100个^比较容易数不过来，所以写成HEAD~100

$git reset --hard HEAD^     回退到上一个版本
$git reset --hard HEAD^^    回退到上上一个版本

git流程
工作区-->add之后(暂存区)-->commit之后(版本库)

场景1：当你改乱了工作区(就是你的工作目录)某个文件的内容，想直接丢弃工作区的修改时，用命令git checkout -- file。

场景2：当你不但改乱了工作区某个文件的内容，还添加到了暂存区(add之后就进入暂存区)时，想丢弃修改，分两步，第一步用命令git reset HEAD file，就回到了场景1，第二步按场景1操作。

场景3：已经提交了不合适的修改到版本库时，想要撤销本次提交，参考版本回退一节，不过前提是没有推送到远程库。