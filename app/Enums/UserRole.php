<?php
namespace App\Enums;
enum UserRole: int
{
    case USER = 0;
    case POSTER = 1;
    case ADMIN = 2;

    public function label(): string
    {
        return match ($this) {
            UserRole::USER => 'Người dùng',
            UserRole::POSTER => 'Người đăng bài',
            UserRole::ADMIN => 'Quản trị viên',
        };
    }

    public function color() : string
    {
        return match ($this) {
            UserRole::USER => '',
            UserRole::POSTER => 'darkcyan',
            UserRole::ADMIN => 'red',
        };
    }
}
