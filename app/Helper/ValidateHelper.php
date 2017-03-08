<?php
/**
 * Created by PhpStorm.
 * User: humengtao
 * Date: 2017/3/6
 * Time: 21:25
 */

namespace App\Helper;


use App\Library\Message;
use App\Library\Rule;
use Illuminate\Support\Facades\Redirect;
use Validator;

class ValidateHelper
{
    public static function customValidate(array $content, $type)
    {

        $rules = null;

        $messages = null;

        switch ($type) {
            case 'Comment':
                $rules = Rule::Validate_Comment_Rule;
                $messages = Message::Validate_Comment_Message;
                break;
            case 'Article':
                $rules = Rule::Validate_Article_Rule;
                $messages = Message::Validate_Article_Message;
                break;
            case 'Collection':
                $rules = Rule::Validate_Collection_Rule;
                $messages = Message::Validate_Collection_Message;
                break;
            case 'Collection_Change':
                $rules = Rule::Validate_Collection_Change_Rule;
                $messages = Message::Validate_Collection_Change_Message;
                break;
            case 'Login':
                $rules = Rule::Validate_Login_Rule;
                $messages = Message::Validate_Collection_Change_Message;
                break;
            case 'Register':
                $rules = Rule::Validate_Register_Rule;
                $messages = Message::Validate_Register_Message;
                break;

            default:
                break;
        }
        return Validator::make($content, $rules, $messages);
    }

    public static function redirect($validate, $input = '')
    {
        return Redirect::back()
            ->withErrors($validate)
            ->withInput($input);
    }
}