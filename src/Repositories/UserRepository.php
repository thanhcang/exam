<?php

namespace Src\Repositories;

use PDO;
use Src\Models\UserModel;

class UserRepository extends BaseRepository
{
    protected $model = UserModel::class;

    public function checkEmail(string $email): bool
    {
        $sql  = "select * from {$this->getModel()->getTable()} where email = :EMAIL ";
        $stmt = $this->mysql->getConnection()->prepare($sql);
        $stmt->bindValue(':EMAIL', $email);
        $stmt->execute();
        $data = $stmt->fetchAll();

        return count($data) > 0;
    }

    public function getUserInfoByEmail(string $email): UserModel
    {
        $sql  = "select * from {$this->getModel()->getTable()} where email = :EMAIL ";
        $stmt = $this->mysql->getConnection()->prepare($sql);
        $stmt->bindValue(':EMAIL', $email);
        $stmt->execute();
        $data      = $stmt->fetch(PDO::FETCH_ASSOC);
        $userModel = new UserModel();

        if (!empty($data)) {
            $userModel->setId($data['id']);
            $userModel->setFirstName($data['first_name']);
            $userModel->setLastName($data['last_name']);
            $userModel->setAdmin($data['admin']);
            $userModel->setSalt($data['salt']);
            $userModel->setPassword($data['password']);
            $userModel->setEmail($data['email']);
        }

        return $userModel;
    }
}