<?php

namespace BlogBundle;

use BlogBundle\DependencyInjection\BlogExtension;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class BlogBundle extends Bundle
{
    public function getContainerExtension()
    {
        return new BlogExtension();
    }
}

