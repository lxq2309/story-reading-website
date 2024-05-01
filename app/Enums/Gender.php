<?php
namespace App\Enums;
enum Gender: int
{
    case MALE = 0;
    case FEMALE = 1;

    public function label(): string
    {
        return match ($this) {
            Gender::FEMALE => 'Nữ',
            Gender::MALE => 'Nam',
        };
    }
}
