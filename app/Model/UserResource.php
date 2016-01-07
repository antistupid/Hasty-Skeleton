<?php

namespace Model;

use Hasty\Resource;

class UserResource
{

    private static $instance;

    public static function instance()
    {
        static::$instance = new static();
        return static::$instance;
    }

    public function authenticate($username, $password)
    {
        $repository = Resource::getEntityManager()->getRepository('\Model\Entity\User');
        $user = $repository->findOneBy(['username' => $username]);
        if (!$user or !$user->checkPassword($password))
            return null;
        return $user;
    }

    public function createUser($username, $password, $name)
    {
        $user = new \Model\Entity\User();
        $user->setUsername($username);
        $user->setPassword($password);
        $user->setName($name);

        Resource::getEntityManager()->persist($user);
        Resource::getEntityManager()->flush();

        return true;
    }
}

