<?php

class UserEntity
{
    protected int $id_user;
    protected string $nickname;
    protected string $email;
    protected string $password;
    protected int $role;
    protected string $created_at;

    public function __construct(array $datas)
    {
        foreach ($datas as $key => $data) {
            $method = 'set' . ucfirst($key);
            if (method_exists($this, $method)) {
                $this->$method($data);
            }
        }
    }

    public function getId_user()
    {
        return $this->id_user;
    }
    public function setId_user($id_user)
    {
        $this->id_user = $id_user;

        return $this;
    }

    public function getNickname()
    {
        return $this->nickname;
    }
    public function setNickname($nickname)
    {
        $this->nickname = $nickname;

        return $this;
    }

    public function getEmail()
    {
        return $this->email;
    }
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    public function getRole()
    {
        return $this->role;
    }
    public function setRole($role)
    {
        $this->role = $role;

        return $this;
    }

    public function getCreated_at()
    {
        return $this->created_at;
    }
    public function setCreated_at($created_at)
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getPassword()
    {
        return $this->password;
    }
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }
}
