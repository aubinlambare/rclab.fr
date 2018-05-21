<?php
/**
 * Created by PhpStorm.
 * User: aubin
 * Date: 01/05/18
 * Time: 21:26
 */

namespace RCLAB\WebsiteBundle\Service;


use RCLAB\WebsiteBundle\Entity\Image;

class RemoveFile
{
    public function removeFile(Image $image)
    {
        if (!$image) return false;

        unlink($image->getPath());

    }
}