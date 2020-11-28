<?php


namespace DefStudio\Components\Notifications;


class Primary extends BaseNotification
{


    public function __construct(
        string $title,
        string $message,
        iterable $actions = []
    )
    {
        return parent::__construct(
            $title,
            $message,
            'primary',
            $actions,
        );
    }
}
