<?php

declare(strict_types=1);

namespace MDurys\GupekBundle\Controller;

use MDurys\GupekBundle\Entity\Meeting;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

class IndexController extends Controller
{
    /**
     * @return Response
     *
     * @Route("/", name="index")
     * @Method("GET")
     */
    public function indexAction(): Response
    {
        $meetings = $this->getDoctrine()
            ->getRepository(Meeting::class)
            ->getUpcoming();

        return $this->render('MDurysGupekBundle:Index:index.html.twig', [
            'meetings' => $meetings
        ]);
    }
}