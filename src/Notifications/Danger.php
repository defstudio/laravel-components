<?php


namespace DefStudio\Components\Notifications;


class Danger extends BaseNotification
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
            'danger',
            $actions,
        );
    }
}
