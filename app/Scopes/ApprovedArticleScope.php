<?php

namespace App\Scopes;

use App\Enums\ArticleStatus;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class ApprovedArticleScope implements Scope
{

    public function apply(Builder $builder, Model $model): void
    {
        $builder->where('status', ArticleStatus::APPROVED);
    }
}
