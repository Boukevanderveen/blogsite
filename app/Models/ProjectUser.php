<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class ProjectUser extends Pivot
{
    protected $fillable = [
        'project_id',
        'user_id',
        'role_id',
        ];
    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }
}
