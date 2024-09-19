<?php

namespace App\Models;

use HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    use HasUuid;

    public function getRouteKeyName(): string
    {
        return 'uuid';
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function paychecks()
    {
        return $this->hasMany(Paycheck::class);
    }

    public function time_logs()
    {
        return $this->hasMany(Timelog::class);
    }
}
