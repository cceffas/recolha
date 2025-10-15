<?php

namespace App\kit;

enum FileProps: string
{
    case NAME = 'name';
    case FULL_PATH = "";
    case TYPE = "";
    case TMP_NAME = "";
    case ERROR = "";
    case SIZE = "";
}

class FileManeger
{

    private string $name;
    private string $type;
    private string $full_path;
    private string $error;
    private float $size;
    private string $tmp_name;
    private string $extension;
    private array  $file;


    public function __construct(array $file)
    {

        if (!empty($file)) {

            $this->file = $file;
            $this->name = hash('sha256', $file['tmp_name']);
            $this->size = number_format($file['size'] / (1024 * 1024));
            $this->tmp_name = $file['tmp_name'];
            $this->extension=self::getExtension();

        } else {

            die('is not a file array');
        }
    }

    public function getExtension(): string
    {

        $array = explode('.', $this->file['name']);
        $extension = $array[sizeof($array) - 1];
        return $extension;
    }
    public function getName():string{

        return $this->name.".".$this->extension;
    }

    public function save($path,$accepts=[]):bool
    {
       $resp= move_uploaded_file($this->tmp_name, $path . $this->name .".". $this->extension);
       return $resp;
    }
}
