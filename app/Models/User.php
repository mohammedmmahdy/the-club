<?php

namespace App\Models;

use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail, JWTSubject

{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        // 'first_name',
        // 'last_name',
        // 'phone',
        // 'status',
        // 'member_id',
        'email',
        'password',
        'balance',
        'points',
        'social_status', //  1 => Single, 2 => Married
        'num_of_children',



        'iMemberId',
        'strCardNumber',
        'member_mobile',
        'dateCardDateValidFrom',
        'dateCardDateExpire',
        'timeTimeFrom',
        'timeTimeTo',
        'strMemberName',
        'iMemberType',
        'dateBirthdate',
        'boolMemberStatus',
        'iMainMemberID',
        'strImageName_DataSoft',
        'strImgURL_DataSoft',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];



    // Rest omitted for brevity

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }




    public function setPasswordAttribute($value)
    {
        return $this->attributes['password'] = Hash::make($value);
    }

    /////////////////// Appends ///////////////////

    public $appends = ['status_text'];

    public function getStatusTextAttribute()
    {
        switch ($this->status) {
            case 0:
                return 'Inactive';
                break;
            case 1:
                return 'Lead';
                break;
            case 2:
                return 'Member';
                break;

            default:
                break;
        }
    }



    ///////////////////////// Relations ////////////////////////////

    public function academies()
    {
        return $this->hasMany(AcademySubscription::class);
    }

    public function events()
    {
        return $this->hasMany(EventReservation::class);
    }

    public function playgrounds()
    {
        return $this->hasMany(PlaygroundReservation::class);
    }

    public function tickets()
    {
        return $this->hasMany(TicketReservation::class);
    }
}
