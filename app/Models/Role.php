<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Role extends Model
{
    use LogsActivity;

    protected $fillable = [
        'name'
    ];

    protected static $logAttributes = [
        'name', 'email','password','email_verified_at'
    ];

    public function users()
    {
        return $this->belongsToMany('App\Models\User');
    }
}
