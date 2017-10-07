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
        /** @var \MDurys\GupekBundle\Entity\MeetingRepository $meetingRepository */
        $meetingRepository = $this->getDoctrine()
            ->getRepository(Meeting::class);
        $meetings = $meetingRepository->getUpcoming();
        $recentMeetings = $meetingRepository->getRecent();

        return $this->render('MDurysGupekBundle:Index:index.html.twig', [
            'meetings' => $meetings,
            'recentMeetings' => $recentMeetings,
        ]);
    }
}