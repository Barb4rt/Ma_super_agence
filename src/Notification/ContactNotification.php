<?php
namespace App\Notification;

use Twig\Environment;
use App\Entity\Contact;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\MailerInterface;

class ContactNotification{
    /**
     * @var MailerInterface
    */

    private $mailer;

    /**
     * @var Environment
     */

    private $renderer;

    public function __construct(MailerInterface $mailer, Environment $renderer)
    {
        $this->mailer = $mailer;
        $this->renderer = $renderer;
    }

    public function notify(Contact $contact){

        $message = (new TemplatedEmail())
            ->subject('Agence :' . $contact->getProperty()->getTitle())
            ->from('noreply@agence.fr')
            ->to('contact@agence.fr')
            ->replyTo($contact->getEmail())
            ->htmlTemplate('emails/contact.html.twig') 
            ->context([
                'contact' => $contact
            ]);
        $this->mailer->send($message);
    }
}