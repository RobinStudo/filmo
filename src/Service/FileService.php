<?php

namespace App\Service;

use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class FileService {
    private array $config;

    public function __construct(ParameterBagInterface $parameterBag)
    {
        $this->config = $parameterBag->get('file');
    }

    public function upload(UploadedFile $file, string $prefix = 'file'): string
    {
        $name = uniqid($prefix . '-') . '.' . $file->guessExtension();
        $file->move($this->config['upload_directory'], $name);
        return $name;
    }
}
