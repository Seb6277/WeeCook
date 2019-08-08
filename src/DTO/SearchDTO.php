<?php
/**
 * Created with PHPStorm
 * Date: 6/8/2019
 * Time: 1:17
 * Author: S. Carpentier
 * Mail: sebastien.carpentier89@gmail.com
 */

namespace App\DTO;


class SearchDTO
{
    public $searchString;

    /**
     * @return string
     */
    public function __toString()
    {
        return (string)$this->searchString;
    }
}