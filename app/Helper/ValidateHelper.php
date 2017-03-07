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
use Validator;

class ValidateHelper
{
    public static function customValidate($content,$type){

        $rules=null;

        $messages=null;

        switch ($type){
            case 'Comment':
                $rules = Rule::Validate_Comment_Rule;
                $messages = Message::Validate_Comment_Message;
                break;
            case 'Article':
                $rules = Rule::Validate_Article_Rule;
                $messages = Message::Validate_Article_Message;
                break;
            default:
                break;
        }
        return Validator::make($content, $rules, $messages);
    }
}