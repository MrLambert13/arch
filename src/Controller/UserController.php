<?php

declare(strict_types=1);

namespace Controller;

use Framework\Render;
use Service\Authentication\Fieldset;
use Service\Authentication\Form;
use Service\Authentication\FormElement;
use Service\Authentication\Input;
use Service\User\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class UserController
{
    use Render;

    function getAuthentificationForm(): FormElement
    {
        $form = new Form('authentification', 'Authentification', '/user/Authentication');
        $login = new Fieldset('login', 'Авторизация');
        $login->add(new Input('login', 'Login', 'text'));
        $login->add(new Input('password', 'Password', 'password'));
        $form->add($login);

        return $form;
    }
    /**
     * Производим аутентификацию и авторизацию
     *
     * @param Request $request
     *
     * @return Response
     */
    public function authenticationAction(Request $request): Response
    {
        if ($request->isMethod(Request::METHOD_POST)) {
            $user = new Security($request->getSession());

            $isAuthenticationSuccess = $user->authentication(
                $request->request->get('login'),
                $request->request->get('password')
            );

            if ($isAuthenticationSuccess) {
                return $this->render('user/authentication_success.html.php', ['user' => $user->getUser()]);
            } else {
                $error = 'Неправильный логин и/или пароль';
            }
        }

        $form = $this->getAuthentificationForm();

        return $this->render('user/Authentication.html.php',
            [
                'error' => $error ?? '',
                'form' => $form->render(),
            ]);
    }

    /**
     * Выходим из системы
     *
     * @param Request $request
     *
     * @return Response
     */
    public function logoutAction(Request $request): Response
    {
        (new Security($request->getSession()))->logout();

        return $this->redirect('index');
    }
}
