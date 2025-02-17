<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @method static create(array $array)
 * @method static where(string $string, mixed $input)
 * @method static find(int $taskId)
 */

final class Task extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'task_category');
    }
}
