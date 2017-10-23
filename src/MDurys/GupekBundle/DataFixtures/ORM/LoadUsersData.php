<?php

namespace MDurys\GupekBundle\DataFixtures\ORM;

use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadUsersData extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
{
    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * {@inheritDoc}
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $em)
    {
        $data = [
            'michald' => ['michal@durys.pl', 'Michał D.'],
            'rafalj' => ['rafal@migmail.pl', 'Rafał J.'],
            'janekg' => ['janek@migmail.pl', 'Janek G.'],
            'tomekk' => ['tomek@migmail.pl', 'Tomek K.'],
            'jarekb' => ['jarek@migmail.pl', 'Jarek B.'],
            'krzysiekc' => ['krzysiek@migmail.pl', 'Krzysiek C.'],
            'erykg' => ['eryk@migmail.pl', 'Eryk G.'],
            'marekl' => ['marek@migmail.pl', 'Marek L.'],
            'maciekk' => ['maciek@migmail.pl', 'Maciek K.'],
            'adamb' => ['adam@migmail.pl', 'Adam B.'],
            'szymonh' => ['szymon@migmail.pl', 'Szymon H.'],
            'tomekp' => ['tomekp@migmail.pl', 'Tomek P.'],
            'jakubd' => ['jakub@migmail.pl', 'Jakub D.'],
            'andrzejl' => ['andrzej@migmail.pl', 'Andrzej L.'],
            'macieknk' => ['maciekn@migmail.pl', 'Maciek N-K.'],
            'maciekd' => ['maciekd@migmail.pl', 'Maciek D.'],
            'jacekd' => ['jacek@migmail.pl', 'Jacek D.'],
            'travis' => ['travis@migmail.pl', 'Travis'],
        ];

        $userManager = $this->container->get('fos_user.user_manager');

        foreach ($data as $id => $row) {
            $user = $userManager->createUser();
            $user
                ->setEmail($row[0])
                ->setUsername($row[1])
                ->setPlainPassword('qwe123')
                ->setEnabled(true);
            $userManager->updateUser($user, false);
            $this->addReference('user-'.$id, $user);
        }
        $em->flush();
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 1;
    }
}
