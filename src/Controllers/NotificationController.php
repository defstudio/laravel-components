<?php
/*
 * Copyright (C) 2021. Def Studio
 *  Unauthorized copying of this file, via any medium is strictly prohibited
 *  Authors: Fabio Ivona <fabio.ivona@defstudio.it> & Daniele Romeo <danieleromeo@defstudio.it>
 */

namespace DefStudio\Components\Controllers;


use Illuminate\Http\Request;
use Illuminate\Notifications\DatabaseNotification;

class NotificationController
{
    public function index()
    {
        return user()->notifications;
    }

    public function read(Request $request, string $notification_id)
    {
        /** @var DatabaseNotification $notification */
        $notification = user()->notifications()->findOrFail($notification_id);

        if ($request->input('read', true)) {
            $notification->markAsRead();
        } else {
            $notification->markAsUnread();
        }


        return response()->noContent();
    }

    public function destroy(string $notification_id)
    {
        /** @var DatabaseNotification $notification */
        $notification = user()->notifications()->findOrFail($notification_id);

        $notification->delete();

        return response()->noContent();
    }

}
