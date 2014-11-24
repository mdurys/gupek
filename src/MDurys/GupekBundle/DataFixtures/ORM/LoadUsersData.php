<?php

namespace MDurys\GupekBundle\DataFixtures\ORM;

use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use MDurys\GupekBundle\Entity\User;

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
            'md' => ['michal@migmail.pl', 'Player MD'],
            'rj' => ['rafal@migmail.pl', 'Player RJ'],
            'jg' => ['janek@migmail.pl', 'Player JG'],
            'tk' => ['tomek@migmail.pl', 'Player TK'],
            'jb' => ['jarek@migmail.pl', 'Player JB'],
            'kc' => ['krzysiek@migmail.pl', 'Player KC'],
            'eg' => ['eryk@migmail.pl', 'Player EG'],
            'ml' => ['marek@migmail.pl', 'Player ML'],
            'mk' => ['maciek@migmail.pl', 'Player MK'],
            'ab' => ['adam@migmail.pl', 'Player AB'],
            'sh' => ['szymon@migmail.pl', 'Player SH'],
            'tp' => ['tomekp@migmail.pl', 'Player TP'],
            'jd' => ['jakub@migmail.pl', 'Player JD'],
            'al' => ['andrzej@migmail.pl', 'Player AL'],
            'mn' => ['maciekn@migmail.pl', 'Player MN'],
            'md2' => ['maciekd@migmail.pl', 'Player MD2'],
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
