<?php
/*
 * Copyright (C) 2021. Def Studio
 *  Unauthorized copying of this file, via any medium is strictly prohibited
 *  Authors: Fabio Ivona <fabio.ivona@defstudio.it> & Daniele Romeo <danieleromeo@defstudio.it>
 */

/** @noinspection PhpUnusedParameterInspection */


namespace DefStudio\Components\Notifications;


use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Notification;
use JetBrains\PhpStorm\Pure;

abstract class BaseNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public string $title;
    public string $message;
    public string $color = 'primary';
    public iterable $actions;


    public function __construct(
        string $title,
        string $message,
        iterable $actions = []
    ) {
        $this->title = $title;
        $this->message = $message;
        $this->actions = $actions;
    }

    #[Pure] public static function build(
        string $title,
        string $message,
        iterable $actions = []
    ): static {
        return new static($title, $message, $actions);
    }

    public function via($notifiable): array
    {
        return ['database', 'broadcast'];
    }

    public function toBroadcast($notifiable): BroadcastMessage
    {
        return new BroadcastMessage([
            'def_components_notification' => true,
            'data'                        => [
                'color'   => $this->color,
                'title'   => $this->title,
                'message' => $this->message,
                'actions' => $this->actions,
            ],
        ]);
    }

    public function toArray($notifiable): array
    {
        return [
            'color'   => $this->color,
            'title'   => $this->title,
            'message' => $this->message,
            'actions' => $this->actions,
        ];
    }
}
