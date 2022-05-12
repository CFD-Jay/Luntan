<?php

namespace App\Http\Requests;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Auth;
class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
     
     //验证规则
    public function rules()
    {
       return [
            'name' => 'required|between:2,25|regex:/^[A-Za-z0-9\-\_]+$/|unique:users,name,' . Auth::id(),//名字在users表是独一无二的，（除了自己）.
            'email' => 'required|email',
            'introduction' => 'max:80',
            'avatar'=>'mimes:jpg,png,jpeg,gif|dimensions:min_weight=208,min_height=208',
        ];
    }
    
    //自定义翻译
    public function messages()
    {
        return [
            'name.unique' => '用户名已被占用，请重新填写',
            'name.regex' => '用户名只支持英文、数字、横杠和下划线。',
            'name.between' => '用户名必须介于 3 - 25 个字符之间。',
            'name.required' => '用户名不能为空。',
            'avatar.mimes' =>'头像必须是 png, jpg, gif, jpeg 格式的图片',
            'avatar.dimensions' => '图片的清晰度不够，宽和高需要 208px 以上',
        ];
    }
}
