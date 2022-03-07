<?php

require_once '../db/DataBase.php';

class UserManager extends DataBase
{
    /** 
     * Table "user" 
     */
    private string $user = 'user';

    /**
     * Role Auth
     */
    private int $auth = 0;

    /**
     * Add User
     */
    public function addUser(UserEntity $userEntity): bool
    {
        $addUser = $this->getPDO()->prepare(
            "INSERT INTO {$this->user} (nickname, mail, password, role)
                    VALUES(:nickname, :mail, :password, :role)"
        );
        $addUser->bindValue(':nickname', $userEntity->getNickname(), PDO::PARAM_STR);
        $addUser->bindValue(':mail', $userEntity->getEmail(), PDO::PARAM_STR);
        $addUser->bindValue(':password', $userEntity->getPassword(), PDO::PARAM_STR);
        $addUser->bindValue(':role', $this->auth, PDO::PARAM_INT);

        return $addUser->execute();
    }

    /**
     * Verify if user (email) exist or not
     */
    public function verifyEmailExist(string $email): int
    {
        $verifyEmail = $this->getPDO()->prepare(
            "SELECT mail FROM {$this->user} WHERE mail = :email"
        );
        $verifyEmail->bindValue(":email", $email, PDO::PARAM_STR);
        $verifyEmail->execute();

        return $verifyEmail->rowCount();
    }

    /**
     * Connect user
     */
    public function connectUser(string $email)
    {
        $connectUser = $this->getPDO()->prepare(
            "SELECT * FROM {$this->user} 
                    WHERE mail = :email"
        );
        $connectUser->bindValue(":email", $email, PDO::PARAM_STR);
        $connectUser->execute();

        return $connectUser->fetch();
    }
}
