<?php

namespace Model\Entity;

use SplObjectStorage;
use SplObserver;
use SplSubject;

class Comment implements SplSubject
{

    /**
     * @var SplObjectStorage
     */
    private $observers;

    /**
     * @var string
     */
    private $text;

    public function __construct()
    {
        $this->observers = new SplObjectStorage();
    }

    /**
     * Attach an SplObserver
     * @link  https://php.net/manual/en/splsubject.attach.php
     *
     * @param SplObserver $observer
     *
     * @return void
     * @since 5.1.0
     */
    public function attach(SplObserver $observer)
    {
        $this->observers->attach($observer);
    }

    /**
     * Detach an observer
     * @link  https://php.net/manual/en/splsubject.detach.php
     *
     * @param SplObserver $observer
     *
     * @return void
     * @since 5.1.0
     */
    public function detach(SplObserver $observer)
    {
        $this->observers->detach($observer);
    }

    /**
     * Notify an observer
     * @link  https://php.net/manual/en/splsubject.notify.php
     * @return void
     * @since 5.1.0
     */
    public function notify()
    {
        foreach ($this->observers as $observer) {
            $observer->update($this);
        }
    }

    /**
     * When new comment saved, system must notify some users
     */
    public function save()
    {
        //todo save comments
        $this->notify();
    }

    public function create()
    {
        //todo create comment
    }

    public function update()
    {
        //todo update comment
    }


}
