<?php
namespace App\Enums;
enum ArticleCompleteStatus: int
{
    case COMPLETED = 1;
    case NOT_COMPLETED = 0;

    public function label(): string
    {
        return match ($this) {
            ArticleCompleteStatus::COMPLETED => 'Đã hoàn thành',
            ArticleCompleteStatus::NOT_COMPLETED => 'Chưa hoàn thành',
        };
    }
}
