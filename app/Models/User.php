<?php

/*
 * This file is part of Hifone.
 *
 * (c) Hifone.com <hifone@hifone.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Hifone\Models;

use AltThree\Validator\ValidatingTrait;
use Hifone\Presenters\UserPresenter;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Database\Eloquent\Model;
use McCool\LaravelAutoPresenter\HasPresenter;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract, HasPresenter
{
    use Authenticatable, CanResetPassword, EntrustUserTrait, ValidatingTrait;

    // Enable hasRole( $name ), can( $permission ),
    //   and ability($roles, $permissions, $options)

    // Enable soft delete

    protected $dates = ['deleted_at'];

    /**
     * The properties that cannot be mass assigned.
     *
     * @var string[]
     */
    protected $guarded = ['id', 'notifications', 'is_banned'];

    /**
     * The hidden properties.
     *
     * These are excluded when we are serializing the model.
     *
     * @var string[]
     */
    protected $hidden = ['password', 'remember_token'];
    /**
     * The validation rules.
     *
     * @var string[]
     */
    public $rules = [
        'username' => ['required', 'max:15', 'regex:/\A[A-Za-z0-9\-\_\.]+\z/'],
        'email'    => 'required|max:255',
        'password' => 'required',
    ];

    protected $searchable = [
        'username',
    ];

    /**
     * Find by username, or throw an exception.
     *
     * @param string $username The username.
     * @param mixed  $columns  The columns to return.
     *
     * @throws ModelNotFoundException if no matching User exists.
     *
     * @return User
     */
    public static function findByUsernameOrFail(
        $username,
        $columns = ['*']
    ) {
        if (!is_null($user = static::whereUsername($username)->first($columns))) {
            return $user;
        }

        throw new ModelNotFoundException();
    }

    public function favoriteThreads()
    {
        return $this->belongsToMany(Thread::class, 'favorites')->withTimestamps();
    }

    /**
     * Users can have many threads.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function threads()
    {
        return $this->hasMany(Thread::class);
    }

    /**
     * Users can have many replies.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function replies()
    {
        return $this->hasMany(Reply::class);
    }

    /**
     * Users can have many credits.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function credits()
    {
        return $this->hasMany(Credit::class);
    }

    /**
     * Users can have many notifications.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }

    public function follows()
    {
        return $this->morphMany(Follow::class, 'followable');
    }

    public function identities()
    {
        return $this->hasMany(Identity::class);
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function scopeSearch($query, $search)
    {
        return  $query->where(function ($query) use ($search) {
            $query->where('username', 'LIKE', "%$search%");
        });
    }

    /**
     * ----------------------------------------
     * UserInterface
     * ----------------------------------------.
     */
    public function getAuthIdentifier()
    {
        return $this->getKey();
    }

    public function getAuthPassword()
    {
        return $this->password;
    }

    /**
     * ----------------------------------------
     * RemindableInterface
     * ----------------------------------------.
     */
    public function getReminderEmail()
    {
        return $this->email;
    }

    public function getRememberToken()
    {
        return $this->remember_token;
    }

    public function setRememberToken($value)
    {
        $this->remember_token = $value;
    }

    public function getRememberTokenName()
    {
        return 'remember_token';
    }

    public function getAvatarAttribute()
    {
        return $this->avatar_url ? $this->avatar_url : '/images/avatar.jpg';
    }

    public function getAvatarSmallAttribute()
    {
        return $this->avatar_url ? $this->avatar_url : '/images/avatar_small.jpg';
    }

    /**
     * Cache github avatar to local.
     */
    public function cacheAvatar()
    {
        //Download Image
        $guzzle = new GuzzleHttp\Client();
        $response = $guzzle->get($this->image_url);

        //Get ext
        $content_type = explode('/', $response->getHeader('Content-Type'));
        $ext = array_pop($content_type);

        $avatar_name = $this->id.'_'.time().'.'.$ext;
        $save_path = public_path('uploads/avatars/').$avatar_name;

        //Save File
        $content = $response->getBody()->getContents();
        file_put_contents($save_path, $content);

        //Delete old file
        if ($this->avatar) {
            @unlink(public_path('uploads/avatars/').$this->avatar);
        }

        //Save to database
        $this->avatar = $avatar_name;
        $this->save();
    }

    /**
     * Get the presenter class.
     *
     * @return string
     */
    public function getPresenterClass()
    {
        return UserPresenter::class;
    }
}
