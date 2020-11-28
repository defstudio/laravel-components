<?php


namespace DefStudio\Components\Notifications;


class Success extends BaseNotification
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
            'success',
            $actions,
        );
    }
}
