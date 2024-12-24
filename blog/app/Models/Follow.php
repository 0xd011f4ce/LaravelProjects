<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    //
    protected $fillable = [
        "user_id",
        "following_id"
    ];

    public function source ()
    {
        return $this->belongsTo (User::class, "user_id");
    }

    public function target ()
    {
        return $this->belongsTo (User::class, "following_id");
    }
}
