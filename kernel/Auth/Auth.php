<?php

namespace App\Kernel\Auth;

use App\Kernel\Auth\AuthInterface;
use App\Kernel\Config\ConfigInterface;
use App\Kernel\DataBase\DataBaseInterface;
use App\Kernel\Session\SessionInterface;

class Auth implements AuthInterface
{

    public function __construct(
        private DataBaseInterface $db,
        private SessionInterface $session,
        private ConfigInterface $config,
    )
    { }

    public function attempt(string $userName, string $password): bool                                                       //en attempt - ru попытка login
    {
        $user = $this->db->first($this->table(),[ $this->username() => $userName]); // в переменную получаю первое совпадение с ДБ

        if (! $user)
        {
            return  false;
        }

        if ( ! password_verify( $password, $user[$this->password()] )) // проверка совпадения паролей переданный и с БД
        {
            return false;
        }

        $this->session->set($this->sessionField(), $user['id']); // размещаю в сессии
        return true;
    }

    public function logout(): void
    {
        $this->session->remove($this->sessionField());
    }

    public function check(): bool
    {
        if ($this->session->has($this->sessionField()))
        {
            return true;
        };

        return false;
    }

    public function user(): ?User
    {
        if(! $this->check() )
        {
            return null;
        }

        $user =  $this->db->first($this->table(), [
            'id' => $this->session->get($this->sessionField())    //user - тот который нашелся в БД
        ]);



        if ($user) {
            return new User(
                $user['id'],
                $user[$this->username()],
                $user[$this->password()],
            );
        }
        return null;
    }

    public function table(): string
    {
        return $this->config->get('auth.table', 'users'); //получил значение ключа table | users
    }

    public function username(): string
    {
        return $this->config->get('auth.username','email'); //получил значение ключа username | email
    }

    public function password(): string
    {
        return $this->config->get('auth.password', 'password'); //получил значение ключа password | password
    }

    public function sessionField(): string
    {
        return $this->config->get('auth.session_field', 'user_id');
    }
}