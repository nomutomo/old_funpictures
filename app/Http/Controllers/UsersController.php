<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;

use App\Message; //追加

use Validator;
use Illuminate\Validation\Rule;

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
            
            $messages = $user->messages()->orderBy('created_at', 'desc')->paginate(2);
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
            
            if( $request->page === 'プロフィール') {
                $page = 'mymenu.profile';
                $this->validate($request, [
                    'name' => 'required|string|max:191',
                    'email' => 'required|string|email|max:191|unique:users,email,' . \Auth::user()->email,
                    'profile' => 'max:191',
                    'image_path' => 'max:191',
                ]);
                
                $request->user()->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'profile' => $request->profile,
                    'image_path' => $request->image_path,
                ]);
                
            } elseif( $request->page === 'パスワード') {
                $page = 'mymenu.password';
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
