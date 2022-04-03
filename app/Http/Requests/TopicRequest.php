<?php

namespace App\Http\Requests;

class TopicRequest extends Request
{
    public function rules()
    {
        switch($this->method())
        {
            // 创建帖子规则
            case 'POST':
            {
                return [
                    'title'       => 'required|min:2',
                    'body'        => 'required|min:3',
                    'category_id' => 'required|numeric',
                ];
            }
            // UPDATE
            case 'PUT':
                
                //更新帖子规则
            case 'PATCH':
            {
                return [
                    'title'       => 'required|min:2',
                    'body'        => 'required|min:3',
                    'category_id' => 'required|numeric',
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


    //对应rules的翻译
    public function messages()
    {
        return [
            'title.min'=>'主题最少两个字符',
            'body.min'=>'内容最少三个字符'
            
            // Validation messages
        ];
    }
}
