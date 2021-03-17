<?php
/*
 * Copyright (C) 2021. Def Studio
 *  Unauthorized copying of this file, via any medium is strictly prohibited
 *  Authors: Fabio Ivona <fabio.ivona@defstudio.it> & Daniele Romeo <danieleromeo@defstudio.it>
 */

namespace DefStudio\Components\Notifications;


use JetBrains\PhpStorm\Pure;

class Success extends BaseNotification
{
    #[Pure] public function __construct(
        string $title,
        string $message,
        iterable $actions = []
    ) {
        return parent::__construct(
            $title,
            $message,
            'success',
            $actions,
        );
    }

    #[Pure] public static function build(
        string $title,
        string $message,
        iterable $actions = []
    ): static {
        return new static($title, $message, $actions);
    }
}
