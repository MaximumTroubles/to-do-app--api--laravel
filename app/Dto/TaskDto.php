<?php

namespace App\Dto;

class TaskDto
{
    private string $name;
    private string $description;
    private string $status;
    private int $user_id;

    public function __construct(string $name, string $description, string $status, int $user_id)
    {
        $this->name = $name;
        $this->description = $description;
        $this->status = $status;
        $this->user_id = $user_id;
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

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->user_id;
    }

}
