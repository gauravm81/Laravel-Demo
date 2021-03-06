<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Traits\FeaturedImage;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
	
	use FeaturedImage;

    public $resource_name = 'user';
    public $featured_image_db_name = 'avatar';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'uuid', 'first_name', 'last_name', 'name', 'email', 'password', 'phone', 'avatar', 'facebook', 'twitter', 'linkedin', 'website', 'street', 'suite', 'city', 'state', 'zipcode', 'phone', 'office_contact', 'about'
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
    
    public function isAdmin()
    {
        return $this->admin; // this looks for an admin column in your users table
    }
    
    public function phoneNiceFormat()
    {
        $phone = '';

        if (strlen($this->phone) == 10) {
            $phone = '(' . substr($this->phone, 0, 3) . ') ' . substr($this->phone, 3, 3) . '-' . substr($this->phone, 6, 4);
        }

        if ($phone)
            return $phone;
        else
            return $this->phone;
    }

}
