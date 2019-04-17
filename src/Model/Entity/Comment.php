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
     * @param SplObserver $observer <p>
     *                              The <b>SplObserver</b> to attach.
     *                              </p>
     *
     * @return void
     * @since 5.1.0
     */
    public function attach(SplObserver $observer)
    {
        // TODO: Implement attach() method.
    }

    /**
     * Detach an observer
     * @link  https://php.net/manual/en/splsubject.detach.php
     *
     * @param SplObserver $observer <p>
     *                              The <b>SplObserver</b> to detach.
     *                              </p>
     *
     * @return void
     * @since 5.1.0
     */
    public function detach(SplObserver $observer)
    {
        // TODO: Implement detach() method.
    }

    /**
     * Notify an observer
     * @link  https://php.net/manual/en/splsubject.notify.php
     * @return void
     * @since 5.1.0
     */
    public function notify()
    {
        // TODO: Implement notify() method.
    }
}
