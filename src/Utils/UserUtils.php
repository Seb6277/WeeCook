<?php
/**
 * Created with PHPStorm
 * Date: 21/8/2019
 * Time: 11:2
 * Author: S. Carpentier
 * Mail: sebastien.carpentier89@gmail.com
 */

namespace App\Utils;


use App\Utils\Interfaces\UserUtilsInterface;

class UserUtils implements UserUtilsInterface
{
    public static function checkPassword(string $password, string $passwordCheck): bool
    {
        if ($password === $passwordCheck)
        {
            return true;
        } else {
            return false;
        }
    }
}