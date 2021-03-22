<?php

namespace controllers;

use helpers\FileHelper;
use helpers\MemoryValidator;
use models\Memory;
use app\Database;
use app\ViewRenderer;

class MemoriesController
{

    private static Database $db;
    private static Memory $memory;

    public static function index()
    {
        self::$db = new Database();
        $memories = self::$db->getMemories($_GET['search'] ?? "");
        $search = $_GET['search'] ?? "";
        ob_start();
        include_once __DIR__ . "/../views/memories/index.php";
        ViewRenderer::renderView(ob_get_clean(), [
            'tabTitle' => 'Memory App'
        ]);
    }

    public static function details()
    {
        self::$db = new Database();
        $memory = self::$db->getMemory($_GET['id']);
        $memory['image'] = FileHelper::getFileName($memory['image']);
        ob_start();
        include_once __DIR__ . "/../views/memories/details.php";
        ViewRenderer::renderView(ob_get_clean(), [
            'tabTitle' => 'Memory Details'
        ]);
    }

    public static function create()
    {
        $_SERVER['REQUEST_METHOD'] === "GET" ? self::create_get() : self::create_post();
    }

    private static function create_get()
    {
        ob_start();
        $title = '';
        $description = "";
        $date_time = '';
        $errors = [];
        include_once __DIR__ . "/../views/memories/create.php";
        ViewRenderer::renderView(ob_get_clean(), [
            'tabTitle' => 'Add A Memory',
        ]);
    }

    private static function create_post()
    {
        $data['title'] = $_POST['title'];
        $data['date_time'] = $_POST['date_time'];
        $data['description'] = $_POST['description'];
        $data['image'] = ($_FILES['image']['tmp_name'] ? FileHelper::moveUploadedFile() : "");
        $errors = self::validateMemory($data);
        if ($errors) {
            ob_start();
            $title = $data['title'];
            $date_time = $data['date_time'];
            $description = $data['description'];
            include_once __DIR__ . "/../views/memories/create.php";
            ViewRenderer::renderView(ob_get_clean(), [
                'tabTitle' => 'Add A Memory',
            ]);
            exit;
        } else {
            self::$memory = new Memory();
            self::$memory->load($data);
            self::$memory->save();
        }
    }

    public static function update()
    {
        $_SERVER['REQUEST_METHOD'] === "GET" ? self::update_get() : self::update_post();
    }

    private static function update_get()
    {
        self::$db = new Database();
        $memory = self::$db->getMemory($_GET['id']);

        $title = $memory['title'];
        $description = $memory['description'];
        $date_time = date("Y-m-d\TH:i:s", strtotime($memory['date_time']));
        $image = FileHelper::getFileName($memory['image']);
        $errors = [];
        ob_start();
        include_once __DIR__ . "/../views/memories/update.php";
        ViewRenderer::renderView(ob_get_clean(), [
            'tabTitle' => 'Update Memory',
        ]);
    }

    private static function update_post()
    {
        $memory['id'] = $_GET['id'];
        $memory['title'] = $_POST['title'];
        $memory['date_time'] = $_POST['date_time'];
        $memory['description'] = $_POST['description'];
        $memory['image'] = $_FILES['image']['name'] ?: "";
        $errors = self::validateMemory($memory);
        if ($errors) {
            ob_start();
            $title = $memory['title'];
            $date_time = $memory['date_time'];
            $description = $memory['description'];
            include_once __DIR__ . "/../views/memories/update.php";
            ViewRenderer::renderView(ob_get_clean(), [
                'tabTitle' => 'Update Memory',
            ]);
            exit;
        } else {
            self::$db = new Database();
            $imageFlag = false;
            if($_FILES['image']['name']) {
                $imageFlag = true;
                $oldImage = self::$db->getImage($memory['id']);
                unlink($oldImage);
                $memory['image'] = FileHelper::moveUploadedFile();
            }
            self::$db->updateMemory($memory, $imageFlag);
            header("Location: /");
        }
    }

    public static function delete()
    {
        self::$db = new Database();
        self::$db->deleteMemory($_GET['id']);
    }

    private static function getMemories(): array
    {
        return self::$db->getMemories('');
    }

    private static function validateMemory($memory)
    {
        $mv = new MemoryValidator($memory);
        $mv->validate();
        return $mv->getErrors();
    }
}
