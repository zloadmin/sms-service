<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

use Socialite;
use Auth;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract
{
    use Authenticatable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['*'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['remember_token'];

    /**
     * @param $user
     * @param $social_type
     * @return User
     */
    static function FindOrCreateUserAuth($user, $social_type) {



        $finduser = User::where('social_id', '=', $user->getId())->where('social_type', '=', $social_type)->first();


        if(empty($finduser)) {

            $newuser = new User;

            $newuser->social_id = $user->getId();
            $newuser->social_type = $social_type;
            $newuser->nickname = $user->getNickname();
            $newuser->name = $user->getName();
            $newuser->email = $user->getEmail();
            $newuser->avatar = $user->getAvatar();
            $newuser->info = json_encode($user->user);

            $newuser->save();

            Auth::login($newuser);

            return $newuser;
        }
        Auth::login($finduser);

        return redirect('smslist/create');
    }
    static function UserName() {
        $user_id = Auth::retrieveById();
        dd($user_id);
    }

    public function numbersgroup()
    {
        return $this->hasMany('App\NumbersGroup');
    }

}
