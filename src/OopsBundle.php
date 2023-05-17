<?php


namespace VTGianni\OopsBundle;


use Symfony\Component\HttpKernel\Bundle\Bundle;
use VTGianni\OopsBundle\DependencyInjection\OopsExtension;
use Symfony\Component\DependencyInjection\Extension\ExtensionInterface;

class OopsBundle extends Bundle
{
    public function getContainerExtension(): ?ExtensionInterface
    {
        if (null === $this->extension) {
            $this->extension = new OopsExtension();
        }

        return $this->extension;
    }
}