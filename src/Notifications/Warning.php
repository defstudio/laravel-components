<?php


namespace DefStudio\Components\Notifications;


class Warning extends BaseNotification
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
            'warning',
            $actions,
        );
    }
}
