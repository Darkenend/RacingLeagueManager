<?php

namespace App\Controller;

use App\Entity\Conversation;
use App\Entity\Message;
use App\Form\MessageType;
use DateTimeImmutable;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
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
    public function conversation($id, ?Request $request): Response {
        $conversation = $this->getDoctrine()->getRepository(Conversation::class)->find($id);
        $message = new Message();
        $form = $this->createForm(MessageType::class, $message);
        if (isset($request)) $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $message->setConversationId($conversation);
            $message->setCreator($this->getUser());
            $message->setTimestamp(new DateTimeImmutable());
            $em = $this->getDoctrine()->getManager();
            $em->persist($message);
            $em->flush();
        }
        return $this->render('message/conversation.html.twig', [
            'conversation' => $conversation,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Security("is_granted('ROLE_ADMIN')")
     * @Route("/create", name="_create")
     */
    public function createConversation(?Request $request): Response {
        $conversation = new Conversation();
        $form = $this->createForm(Conversation::class, $conversation);
        if (isset($request)) $form->handleRequest();
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($conversation);
            $em->flush();
            $conv_id = $conversation->getId();
            return $this->redirectToRoute('message_conversation', ['id' => $conv_id]);
        }
        return $this->render('message/create.html.twig', [
            'form'=>$form->createView()
        ]);
    }
}
