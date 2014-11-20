<?php

namespace MDurys\GupekBundle\Logic;

use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class BaseLogic
{
    /**
     * @var ContainerInterface
     */
    protected $container;

    /**
     * {@inheritDoc}
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function getEntityManager()
    {
        return $this->container->get('doctrine')->getManager();
    }

    public function getRepository($name)
    {
        return $this->getEntityManager()->getRepository('MDurysGupekBundle:'.$name);
    }
}
