<?php

namespace RCLAB\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class RCLABUserBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
