<?php
/**
 * Created with PHPStorm
 * Date: 6/8/2019
 * Time: 1:17
 * Author: S. Carpentier
 * Mail: sebastien.carpentier89@gmail.com
 */

namespace App\DTO;


use App\DTO\Interfaces\SearchDTOInterface;

class SearchDTO implements SearchDTOInterface
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