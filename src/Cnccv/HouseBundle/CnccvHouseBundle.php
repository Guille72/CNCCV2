<?php

namespace Cnccv\HouseBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class CnccvHouseBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
