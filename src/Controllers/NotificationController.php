<?php


namespace DefStudio\Components\Controllers;


use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Notifications\DatabaseNotification;

class NotificationController
{
    public function index()
    {
        return User::current()->notifications;
    }

    public function read(Request $request, string $notification_id)
    {
        /** @var DatabaseNotification $notification */
        $notification = User::current()->notifications()->findOrFail($notification_id);

        if ($request->input('read', true)) {
            $notification->markAsRead();
        } else {
            $notification->markAsUnread();
        }


        return response()->noContent();
    }
}
