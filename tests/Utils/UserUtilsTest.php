<?php
/**
 * Created with PHPStorm
 * Date: 23/8/2019
 * Time: 10:35
 * Author: S. Carpentier
 * Mail: sebastien.carpentier89@gmail.com
 */

namespace App\Tests\Utils;


use App\Utils\UserUtils;
use PHPUnit\Framework\TestCase;

class UserUtilsTest extends TestCase
{
    public function testCheckPasswordSuccessfull()
    {
        $this->assertEquals(true, UserUtils::checkPassword('test', 'test'));
    }

    public function testFailedPasswordCheck()
    {
        $this->assertEquals(false, UserUtils::checkPassword('test', 'wrong'));
    }
}