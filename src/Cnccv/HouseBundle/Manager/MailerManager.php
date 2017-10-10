<?php

namespace MC\ProduitsEnSartheBundle\Manager;

use Symfony\Component\Templating\EngineInterface;

class MailerManager
{
    protected $mailer;
    protected $templating;

    public function __construct(\Swift_Mailer $mailer, EngineInterface $templating)
    {
        $this->mailer = $mailer;
        $this->templating = $templating;
    }

    /**
     * Send message.
     * @param string $from sender of the message.
     * @param string $to  email of the message.
     * @param string $subject object of the message.
     * @param string $bodyHTML template of the message HTML.
     * @param string $bodyTXT template of the message TXT.
     * @param string $name sender name of the message.
     * @param array $params optional. Field form to the template of the e-mail.
     */
    public function sendMessage($from, $to, $subject, $bodyHTML, $bodyTXT, $name, $params=array())
    {
        $mail = \Swift_Message::newInstance();
        $mail
            ->setFrom($from, $name)
            ->setTo($to)
            ->setSubject($subject)
            ->setBody($this->templating->render($bodyHTML, array('params' => $params)), 'text/html')
            ->addPart($this->templating->render($bodyTXT, array('params' => $params)), 'text/plain')
        ;

        $this->mailer->send($mail);
    }

    /**
     * Send message by copy.
     * @param string $from sender of the message.
     * @param string $to  email of the message.
     * @param string $subject object of the message.
     * @param string $bodyHTML $template of the message HTM.
     * @param string $bodyTXT $template of the messageTXT.
     * @param string $name sender name of the message.
     * @param string $cc notification by email.
     * @param array $params optional. Field form to the template of the e-mail.
     */
    public function sendMessageByCopy($from, $to, $subject, $bodyHTML, $bodyTXT, $name, $cc, $params=array())
    {
        $mail = \Swift_Message::newInstance();
        $mail
            ->setFrom($from, $name)
            ->setTo($to)
            ->setCc(array($cc => $name))
            ->setSubject($subject)
            ->setBody($this->templating->render($bodyHTML, array('params' => $params)), 'text/html')
            ->addPart($this->templating->render($bodyTXT, array('params' => $params)), 'text/plain')
        ;

        $this->mailer->send($mail);
    }

}