<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Silber\Bouncer\Database\HasRolesAndAbilities;

class User extends Authenticatable
{
    use Notifiable;
    use HasRolesAndAbilities;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'color'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * A user can have many messages
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function messages() {

        return $this->hasMany(Message::class);
    }

    /**
     * Return user chat profile
     *
     * @return array
     */
    public function getChatProfileAttribute()
    {
        return [
            'id' => $this->id,
            'color' => $this->color,
            'name' => $this->name,
            'isAdmin' => $this->isAn('admin')
        ];
    }
}
