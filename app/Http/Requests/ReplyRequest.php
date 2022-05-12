<?php

namespace App\Http\Requests;

class ReplyRequest extends Request
{
    public function rules()
    {
        //回复至少有两个字符
         return [
            'content' => 'required|min:2',
        ];
        switch($this->method())
        {
            // CREATE
            case 'POST':
            {
                return [
                    // CREATE ROLES
                ];
            }
            // UPDATE
            case 'PUT':
            case 'PATCH':
            {
                return [
                    // UPDATE ROLES
                ];
            }
            case 'GET':
            case 'DELETE':
            default:
            {
                return [];
            }
        }
    }

    public function messages()
    {
        return [
            'content.required' => '内容不能为空',
            'content.min' => '内容必须至少两个字符',
        ];
    }
}
