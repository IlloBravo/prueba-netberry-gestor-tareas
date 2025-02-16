<?php

namespace App\Models;

use App\Exceptions\CannotDeleteTaskException;
use App\Exceptions\TaskAlreadyExistsException;
use App\ValueObjects\TaskName;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @method static findOrFail(int $id)
 * @method static find(int $taskId)
 * @method static create(TaskName[] $array)
 * @method static where(string $string, TaskName $name)
 */
final class Task extends Model
{
    use HasFactory;

    private int $id;
    private TaskName $name;

    /**
     * @throws TaskAlreadyExistsException
     */
    public static function createOrFail(TaskName $name): self
    {
        if (self::where('name', $name)->exists()) {
            throw new TaskAlreadyExistsException($name->value());
        }

        return self::create(['name' => $name]);
    }

    public function deleteOrFail(): void
    {
        if (!$this->delete()) {
            throw new CannotDeleteTaskException($this->id);
        }
    }

    public function id(): int
    {
        return $this->id;
    }

    public function name(): TaskName
    {
        return $this->name;
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'task_category');
    }
}
