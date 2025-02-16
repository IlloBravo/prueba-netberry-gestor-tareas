<?php

namespace App\Models;

use App\Exceptions\CategoryAlreadyExistsException;
use App\ValueObjects\CategoryName;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @method static firstOrCreate(string[] $array)
 * @method static where(string $string, CategoryName $name)
 * @method static create(CategoryName[] $array)
 */
final class Category extends Model
{
    use HasFactory;

    private int $id;
    private CategoryName $name;

    /**
     * @throws CategoryAlreadyExistsException
     */
    public static function createOrFail(CategoryName $name): self
    {
        if (self::where('name', $name)->exists()) {
            throw new CategoryAlreadyExistsException($name->value());
        }

        return self::create(['name' => $name]);
    }

    public function id(): int
    {
        return $this->id;
    }

    public function name(): CategoryName
    {
        return $this->name;
    }

    public function tasks(): BelongsToMany
    {
        return $this->belongsToMany(Task::class, 'task_category');
    }
}
