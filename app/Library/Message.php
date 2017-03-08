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
    const Validate_Article_Message = [
        'contents.required' => '请填写内容',
        'title.required' => '请填写标题',
        'title.max' => '标题最多30个字符'];

    const Validate_Comment_Message = [
        'comment.max' => 'you can most input 100 characters',
        'comment.required' => 'comment must be required'
    ];

    const Validate_Collection_Message = [
        'name.required' => 'name is required',
        'name.max' => 'name is max 20 characters',
        'name.unique' => 'collection name has been added before !',
        'image.required' => 'image must be required'
    ];

    const Validate_Collection_Change_Message = [
        'images.required' => 'Image must be required'
    ];

    const Validate_Login_Message = [
        'email.required' => '请填写邮箱',
        'email.email' => '邮箱格式不正确',
        'email.exists' => '邮箱未注册',
        'password.required' => '请填写密码',
        'password.min' => '密码至少为6位'
    ];

    const Validate_Register_Message = [
        'name.required' => '用户名为必填项',
        'name.max' => '用户名最多为10位',
        'name.unique' => '该用户名已被注册',
        'email.required' => '邮箱为必填项',
        'email.email' => '邮箱无效',
        'email.unique' => '邮箱已被注册',
        'password.required' => '密码为必填项',
        'password.min' => '密码至少为6位',
        'password.confirmed' => '两次输入的密码不相同',
    ];
}