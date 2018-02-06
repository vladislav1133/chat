<?php
/**
 * Created by PhpStorm.
 * User: vladislav
 * Date: 06.02.18
 * Time: 17:54
 */

namespace App\Services;
use Carbon\Carbon;

class ChatRuleValidator
{

    private $errors;

    public function __construct()
    {
        $this->errors = [];
    }


    public  function validate($user,$message) {

        $this->checkFirstMessage($user,$message);
        $this->checkSpamming($user);

        return $this->errors;
    }

    public function checkFirstMessage($user,$message) {

        if (!$user->messages()->count() && strlen($message) > 200)
            $this->errors[] =  'The first message may not be greater than 200 characters.';

    }

    public  function checkSpamming($user) {

        $time = Carbon::now();

        $time->second = $time->second-15;

        if ($user->messages()->where('created_at', '>=', $time)->get()->count()) {
            $this->errors[] = 'NO SPAM! One message for 15 second.';
        }
    }
}




