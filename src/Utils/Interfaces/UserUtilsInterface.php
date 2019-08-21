<?php
/**
 * Created with PHPStorm
 * Date: 21/8/2019
 * Time: 11:6
 * Author: S. Carpentier
 * Mail: sebastien.carpentier89@gmail.com
 */

namespace App\Utils\Interfaces;


interface UserUtilsInterface
{
    public static function checkPassword(string $password, string $passwordCheck): bool;
}