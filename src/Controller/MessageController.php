<?php

namespace App\Controller;

use App\Entity\Conversation;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;


/**
 * @Security("is_granted('ROLE_USER')")
 * @Route("/message", name="message")
 */
class MessageController extends AbstractController
{
    /**
     * @Route("/", name="_home")
     */
    public function index()
    {
        if ($this->isGranted('ROLE_ADMIN')) $conversations = $this->getDoctrine()->getRepository(Conversation::class)->findAll();
        else $conversations = $this->getDoctrine()->getRepository(Conversation::class)->findBy([
            'user' => $this->getUser()
        ]);
        return $this->render('message/index.html.twig', [
            'conversations' => $conversations
        ]);
    }

    /**
     * @Route("/{id}", name="_conversation")
     */
    public function conversation($id) {

    }
}
