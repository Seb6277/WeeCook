<?php
/**
 * Created with PHPStorm
 * Date: 31/7/2019
 * Time: 11:2
 * Author: S. Carpentier
 * Mail: sebastien.carpentier89@gmail.com
 */

namespace App\Service\Interfaces;


use Symfony\Component\HttpFoundation\File\UploadedFile;

interface FileUploaderInterface
{
    public function __construct(string $targetDirectory);
    public function upload(UploadedFile $file):string;
    public function getTargetDirectory():string;
}