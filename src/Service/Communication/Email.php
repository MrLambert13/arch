<?php

declare(strict_types=1);

namespace Service\Communication;

use Model;
use Model\Entity\User;
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
     */
    public function update(SplSubject $subject)
    {
        $this->process($subject, NEW_COMMENT_TEMPLATE, []);
    }
}
