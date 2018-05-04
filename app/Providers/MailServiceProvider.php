<?php


namespace App\Providers;

use Pongtan\Contracts\ServiceProviderInterface;
use App\Contracts\MailService;
use App\Services\Mail\SendGrid;

class MailServiceProvider implements ServiceProviderInterface
{
    public function register()
    {
        app()->singleton(MailService::class, function ($app) {
            // @todo
            //return new Mailgun();
            return new SendGrid();
        });
    }

    public function boot()
    {
    }
}