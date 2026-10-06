<?php

namespace App\Models\User;

use InvalidArgumentException;

class User
{
    private ?int $id;
    private string $name;
    private string $email;
    private string $passwordHash;

    private function __construct(?int $id, string $name, String $email, String $password)
    {
        $this->id = $id;
        $this->changeName($name);
        $this->changeEmail($email);
        $this->passwordHash = $password;
    }

    public static function register(?int $id, string $name, String $email, String $password) : self
    {
        return new self($id, $name, $email, $password);
    }

    public static function reconstitute(int $id, string $name, String $email, String $password) : self
    {
        return new self($id, $name, $email, $password);
    }

    public function verifyPassword(string $plainPassword) : bool
    {
        return password_verify($plainPassword, $this->passwordHash);
    }

    public function assignId(int $id) : void
    {
        if ($this->id !== null) {
            throw new InvalidArgumentException("Usuário já possuí um ID");
        }

        $this->id = $id;
    }

    public function changeName(string $name) : void
    {
        $name = trim($name);

        if ($name ===  '' || mb_strlen($name) > 150) {
            throw new InvalidArgumentException("Nome deve ter entre 1 e 150 caracteres");
        }

        $this->name = $name;
    }

    public function changeEmail(string $email) : void
    {
        $email = strtolower(trim($email));

        if (!filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($email) > 320) {
            throw new InvalidArgumentException("Email inválido");
        }

        $this->email = $email;
    }

    public function getId() : ?int
    {
        return $this->id;
    }

    public function getName() : string
    {
        return $this->name;
    }

    public function getEmail() : string
    {
        return $this->email;
    }

    public function getPasswordHash() : string
    {
        return $this->passwordHash;
    }
}

?>

