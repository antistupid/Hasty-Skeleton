<?php

namespace Controller;

use Hasty\Controller;
use Hasty\Helper;
use Hasty\Session;
use Model\User;
use Model\UserResource;

class Auth extends Controller
{

    /**
     * @route GET,POST /login
     */
    public function login()
    {
        if ($this->isPost()) {
            /** @var UserResource $userResource */
            $userResource = UserResource::instance();
            $user = $userResource->authenticate(trim($_POST['username']), $_POST['password']);
            if (!$user)
                return $this->redirect('/login', ['error' => 'Invalid account, try again.']);

            Session::set('user', [
                'username' => $user->getUserName(),
                'name' => $user->getName(),
            ]);
            return $this->redirect('/');
        }
        return $this->render('auth/login.twig');
    }

    /**
     * @route GET /logout
     */
    public function logout()
    {
        Session::del('user');
        return $this->redirect('/login');
    }

    /**
     * @route GET,POST /signup
     */
    public function signup()
    {
        if ($this->isPost()) {
            /** @var UserResource $userResource */
            $userResource = UserResource::instance();
            $result = $userResource->createUser(
                $_POST['username'],
                $_POST['password'],
                $_POST['name']
            );
            if (!$result)
                return $this->redirect('/signup', "error occurred.");
            return $this->redirect('/login', "user $_POST[username] created.");
        }
        return $this->render('auth/signup.twig');
    }
}