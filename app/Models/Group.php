<?php

declare(strict_types=1);

namespace App\Models;

use DB;
use PDO;

class Group
{
    private PDO $conn;
    protected string $modelName = 'Group';

    public function __construct()
    {
        $db = DB::getInstance();
        $this->conn = $db->getConnection();
    }

    public function getAllGroups(): bool|array
    {
        $stm = $this->conn->prepare(
            "SELECT * FROM groups;"
        );
        return ($stm->execute()) ? $stm->fetchAll() : false;
    }


    public function getGroup(int $id): bool|array
    {
        $stm = $this->conn->prepare(
            "SELECT * FROM groups AS g
                    WHERE g.id = :id"
        );
        $stm->bindParam(":id", $id);

        return ($stm->execute()) ? $stm->fetch() : false;
    }

    public function setGroup(string $name): string|false
    {
        $stm = $this->conn->prepare(
            "INSERT INTO `groups` 
                        (`name`) VALUES (:name)"
        );
        $stm->bindParam(":name", $name);

        return ($stm->execute()) ? $this->conn->lastInsertId() : false;
    }

    public function updateGroup(int $id, string $name): string|false
    {
        $stm = $this->conn->prepare(
            "UPDATE groups AS g
                    SET name = :name
                    WHERE g.id = :id;"
        );
        $stm->bindParam(":id", $id);
        $stm->bindParam(":name", $name);

        return ($stm->execute()) ? $id : false;
    }

    public function deleteGroup(int $id): string|false
    {
        $stm = $this->conn->prepare(
            "DELETE FROM groups WHERE id = :id"
        );
        $stm->bindParam(":id", $id);

        return ($stm->execute()) ? $id : false;
    }

    public function getModelName(): string
    {
        return $this->modelName;
    }
}