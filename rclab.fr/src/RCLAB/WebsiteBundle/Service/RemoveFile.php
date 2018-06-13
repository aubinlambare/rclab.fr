<?php
/**
 * Created by PhpStorm.
 * User: aubin
 * Date: 01/05/18
 * Time: 21:26
 */

namespace RCLAB\WebsiteBundle\Service;


class RemoveFile
{
    private $root_path;

    public function __construct($root_path)
    {
        $this->root_path = $root_path;
    }

    public function removeFile($filename)
    {
        $file_path = $this->root_path .'/web/uploads/images/' . $filename;

        if($filename != 'default.jpg' && is_file($file_path)) {

            unlink($file_path);
        }

        return $file_path;
    }
}