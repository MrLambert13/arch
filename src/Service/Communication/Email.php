<?php

declare(strict_types=1);

namespace Service\Communication;

use Model;
use Model\Entity\User;

define('NEW_COMMENT_TEMPLATE', 'new comment');

class Email implements ICommunication
{
    /**
     * @inheritdoc
     */
    public function process(User $user, string $templateName, array $params = []): void
    {
        echo $user->getName() . 'make' . $templateName;
    }
}
