<?php
/**
 * Created with PHPStorm
 * Date: 17/8/2019
 * Time: 10:27
 * Author: S. Carpentier
 * Mail: sebastien.carpentier89@gmail.com
 */

namespace App\DTO;

use App\DTO\Interfaces\ModerationDTOInterface;

/**
 * Class ModerationDTO
 * @package App\DTO
 */
class ModerationDTO implements ModerationDTOInterface
{
    public $validate;
}