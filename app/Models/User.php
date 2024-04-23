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

    protected function getRoleTextAttribute()
    {
        $value = $this->role;
        return UserRole::from($value)->label();
    }

    protected function getDateOfBirthTextAttribute()
    {
        $value = $this->date_of_birth;
        return Carbon::parse($value)->format('d-m-Y');
    }

    protected function getGenderTextAttribute()
    {
        $value = $this->gender;
        return Gender::from($value)->label();
    }


    public function banned(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(BannedUser::class, 'user_id', 'id');
    }

    public function articles(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Article::class, 'user_id', 'id');
    }
}
