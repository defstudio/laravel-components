<?php


namespace DefStudio\Components\Controllers;


use App\Models\User;

class NotificationController
{
    public function index()
    {
        return User::current()->notifications;
    }
}
