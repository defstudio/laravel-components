<?php


namespace DefStudio\Components\Notifications;


use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Notification;

class BaseNotification extends Notification implements ShouldQueue
{
    use Queueable;

    private string $title;
    private string $message;
    private string $color;
    private iterable $actions;


    public function __construct(
        string $title,
        string $message,
        string $color,
        iterable $actions = []
    )
    {
        $this->title = $title;
        $this->message = $message;
        $this->color = $color;
        $this->actions = $actions;
    }

    public function via($notifiable)
    {
        return ['database'];
    }


    public function toArray($notifiable)
    {
        return [
            'color'   => $this->color,
            'title'   => $this->title,
            'message' => $this->message,
            'actions' => $this->actions,
        ];
    }

}
