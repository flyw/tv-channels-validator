## Laravel Boilerplate (Current: Laravel 6.*) ([Demo](http://134.209.123.206/))

[![Latest Stable Version](https://poser.pugx.org/rappasoft/laravel-boilerplate/v/stable)](https://packagist.org/packages/rappasoft/laravel-boilerplate)
[![Latest Unstable Version](https://poser.pugx.org/rappasoft/laravel-boilerplate/v/unstable)](https://packagist.org/packages/rappasoft/laravel-boilerplate) 
<br/>
[![StyleCI](https://styleci.io/repos/30171828/shield?style=plastic)](https://github.styleci.io/repos/30171828)
<br/>
![GitHub contributors](https://img.shields.io/github/contributors/rappasoft/laravel-boilerplate.svg)
![GitHub stars](https://img.shields.io/github/stars/rappasoft/laravel-boilerplate.svg?style=social)

### Demo Credentials

**User:** admin@admin.com  
**Password:** secret

### Official Documentation

[Click here for the official documentation](http://laravel-boilerplate.com)

### Slack Channel

Please join us in our Slack channel to get faster responses to your questions. Get your invite here: https://laravel-boilerplate.herokuapp.com

### Introduction

Laravel Boilerplate provides you with a massive head start on any size web application. It comes with a full featured access control system out of the box with an easy to learn API and is built on a Bootstrap foundation with a front and backend architecture. We have put a lot of work into it and we hope it serves you well and saves you time!

### Issues

If you come across any issues please [report them here](https://github.com/rappasoft/laravel-boilerplate/issues).

### Contributing

Thank you for considering contributing to the Laravel Boilerplate project! Please feel free to make any pull requests, or e-mail me a feature request you would like to see in the future to Anthony Rappa at rappa819@gmail.com.

### Security Vulnerabilities

If you discover a security vulnerability within this boilerplate, please send an e-mail to Anthony Rappa at rappa819@gmail.com, or create a pull request if possible. All security vulnerabilities will be promptly addressed.

### Donations

If you would like to help the continued efforts of this project, any size [donations](https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=JJWUZ4E9S9SFG&lc=US&item_name=Laravel%205%20Boilerplate&currency_code=USD&bn=PP%2dDonationsBF%3abtn_donateCC_LG%2egif%3aNonHosted) are welcomed and highly appreciated.

### License

MIT: [http://anthony.mit-license.org](http://anthony.mit-license.org)

### 安装项目

1. 创建配置文件 (将.env.example 复制一份 到 .env)
```bash
cp .env.example .env
```

1. 通过 composer 安装项目
    1. `开发环境`下安装

        ```bash
        php composer.phar install
        ```

    1. `生产环境`下安装

        ```bash
        php composer.phar install --optimize-autoloader --no-dev
        ```

1. 生成Key
     ```bash
     php artisan key:generate
     ```
     
1. 链接文件路径 
    ```bash
     php artisan storage:link
     ```

1. 增加storage路径的写权限
    ```bash
     chmod a+w storage -R
     ```     
 
1. 创建数据库表
    ```bash
     php artisan migrate
     ```
 
1. 在配置文件(.env)中修改数据库的配置信息
 
     ```ini
     DB_CONNECTION=mysql
     DB_HOST=127.0.0.1
     DB_PORT=3306
     DB_DATABASE=DATABASE_NAME
     DB_USERNAME=USERNAME
     DB_PASSWORD=PASSWORD
     ```
 
1. [可选] 生成默认数据库(只生成数据库结构和默认数据)
 
    ```bash
      php artisan migrate --seed
    ```

1. [可选] 安装中文字库
 
    ```bash
      yum groupinstall Fonts
    ```


### 通行管理系统
需要在主项目添加agent相关配置

1. Kernel添加\Joydata\Settings\Http\Middleware\AppendUserAgent::class
2. User Model添加关联关系
 ```php
 public function agent() {
        return $this->belongsTo(Agent::class , 'agent_id', 'id');
    }
```
3. resources\views\backend\auth\user\create.blade.php 添加
 ```html
                         @if (Auth::user()->isAdmin())
                            <div class="form-group row">
                                {{ html()->label('所属权限组')->class('col-md-2 form-control-label')->for('agent_id') }}

                                <div class="col-md-10">
                                    @php
                                        $agents = \Joydata\Settings\Models\Agent::all()
                                        ->keyBy('id')
                                        ->map(function ($item) {return $item->name;});
                                    @endphp
                                    {!!  Form::select('agent_id' , $agents , $agents->keys()->last(), ['class'=>'form-control']); !!}
                                </div><!--col-->
                            </div><!--form-group-->
                        @endif

```
4. resources\views\backend\auth\user\edit.blade.php 添加
 ```html
                     @if (Auth::user()->isAdmin())
                        <div class="form-group row">
                            {{ html()->label('所属权限组')->class('col-md-2 form-control-label')->for('agent_id') }}

                            <div class="col-md-10">
                                @php
                                    $agents = \Joydata\Settings\Models\Agent::all()
                                    ->keyBy('id')
                                    ->map(function ($item) {return $item->name;});
                                @endphp
                                {!!  Form::select('agent_id' , $agents , $user->agent_id, ['class'=>'form-control']); !!}
                            </div><!--col-->
                        </div><!--form-group-->
                    @endif


```
5. resources\views\backend\auth\user\show\tabs\overview.blade.php 添加
 ```html
            @if (Auth::user()->isAdmin())
                <tr>
                    <th>所属权限组</th>
                    <td>{{ optional($user->agent)->name }}</td>
                </tr>
            @endif

```


    