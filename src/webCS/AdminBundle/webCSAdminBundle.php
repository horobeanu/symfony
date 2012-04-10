<?php

namespace webCS\AdminBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class webCSAdminBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
