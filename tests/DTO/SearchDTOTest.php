<?php
/**
 * Created with PHPStorm
 * Date: 23/8/2019
 * Time: 10:14
 * Author: S. Carpentier
 * Mail: sebastien.carpentier89@gmail.com
 */

namespace App\Tests\DTO;


use App\DTO\SearchDTO;
use PHPUnit\Framework\TestCase;

class SearchDTOTest extends TestCase
{
    public function testToString()
    {
        $searchDTO = new SearchDTO();
        $searchDTO->searchString = "test";
        $this->assertEquals((string)$searchDTO, 'test');
    }
}