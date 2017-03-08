<?php
namespace App\Library;
/**
 * Created by PhpStorm.
 * User: humengtao
 * Date: 2017/3/6
 * Time: 21:59
 */
class Message
{
    const Validate_Article_Message = ['contents.required' => '请填写内容', 'title.required' => '请填写标题', 'title.max' => '标题最多30个字符'];
    const Validate_Comment_Message = ['comment.max' => 'you can most input 100 characters', 'comment.required' => 'comment must be required'];
    const Validate_Collection_Message = ['name.required' => 'name is required', 'name.max' => 'name is max 20 characters', 'name.unique' => 'collection name has been added before !', 'image.required' => 'image must be required'];
    const Validate_Collection_Change_Message = ['images.required' => 'Image must be required'];
}