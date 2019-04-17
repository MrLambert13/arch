<?php

declare(strict_types = 1);

namespace Service\Communication;

use Exception;
use Model;
use Model\Entity\User;
use Service\Communication\Exception\CommunicationException;

define('NEW_COMMENT_TEMPLATE', 'new comment');

class Sms implements ICommunication
{
    /**
     * @inheritdoc
     */
    public function process(User $user, string $templateName, array $params = []): void
    {
        try {
            //sample
            if (!$user) {
                throw new CommunicationException();
            }
            echo $user->getName() . 'make' . $templateName;
        } catch (Exception $e) {
            $e->getMessage();
        }
    }
}
