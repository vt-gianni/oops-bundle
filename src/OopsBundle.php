<?php


namespace VTGianni\OopsBundle;


use Symfony\Component\HttpKernel\Bundle\Bundle;
use VTGianni\OopsBundle\DependencyInjection\OopsExtension;

class OopsBundle extends Bundle
{
    public function getContainerExtension()
    {
        if (null === $this->extension) {
            $this->extension = new OopsExtension();
        }

        return $this->extension;
    }
}