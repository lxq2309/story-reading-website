<?php

namespace App\Models;

use App\Enums\Gender;
use App\Enums\UserRole;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    public static function getAdmins()
    {
        return self::query()->where('role', UserRole::ADMIN);
    }

    public static function getPosters()
    {
        return self::query()->where('role', UserRole::POSTER);
    }

    public static function getBanneds()
    {
        $bannedUserIds = BannedUser::query()->pluck('user_id')->toArray();
        return self::query()->whereIn('id', $bannedUserIds);
    }

    protected function getRoleAttribute($value)
    {
        return UserRole::from($value)->label();
    }

    protected function getDateOfBirthAttribute($value)
    {
        return Carbon::parse($value)->format('d-m-Y');
    }

    protected function getGenderAttribute($value)
    {
        return Gender::from($value)->label();
    }


    public function banned(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(BannedUser::class, 'user_id', 'id');
    }
}
