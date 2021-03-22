<?php

namespace app;

use \PDO;

class Database
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = new PDO("mysql:host=localhost;port=3306;dbname=memories", 'root', '');
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function getMemories($searchParam): array
    {
        $statement = $this->pdo->prepare("SELECT * FROM memories WHERE title LIKE :title ORDER BY date_time DESC");
        $statement->bindValue(":title", "%$searchParam%");
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getMemory($id): array
    {
        $statement = $this->pdo->prepare("SELECT id,title,date_time,description,image FROM memories WHERE id=:id");
        $statement->bindValue(":id", $id);
        $statement->execute();
        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    public function addMemory(array $memory)
    {
        $statement = $this->pdo->prepare("INSERT INTO memories(title, date_time,description, image) VALUES (:title, :date_time, :description, :image)");
        $statement->bindValue(":title", $memory['title']);
        $statement->bindValue(":date_time", $memory['date_time']);
        $statement->bindValue(":description", $memory['description']);
        $statement->bindValue(":image", $memory['image']);
        $statement->execute();
        header("Location:/");
    }

    public function deleteMemory($id)
    {
        $statement = $this->pdo->prepare("DELETE FROM memories WHERE id=:id");
        $statement->bindValue(":id", $id);
        $statement->execute();
        header("Location:/");
    }

    public function updateMemory($memory, $imageFlag)
    {
        $statement = $imageFlag ?
            $this->pdo->prepare("UPDATE memories SET title=:title, date_time=:date_time, description=:description, image=:image WHERE id=:id"):
            $this->pdo->prepare("UPDATE memories SET title=:title, date_time=:date_time, description=:description WHERE id=:id");
        $statement->bindValue(":id", $memory['id']);
        $statement->bindValue(":title", $memory['title']);
        $statement->bindValue(":date_time", $memory['date_time']);
        $statement->bindValue(":description", $memory['description']);
        if ($imageFlag) $statement->bindValue(":image", $memory['image']);
        $statement->execute();
    }

    public function getImage($id) {
        $statement = $this->pdo->prepare("SELECT image FROM memories WHERE id=:id");
        $statement->bindValue(":id", $id);
        $statement->execute();
        return $statement->fetch()['image'];
    }
}