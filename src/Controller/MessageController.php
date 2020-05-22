<?php

namespace App\Controller;

use App\Entity\Conversation;
use App\Entity\Message;
use App\Form\MessageType;
use DateTimeImmutable;
use Psr\Log\LoggerInterface;
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
    public function conversation($id, ?Request $request, LoggerInterface $logger): Response {
        $conversation = $this->getDoctrine()->getRepository(Conversation::class)->find($id);
        $message = new Message();
        $form = $this->createForm(MessageType::class, $message);
        $logger->debug("", ['isset_request'=>isset($request)]);
        if (isset($request)) $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $logger->debug("Form Submitted & Valid");
            $message->setConversationId($conversation);
            $logger->debug("Conversation ID", ['conversationid' => $message->getConversationId()]);
            $message->setCreator($this->getUser());
            $logger->debug("Creator", ['creator' => $message->getCreator()->__toString()]);
            $message->setTimestamp(new DateTimeImmutable());
            $logger->debug("Timestamp", ['ts' => $message->getTimestamp()->format('F jS \\a\\t g:ia')]);
            $logger->debug("Message", ['msg' => $message->getMessage()]);
            $em = $this->getDoctrine()->getManager();
            $em->persist($message);
            $em->flush();
        }
        return $this->render('message/conversation.html.twig', [
            'conversation' => $conversation,
            'form' => $form->createView()
        ]);
    }
}
