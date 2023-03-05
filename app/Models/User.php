<?php

declare(strict_types=1);

namespace App\Models;

use DB;
use PDO;

class User
{
    private PDO $conn;
    protected string $modelName = 'User';

    public function __construct()
    {
        $db = DB::getInstance();
        $this->conn = $db->getConnection();
    }

    public function getAllUsers(): bool|array
    {
        $stm = $this->conn->prepare(
            "SELECT u.*, g.*, u.id AS user_id 
                    FROM users AS u 
                        JOIN user_groups AS ug ON u.id = ug.user_id 
                        JOIN groups AS g ON g.id = ug.group_id 
                    GROUP BY u.username 
                    ORDER BY u.username;"
        );
        return ($stm->execute()) ? $stm->fetchAll() : false;
    }

    public function getAllUserGroups($id): bool|array
    {
        $stm = $this->conn->prepare(
            "SELECT g.*, u.id AS user_id
                    FROM users AS u
                    INNER JOIN user_groups AS ug ON u.id = ug.user_id
                    INNER JOIN groups AS g ON g.id = ug.group_id
                    WHERE u.id = :id
                    ORDER BY u.username"
        );
        $stm->bindParam(":id", $id);

        return ($stm->execute()) ? $stm->fetchAll() : false;
    }

    public function getUser(int $id): bool|array
    {
        $stm = $this->conn->prepare(
            "SELECT *
            FROM users AS u
            WHERE u.id = :id"
        );
        $stm->bindParam(":id", $id);

        return ($stm->execute()) ? $stm->fetch() : false;
    }

    public function getUserGroups(int $id): bool|array
    {
        $stm = $this->conn->prepare(
            "SELECT	group_id FROM user_groups WHERE user_id = :id"
        );
        $stm->bindParam(":id", $id);

        return ($stm->execute()) ? $stm->fetchAll(PDO::FETCH_COLUMN) : false;
    }

    public function setUser(
        string $first_name,
        string $last_name,
        string $password,
        string $date_of_birth,
        array $groups
    ): string
    {
        $fullName = "$first_name $last_name";
        $passwordHash = base64_encode($password);

        $stm = $this->conn->prepare(
            "INSERT INTO `users` 
                        (`username`, `password`, `first_name`, `last_name`, `date_of_birth`) 
                        VALUES 
                        (:fullName, :passwordHash, :first_name, :last_name, :date_of_birth)"
        );
        $stm->bindParam(":fullName", $fullName);
        $stm->bindParam(":passwordHash", $passwordHash);
        $stm->bindParam(":first_name", $first_name);
        $stm->bindParam(":last_name", $last_name);
        $stm->bindParam(":date_of_birth", $date_of_birth);
        $stm->execute();

        $new_user_id = $this->conn->lastInsertId();

        $stm1 = $this->conn->prepare(
            "INSERT INTO `user_groups` (`user_id`, `group_id`)VALUES (:new_user_id, :group_id)"
        );

        foreach ($groups as $group) {
            $stm1->bindValue(":new_user_id", $new_user_id, PDO::PARAM_INT);
            $stm1->bindValue(":group_id", $group, PDO::PARAM_INT);
            $stm1->execute();
        }

        return $new_user_id;
    }


    public function updateUser(
        int $user_id,
        string $first_name,
        string $last_name,
        string $password,
        string $date_of_birth,
        array $group_ids,
    ): int|false
    {
        $fullName = "$first_name $last_name";
        $passwordHash = base64_encode($password);
        $this->conn->beginTransaction();

        $stm = $this->conn->prepare(
            "UPDATE users AS g
                SET username = :fullName,
                password = :passwordHash,
                first_name = :first_name,
                last_name = :last_name,
                date_of_birth = :date_of_birth
                WHERE g.id = :id"
        );
        $stm->bindParam(":fullName", $fullName);
        $stm->bindParam(":passwordHash", $passwordHash);
        $stm->bindParam(":first_name", $first_name);
        $stm->bindParam(":last_name", $last_name);
        $stm->bindParam(":date_of_birth", $date_of_birth);
        $stm->bindParam(":id", $user_id);
        $stm->execute();

        $stm1 = $this->conn->prepare(
            "DELETE FROM user_groups WHERE user_id = :user_id"
        );
        $stm1->bindParam(":user_id", $user_id, PDO::PARAM_INT);
        $stm1->execute();

        $stm2 = $this->conn->prepare(
            "INSERT INTO user_groups (user_id,group_id) VALUES (:user_id, :group_id)"
        );

        foreach ($group_ids as $key => $group_id) {
            if ($group_id == '1') {
                $stm2->bindValue(":user_id", $user_id);
                $stm2->bindValue(":group_id", $key);
                $stm2->execute();
            }
        }

        $this->conn->commit();
        return (int) $user_id;
    }

    public function deleteUser(int $id): string|false
    {
        $stm = $this->conn->prepare(
            "DELETE FROM users WHERE id = :id"
        );
        $stm->bindParam(":id", $id);

        return ($stm->execute()) ? $id : false;
    }

    public function getModelName(): string
    {
        return $this->modelName;
    }
}