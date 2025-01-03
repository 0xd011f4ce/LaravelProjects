<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'username',
        'avatar',
        'email',
        'password',
    ];

    protected function avatar () : Attribute
    {
        return Attribute::make (get: function ($value) {
            return $value ? "/storage/avatars/" . $value : "/fallback-avatar.jpg";
        });
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function posts ()
    {
        return $this->hasMany(Post::class);
    }

    public function followers () {
        return $this->hasMany (Follow::class, "following_id");
    }

    public function following () {
        return $this->hasMany (Follow::class, "user_id");
    }

    public function feed_posts ()
    {
        return $this->hasManyThrough (Post::class, Follow::class, "user_id", "user_id", "id", "following_id");
    }
}
