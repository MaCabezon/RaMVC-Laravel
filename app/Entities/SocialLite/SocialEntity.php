<?php namespace App\Entities\SocialLite;

use App\Entities\BaseEntity;
use App\User;
use Illuminate\Database\Eloquent\Model;

class SocialEntity extends Model{

    protected $table = 'social_logins';

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
