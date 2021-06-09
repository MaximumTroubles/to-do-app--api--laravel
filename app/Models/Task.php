<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Task
 * @property string $name
 * @property string $description
 * @property string $status
 * @property int $user_id
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
            'user_id',
        ];


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
