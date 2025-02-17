<?php

namespace App\Models;

use App\Exceptions\CategoryAlreadyExistsException;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @method static firstOrCreate(string[] $array)
 * @method static where(string $string, string $name)
 * @method static create(string[] $array)
 */
final class Category extends Model
{
    use HasFactory;

    private int $id;
    private string $name;

    /**
     * @throws CategoryAlreadyExistsException
     */
    public static function createOrFail(string $name): self
    {
        if (self::where('name', $name)->exists()) {
            throw new CategoryAlreadyExistsException($name);
        }

        return self::create(['name' => $name]);
    }

    public function id(): int
    {
        return $this->id;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function tasks(): BelongsToMany
    {
        return $this->belongsToMany(Task::class, 'task_category');
    }
}
