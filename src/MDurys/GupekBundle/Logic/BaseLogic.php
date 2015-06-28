<?php

namespace MDurys\GupekBundle\Logic;

use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

abstract class BaseLogic
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

    /**
     * @return \Doctrine\ORM\EntityRepository
     */
    public function getRepository($name)
    {
        return $this->getEntityManager()->getRepository('MDurysGupekBundle:'.$name);
    }

    /**
     * @return \Symfony\Component\Form\FormFactory
     */
    public function getFormFactory()
    {
        return $this->container->get('form.factory');
    }

    /**
     * Generates a URL from the given parameters.
     *
     * @param string         $route         The name of the route
     * @param mixed          $parameters    An array of parameters
     * @param Boolean|string $referenceType The type of reference (one of the constants in UrlGeneratorInterface)
     *
     * @return string The generated URL
     *
     * @see UrlGeneratorInterface
     */
    public function generateUrl($route, $parameters = array(), $referenceType = UrlGeneratorInterface::ABSOLUTE_PATH)
    {
        return $this->container->get('router')->generate($route, $parameters, $referenceType);
    }
}
