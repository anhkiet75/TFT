<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;
use Laracasts\Presenter\PresentableTrait;
use App\Presenters\UserPresenter;

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;
    use PresentableTrait;
    // use UserPresenter;
    protected $presenter = UserPresenter::class;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    public function conversations() {
        return $this->hasMany(Conversation::class,'creator_id');
    }

    public  function messages() {
        return $this->hasMany(Message::class,'sender_id');
    }

    public  function participants() {
        return $this->hasMany(Participant::class,'user_id');
    }

    public function contacts()
    {
        return $this->belongsToMany(Contact::class,'user_contact','user_id','contact_id');

    }

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
}
