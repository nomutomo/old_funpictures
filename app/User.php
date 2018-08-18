<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

use App\Image;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','profile','image_path'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    public function messages()
    {
        return $this->hasMany(Message::class);
    }
    
    public function followings()
    {
        return $this->belongsToMany(User::class, 'user_follow', 'user_id', 'follow_id')->withTimestamps();
    }
    
    public function followers()
    {
        return $this->belongsToMany(User::class, 'user_follow', 'follow_id', 'user_id')->withTimestamps();
    }
    
    public function pickups()
    {
        return $this->hasMany(Pickup::class);
    }
    
    public function images()
    {
        return $this->hasManyThrough(Image::class, Message::class, 'user_id', 'message_id', 'id', 'id');
    }
    
    public function follow($userId)
    {
            // フォローしているか
            $exist = $this->is_following($userId);
            // 自分自身ではないか
            $its_me = $this->id == $userId;
            
            if ($exist || $its_me) {
                return false;
            }else {
                $this->followings()->attach($userId);
                return true;
            }
    }
    
    public function unfollow($userId)
    {
            $exist = $this->is_following($userId);
            $its_me = $this->id == $userId;
            
            if ($exist && !$its_me) {
                $this->followings()->detach($userId);
                return true;
            }else {
                return false;
            }
    }
    
    public function is_following($userId) {
        return $this->followings()->where('follow_id', $userId)->exists();
    }
    
    // タイムラインへ表示分抜出（自分のみ）
    public function messages_withimage() {
        return Message::leftJoin('images', 'messages.id', '=', 'images.message_id')
            ->where('messages.user_id', $this->id)
            ->select('messages.*' , 'images.image_path');
        //日付がカラム名重複でエラーになるため、必要なカラムをSELECT文で抜出。
    }
    
    // タイムラインへ表示分抜出（自分＋フォロー）
    public function feed_messages()
    {
        $follow_user_ids = $this->followings()-> pluck('users.id')->toArray();
        $follow_user_ids[] = $this->id;
        return Message::leftJoin('images', 'messages.id', '=', 'images.message_id')
            ->whereIn('user_id', $follow_user_ids)
            ->select('messages.*' , 'images.image_path');
        //日付がカラム名重複でエラーになるため、必要なカラムをSELECT文で抜出。
    }
    
    // ピックアップ投稿の抜出
    public function pickup_messages()
    {
        return Message::join('pickups', 'messages.id' ,'=', 'pickups.message_id')
            ->leftJoin('images', 'messages.id', '=', 'images.message_id')
            ->where('messages.user_id', $this->id)
            ->select('pickups.grid_no', 'grid_size','messages.*', 'images.image_path');
             //日付がカラム名重複で、一番最後に結合したテーブルの日付しか表示されないため、必要なカラムをSELECT文で抜出。
        
    }
    
}
