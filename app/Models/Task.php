<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Task
 * @property string $name
 * @property string $description
 * @property string $status
 */
class Task extends Model
{
    use HasFactory;

    public $table = 'tasks';

    protected $fillable =
        [
            'name',
            'description',
            'status',
        ];
}
