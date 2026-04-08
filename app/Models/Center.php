<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Center extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'name',
        'name_sin',
        'address_01',
        'address_01_sin',
        'address_02',
        'address_02_sin',
        'contact_no',
        'week_days',
        'week_days_sin',
        'week_day_service_time',
        'week_day_service_time_sin',
        'week_ends',
        'week_ends_sin',
        'week_ends_service_time',
        'week_ends_service_time_sin',
        'isDisplay',
        'created_by',
        'updated_by',
    ];

    public function userCreateInfo()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function userUpdateInfo()
    {
        return $this->belongsTo(User::class, 'updated_by', 'id');
    }
}
