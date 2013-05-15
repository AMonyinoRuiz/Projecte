<?php

namespace vitaworke3\UsuarisBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class UsuarisBundle extends Bundle
{

    public function getParent()
    {
		return 'FOSUserBundle';
    }
}
