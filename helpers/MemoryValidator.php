<?php

namespace helpers;

class MemoryValidator
{
    private array $memory;
    private array $error;

    public function __construct($data)
    {
        $this->memory = [
            'title' => $data['title'],
            'date_time' => $data['date_time'],
            'description' => $data['description'],
            'image' => $data['image']
        ];
        $this->error = [];
    }

    public function validate()
    {
        if(!$this->memory['title'] ) $this->error[] = "Title is required";
        if(!$this->memory['date_time'] ) $this->error[] = "Date & Time is required";
    }

    public function validationSuccessfull() : bool {
        return $this->error ? false : true;
    }

    public function getErrors(): array {
        return $this->error;
    }
}