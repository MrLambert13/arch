<?php

declare(strict_types=1);

namespace Service\Communication;

use Model;
use Model\Entity\User;
use SplObserver;
use SplSubject;

class Email implements ICommunication, SplObserver
{
    const NEW_COMMENT_TEMPLATE = 'new comment';

    /**
     * @inheritdoc
     */
    public function process(User $user, string $templateName, array $params = []): void
    {
        echo $user->getName() . 'make' . $templateName;
    }

    /**
     * Receive update from subject
     * @link  https://php.net/manual/en/splobserver.update.php
     *
     * @param SplSubject $subject
     *
     * @return void
     * @since 5.1.0
     * @throws Exception\CommunicationException
     */
    public function update(SplSubject $subject)
    {
        try {
            $this->process($subject, self::NEW_COMMENT_TEMPLATE, []);
        } catch (Exception\CommunicationException $e) {
        }
    }
}
