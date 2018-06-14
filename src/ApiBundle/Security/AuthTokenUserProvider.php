<?php
# src/ApiBundle/Security/AuthTokenUserProvider.php

namespace ApiBundle\Security;

use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\User\User;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Doctrine\ORM\EntityRepository;

class AuthTokenUserProvider implements UserProviderInterface
{
    protected $authTokenRepository;
    protected $authRepository;

    public function __construct(EntityRepository $authTokenRepository, EntityRepository $authRepository)
    {
        $this->authTokenRepository = $authTokenRepository;
        $this->authRepository = $authRepository;
    }

    public function getAuthToken($authTokenHeader)
    {
        return $this->authTokenRepository->findOneByValue($authTokenHeader);
    }

    public function loadUserByUsername($login)
    {
        return $this->userRepository->findByLogin($login);
    }

    public function refreshUser(UserInterface $user)
    {
        // Le systéme d'authentification est stateless, on ne doit donc jamais appeler la méthode refreshUser
        throw new UnsupportedUserException();
    }

    public function supportsClass($class)
    {
        return 'ApiBundle\Entity\Auth' === $class;
    }
}