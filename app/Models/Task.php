<?php

namespace App\Models;

use App\Exceptions\CannotDeleteTaskException;
use App\Exceptions\TaskAlreadyExistsException;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @method static findOrFail(int $id)
 * @method static find(int $taskId)
 * @method static where(string $string, string $name)
 * @method static create(string[] $array)
 */
final class Task extends Model
{
    use HasFactory;

    protected $fillable = ['name'];
    private int $id;
    private string $name;

    /**
     * @throws TaskAlreadyExistsException
     */
    public static function createOrFail(string $name): self
    {
        if (self::where('name', $name)->exists()) {
            throw new TaskAlreadyExistsException($name);
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

    public function name(): string
    {
        return $this->name;
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'task_category');
    }
}
