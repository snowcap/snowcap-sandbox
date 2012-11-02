<?php

namespace Snowcap\AdminDemoBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class SnowcapAdminDemoBundle extends Bundle
{
    /**
     * @return string
     */
    public function getParent()
    {
        return 'SnowcapAdminBundle';
    }
}
