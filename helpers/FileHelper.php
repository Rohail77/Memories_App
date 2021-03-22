<?php


namespace helpers;

class FileHelper
{
    private static function getFileExtension(string $filepath): string
    {
        return pathinfo($filepath)['extension'];
    }

    public static function moveUploadedFile() : string
    {
        $imagePath = $_FILES['image']['tmp_name'];
        $fileDestination = self::getUploadedFileDestination();
        move_uploaded_file($imagePath, $fileDestination);
        return $fileDestination;
    }

    private static function getUploadedFileDestination() : string {
        return  __DIR__ . "/../public/images/memories/" . UtilFunctions::getRandom() . "." . self::getFileExtension($_FILES['image']['name']);
    }

    public static function getFileName(string $filepath) : string {
        return pathinfo($filepath, PATHINFO_FILENAME) . "." . pathinfo($filepath, PATHINFO_EXTENSION);
    }


}