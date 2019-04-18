<?php

declare(strict_types=1);

namespace Model\Entity;

use Service\Communication\Email;
use Service\Communication\Exception\CommunicationException;
use Service\Communication\Sms;
use SplObserver;
use SplSubject;

class User implements SplObserver
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $login;

    /**
     * @var string
     */
    private $passwordHash;

    /**
     * @var Role
     */
    private $role;

    /**
     * @param int    $id
     * @param string $name
     * @param string $login
     * @param string $password
     * @param Role   $role
     */
    public function __construct(int $id, string $name, string $login, string $password, Role $role)
    {
        $this->id = $id;
        $this->name = $name;
        $this->login = $login;
        $this->passwordHash = $password;
        $this->role = $role;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getLogin(): string
    {
        return $this->login;
    }

    /**
     * @return string
     */
    public function getPasswordHash(): string
    {
        return $this->passwordHash;
    }

    /**
     * @return Role
     */
    public function getRole(): Role
    {
        return $this->role;
    }

    /**
     * Notify
     *
     * @param SplSubject $subject
     */
    public function update(SplSubject $subject)
    {
        $notifyEmail = new Email();

        try {
            $notifyEmail->process($this, NEW_COMMENT_TEMPLATE);
        } catch (CommunicationException $e) {
        }

        $notifySMS = new Sms();

        try {
            $notifySMS->process($this, NEW_COMMENT_TEMPLATE);
        } catch (CommunicationException $e) {
        }
    }
}
