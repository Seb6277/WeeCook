<?php


namespace App\Service\Interfaces;


use Symfony\Component\HttpFoundation\File\UploadedFile;

interface FileUploaderInterface
{
    public function __construct(string $targetDirectory);
    public function upload(UploadedFile $file):string;
    public function getTargetDirectory():string;
}