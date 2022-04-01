<?php

namespace App\Http\Controllers;
use Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\UserRequest;
use App\Handlers\ImageUploadHandler; //自定义的处理图片的文件
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
    
    
    
        public function update(UserRequest $request,ImageUploadHandler $uploader, User $user)
        {
            $data=$request->all();
            if ($request->avatar) {
            $result = $uploader->save($request->avatar, 'avatars', $user->id,416);      //save是ImageUploadHandler的函数，它返回一个路径
           
            if ($result) {
                $data['avatar'] = $result['path'];
            }
        }
     
        $user->update($data);
            return redirect()->route('users.show',Auth::user())->with('success','用户信息更新成功');
        }
        
        
    
}
