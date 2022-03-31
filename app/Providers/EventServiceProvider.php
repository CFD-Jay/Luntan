<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [                         //Registered事件，在注册功能中，调用了该事件(RegistersUsers.php)
            SendEmailVerificationNotification::class,
        ],
        
        \Illuminate\Auth\Events\Verified::class => [  //Verified事件，处理验证成功后的动作（自定义邮箱激活后的视图）  
            \App\Listeners\EmailVerified::class,
        ],
       
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
