<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BannedUser extends Model
{
    use HasFactory;
    protected $primaryKey = "user_id";

    protected function getRemainingDaysAttribute($value)
    {
        $expiredDate = Carbon::parse($this->expired_at);
        $remainingDays = Carbon::now()->diffInDays($expiredDate);

        return $remainingDays . ' ngày';
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id', 'id');
    }
}
