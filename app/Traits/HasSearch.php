<?php

namespace App\Traits;

trait HasSearch
{
    public function search($query, string $search, array $columns): void
    {
        $query->where(function ($query) use ($search, $columns) {
            foreach ($columns as $column) {
                $query->orWhere(
                    $column,
                    'like',
                    "%{$search}%"
                );
            }
        });
    }
}