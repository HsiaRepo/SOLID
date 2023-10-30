<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;

abstract class Repository
{
    /**
     * @return Collection
     */
    abstract public function all(): Collection;
}
