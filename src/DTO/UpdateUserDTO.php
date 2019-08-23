<?php
/**
 * Created with PHPStorm
 * Date: 20/8/2019
 * Time: 4:51
 * Author: S. Carpentier
 * Mail: sebastien.carpentier89@gmail.com
 */

namespace App\DTO;


use App\DTO\Interfaces\UpdateUserDTOInterface;

/**
 * Class UpdateUserDTO
 * @package App\DTO
 */
class UpdateUserDTO implements UpdateUserDTOInterface
{
    public $email;
    public $password;
    public $retypePassword;
}