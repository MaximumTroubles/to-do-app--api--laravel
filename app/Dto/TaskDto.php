<?php

namespace App\Dto;

class TaskDto
{
    private string $name;
    private string $description;
    private string $status;

    public function __construct(string $name, string $description, string $status)
    {
        $this->name = $name;
        $this->description = $description;
        $this->status = $status;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }
}
