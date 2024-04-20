<?php
namespace App\Enums;
enum Gender: int
{
    case FEMALE = 0;
    case MALE = 1;

    public function label(): string
    {
        return match ($this) {
            Gender::FEMALE => 'Nữ',
            Gender::MALE => 'Nam',
        };
    }
}
