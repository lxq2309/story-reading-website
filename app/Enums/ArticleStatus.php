<?php
namespace App\Enums;
enum ArticleStatus: int
{
    case PENDING = 0;
    case APPROVED = 1;
    case HIDDEN = 2;

    public function label(): string
    {
        return match ($this) {
            ArticleStatus::PENDING => 'Đang chờ duyệt',
            ArticleStatus::APPROVED => 'Đã được duyệt',
            ArticleStatus::HIDDEN => 'Đã bị ẩn',
        };
    }
}
