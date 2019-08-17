<?php
/**
 * Created with PHPStorm
 * Date: 17/8/2019
 * Time: 10:27
 * Author: S. Carpentier
 * Mail: sebastien.carpentier89@gmail.com
 */

namespace App\DTO;


class ModerationDTO
{
    public $validate;

    public function __construct()
    {
        $this->validate = false;
    }

    /**
     * @return bool
     */
    public function getValidate(): bool
    {
        dump($this->validate);
        return $this->validate;
    }
}