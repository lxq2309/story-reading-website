<?php

namespace App\Models;

use App\Enums\Gender;
use App\Enums\UserRole;
use Carbon\Carbon;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\MustVerifyEmail;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail as MustVerifyEmailContract;
use Illuminate\Support\Facades\Session;

class User extends Model implements AuthenticatableContract,
    CanResetPasswordContract, MustVerifyEmailContract
{
    use HasFactory, Authenticatable, Notifiable, CanResetPassword, MustVerifyEmail;

    protected $fillable
        = [
            'username', 'name', 'email', 'password', 'avatar', 'description',
            'address',
            'role', 'date_of_birth', 'gender', 'remember_token'
        ];

    public function getIsAdminAttribute(): bool
    {
        return $this->role === UserRole::ADMIN->value;
    }

    public function getIsPosterAttribute(): bool
    {
        return $this->role === UserRole::POSTER->value;
    }

    public function getIsUserAttribute(): bool
    {
        return $this->role === UserRole::USER->value;
    }

    public function renderHtmlTextColor(
        $text,
        $color,
        $isBanned = false
    ): string {
        return '<span style="color: '.$color.';'
            .'text-shadow: 0 1px 1px whitesmoke;'
            .($isBanned ? 'text-decoration: line-through' : '')
            .'">'
            .$text.'</span>';
    }

    public function renderUserName()
    {
        $color = UserRole::from($this->role)->color();
        $isBanned = !empty($this->banned);
        return $this->renderHtmlTextColor($this->username, $color, $isBanned);
    }

    public function renderRoleText()
    {
        $color = UserRole::from($this->role)->color();
        return $this->renderHtmlTextColor($this->role_text, $color);
    }

    public function getAuthIdentifierName()
    {
        return 'id';
    }

    public function getAuthIdentifier()
    {
        return $this->getKey();
    }

    public function getAuthPassword()
    {
        return $this->password;
    }

    public function getRememberToken()
    {
        return $this->remember_token;
    }

    public function setRememberToken($value)
    {
        $this->remember_token = $value;
    }

    public function getRememberTokenName()
    {
        return 'remember_token';
    }

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
        return Carbon::parse($value)->toDateString();
    }

    protected function getGenderTextAttribute()
    {
        $value = $this->gender;
        return Gender::from($value)->label();
    }

    public function getVerifiedStatusTextAttribute()
    {
        return $this->hasVerifiedEmail() ? 'Đã xác thực' : 'Chưa xác thực';
    }

    protected function getCreatedAtTextAttribute()
    {
        return $this->created_at->diffForHumans();
    }

    protected function getUpdatedAtTextAttribute()
    {
        return $this->updated_at->diffForHumans();
    }

    protected function getBannedAttribute()
    {
        if (is_route('admin.*')) {
            return $this->banned()->first();
        } else {
            // Khóa session cho người dùng cụ thể này
            $sessionKey = 'banned_user_'.$this->id;

            // Kiểm tra xem đã có thông tin trong session chưa và lấy ra nếu có
            if (!session()->exists($sessionKey)) {
                // Lưu trữ vào session nếu chưa có
                $bannedUser = $this->banned()->first();
                session()->put($sessionKey, $bannedUser);
            }

            // Lấy thông tin từ session
            return session($sessionKey);
        }
    }

    public function hasAnyRole(array $roles)
    {
        foreach ($roles as $role) {
            if ($this->hasRole($role)) {
                return true;
            }
        }

        return false;
    }

    public function hasRole($role): bool
    {
        return $this->role === $role;
    }


    public function banned(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(BannedUser::class, 'user_id', 'id');
    }

    public function articles(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Article::class, 'user_id', 'id');
    }

    public function bookmarks(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Bookmark::class, 'user_id', 'id');
    }

    public function comments(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Comment::class, 'user_id', 'id');
    }

    public function setShouldReLogin($value)
    {
        $this->should_re_login = $value;
        $this->setRememberToken(null);
        $this->save();
    }

}
