<?php

namespace Locomotif\Designers\Models;

use Illuminate\Database\Eloquent\Model;
use Locomotif\Admin\Models\User;

class Designer extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
