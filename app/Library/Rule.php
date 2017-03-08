<?php
namespace App\Library;
/**
 * Created by PhpStorm.
 * User: humengtao
 * Date: 2017/3/6
 * Time: 21:58
 */
class Rule
{
    const Validate_Article_Rule = [
        'contents' => 'required',
        'title' => 'required|max:30'
    ];

    const Validate_Comment_Rule = [
        'comment' => 'required|max:100'
    ];

    const Validate_Collection_Rule = [
        'name' => 'required|max:20|unique:collections',
        'image' => 'required'
    ];

    const Validate_Collection_Change_Rule = [
        'image' => 'required'
    ];

    const Validate_Login_Rule = [
        'email' => 'required|email|exists:users',
        'password' => 'required|min:6'
    ];

    const Validate_Register_Rule = [
        'name' => 'required|max:10|unique:users',
        'email' => 'required|email|max:30|unique:users',
        'password' => 'required|min:6|confirmed',
    ];
}