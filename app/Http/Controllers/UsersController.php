<?php

namespace App\Http\Controllers;
use Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\UserRequest;
class UsersController extends Controller
{
    //展示用户界面
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }
    //展示用户编辑界面
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }
    
    
    
        public function update(UserRequest $request,User $user)
        {
            $user->update($request->all());
            return redirect()->route('users.show',Auth::user())->with('success','用户信息更新成功');
        }
        
        
    
}
