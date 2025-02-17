<?php

namespace App\Services\Contracts;

interface CreateTaskServiceInterface {
    public function validate(array $data): void;
    public function create(array $data): array;
}
