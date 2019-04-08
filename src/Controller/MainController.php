<?php

declare(strict_types = 1);

namespace Controller;

use Framework\Render;
use Framework\Registry;
use Symfony\Component\HttpFoundation\Response;

class MainController
{
    use Render;

    /**
     * Главная страница
     *
     * @return Response
     */
    public function indexAction(): Response
    {
        return $this->render('main/index.html.php');
    }

    public function classAction(): Response
    {
        $rootViewPath = Registry::getDataConfig('view.directory');
        $imgPath = $rootViewPath . 'main/Img/Homework1.png';

        if (!file_exists($imgPath)) {
            return new Response('There is no img file ', Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        return $this->render('main/class.html.php', ['image' => $imgPath]);
    }
}
