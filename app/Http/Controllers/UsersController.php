<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;

use App\Message; //追加

use App\Pickup; //追加

use App\Image; //追加

use Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class UsersController extends Controller
{
    public function index()
    {
        $users = User::paginate(2);
        
        return view('users.index', [
            'users' => $users,
        ]);
    }
    
    public function show($id)
    {
        $user = User::find($id);
        
        if( isset($user) ) {
            
            $messages = $user->messages_withimage()->orderBy('created_at', 'desc')->paginate(5);
            $data = [
                'user' => $user,
                'messages' => $messages,
            ];
            $data += $this->counts($user);
            return view('users.show', $data);
        }else {
            return back();
        }
            
    }
    
    public function pickups($id) {
    
        $user = User::find($id);
        
        if( isset($user) ) {
            
            $messages = $user->pickup_messages()->orderBy('grid_no', 'asc')->paginate(9);
            
            /* $sql = 'select pickups.grid_no, pickups.grid_size, messages.*,' .
                    ' images.image_path from messages inner join pickups' .
                    ' on messages.id = pickups.message_id' .
                    ' left join images on messages.id = images.message_id' .
                    ' where messages.user_id = ' . $id .
                    ' order by grid_no asc';
           $messages = DB::select($sql); */

            $data = [
                'user' => $user,
                'messages' => $messages,
            ];
            
            $data += $this->counts($user);
            
            //return $data;
            
            return view('users.pickups', $data);
        }else {
            return back();
        }
    }
    
    public function edit() {
    
        $user = \Auth::user();
        
        if( isset($user) ) {
            
            $messages = $user->messages_withimage()->orderBy('created_at', 'desc')->paginate(5);
            $pickups = $user->pickup_messages()->orderBy('grid_no', 'asc')->paginate(9);

            $data = [
                'user' => $user,
                'messages' => $messages,
                'pickups' => $pickups,
            ];
            
            $data += $this->counts($user);
            
            //return $data;
            
            return view('mymenu.edit', $data);
        }else {
            return back();
        }
    }
    
    
    public function followings($id)
    {
        $user = User::find($id);
        
        if( isset($user) ) {
            $followings = $user->followings()->paginate(2);
            
            $data = [
                'user' => $user,
                'users' => $followings,
            ];
            
            $data += $this->counts($user);
            
            return view('users.followings', $data);
        }else {
            return back();
        }
    }
    
    public function followers($id)
    {

        $user = User::find($id);
        if( isset($user) ) {
            $followers = $user->followers()->paginate(2);
            
            $data =[
                'user' => $user,
                'users' => $followers,
            ];
            
            $data += $this->counts($user);
            
            return view('users.followers', $data);
        }else {
            return back();
        }
    }
    
    public function favorites($id)
    {
        $user = User::find($id);
        
        if( isset($user) ) {
            
            $messages = $user->favorites()->orderBy('created_at', 'desc')->paginate(2);
            $data = [
                'user' => $user,
                'messages' => $messages,
            ];
            $data += $this->counts($user);
            return view('users.favorites', $data);
        }else {
            return back();
        }
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        
        if( empty($user) ) {
            return redirect('/')->with('message', config('const.errmsg_0001'));
            
        }elseif (\Auth::id() === $user->id) {
            
            //return $request;
            
            if( $request->page === 'プロフィール') {
                $this->validate($request, [
                    'name' => 'required|string|max:191',
                    'email' => ['required','string','email','max:191',
                                Rule::unique('users')->ignore($user->id),
                            ],
                    'profile' => 'max:191',
                    'file' => [
                        // アップロードされたファイルであること
                        'file',
                        // 画像ファイルであること
                        'image',
                        // MIMEタイプを指定
                        'mimes:jpeg,jpg,png,gif',
                        // 最小縦横120px 最大縦横400px
                        'dimensions:min_width=120,min_height=120,max_width=400,max_height=400',
                        // 文字数最大191
                        'max:191',
                    ]
                ]);
                
                //return $request->file;
                
                if ($request->file !== null) {
                    $oldfile = $user->image_path;
                    $filename = basename($request->file->store('public/avatar/' . $user->id));
                } else {
                    $filename = $user->image_path;
                }
                
                $request->user()->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'profile' => $request->profile,
                    'image_path' => $filename
                ]);
                if ($request->file !== null) {
                    if (isset($oldfile)) {
                        Storage::delete('public/avatar/' . $user->id . '/' . $oldfile);
                    }
                }
                
                return redirect('/')->with('message', $request->page . config('const.msg_0002'));
                
            } elseif( $request->page === 'パスワード') {
                $this->validate($request, [
                    'password' => 'required|string|min:6|confirmed',
                    'password_confirmation' => 'required',
                ]);
                
                $request->user()->update([
                    'password' => bcrypt($request->password),
                ]);
                
                return redirect('/')->with('message', $request->page . config('const.msg_0002'));
                
            } else {
                return redirect('/')->with('message', config('const.errmsg_0001'));
            }
            
        }else {
            return redirect('/')->with('message', config('const.errmsg_0001'));
        }
        
    }
    
}
