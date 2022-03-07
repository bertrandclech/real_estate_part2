<?php

require_once '../db/DataBase.php';

class UserManager extends DataBase
{
    /** 
     * Table "user" 
     */
    private string $user = 'user';

    public function addUser(UserEntity $userEntity) : bool
    {
        $addUser = $this->getPDO()->prepare(
            "INSERT INTO {$this->user} (nickname, mail, password, role)
                VALUES(:nickname, :mail, :role)"
        );
        $addUser->bindValue(':nickname', $userEntity->getNickname(), PDO::PARAM_STR);
        $addUser->bindValue(':mail', $userEntity->getEmail(), PDO::PARAM_STR);
        $addUser->bindValue(':role', $userEntity->getRole(), PDO::PARAM_INT);
        return $addUser->execute();
    }
}
