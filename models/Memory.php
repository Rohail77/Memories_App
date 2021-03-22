<?php

namespace models;

use app\Database;

class Memory
{
    private string $title;
    private string $date_time ;
    private ?string $description;
    private ?string $image;

    public function load(array $data) : void {
        $this->title = $data['title'];
        $this->description = $data['description'];
        $this->date_time = $data['date_time'];
        $this->image = $data['image'];
    }

    public function save() : void {
        $db = new Database();
        $memory = [
            'title'=>$this->title,
            'date_time'=>$this->date_time,
            'description'=>$this->description,
            'image'=>$this->image
        ];
        $db->addMemory($memory);
    }

}
