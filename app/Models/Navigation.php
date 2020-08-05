<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Navigation extends Model
{
    use LogsActivity;

    protected $guarded = [];

    public function children()
    {
        return $this->hasMany(self::class,'parent_id');
    }
}
