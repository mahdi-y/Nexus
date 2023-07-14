<?php

namespace App\Controller;

use App\Entity\Utilisateur;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mailer\Mailer;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mime\Address;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Output\ConsoleOutput;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\HttpClient\HttpClient;









use Symfony\Component\Mailer\Transport\Smtp\EsmtpTransport;

class MailerService
{
    private $mailer;
    private $urlGenerator;

    public function __construct(MailerInterface $mailer, UrlGeneratorInterface $urlGenerator)
    {
        $this->mailer = $mailer;
        $this->urlGenerator = $urlGenerator;
    }

    public function sendConfirmationEmail($recipientEmail, $nomU)
    {

        /* $command = "ipconfig /all | findstr /I 10.1.14 | Select -First 1";
        exec($command, $output);

        $outputString = implode(PHP_EOL, $output); // Convert array to string

        $command2 = $outputString . "\" -split ': ' | Select -Last 1";
        exec($command2, $out);
        $outputString1 = implode(PHP_EOL, $out); // Convert array to string*/
        // Create the Gmail SMTP transport
        $transport = new EsmtpTransport('smtp.gmail.com', 587);
        $transport->setUsername('youssef.azzouz@esprit.tn');
        $transport->setPassword('ncolrbbujrynyerw'); // Replace with your app-specific password

        // Create the mailer instance
        $mailer = new Mailer($transport);

        $baseURL = 'http://10.1.143.10:8000';
        //$baseURL = $out;
        $confirmationLink = $baseURL . $this->urlGenerator->generate('confirm_email', ['email' => $recipientEmail], UrlGeneratorInterface::ABSOLUTE_PATH);



        // Create the email
        $sender = new Address('youssef.azzouz@esprit.tn', 'Nexus');
        $email = (new Email())
            ->addFrom($sender)
            ->to($recipientEmail)
            ->subject('Confirmation Email')
            ->text('Dear ' . $nomU . ', thank you for registering. Please confirm your email.' . $confirmationLink);

        // Send the email
        $mailer->send($email);

        // Return a response or perform other actions
        return new Response('Confirmation email sent!');
    }
    public function sendReset($recipientEmail)
    {


        /* $command = "ipconfig /all | findstr /I 10.1.14 | Select -First 1";
        exec($command, $output);

        $outputString = implode(PHP_EOL, $output); // Convert array to string

        $command2 = $outputString . "\" -split ': ' | Select -Last 1";
        exec($command2, $out);
        $outputString1 = implode(PHP_EOL, $out); // Convert array to string*/

        // $jsonString = implode('', $output); // Convert array to a single string
        //$lol = json_decode($jsonString, true); // Decode the JSON string into an array
        //$console->writeln($lol);
        //foreach ($output as $item) {
        //}
        // Create the Gmail SMTP transport
        $transport = new EsmtpTransport('smtp.gmail.com', 587);
        $transport->setUsername('youssef.azzouz@esprit.tn');
        $transport->setPassword('ncolrbbujrynyerw'); // Replace with your app-specific password

        // Create the mailer instance
        $mailer = new Mailer($transport);

        $baseURL = 'http://10.1.143.10:8000';
        // $baseURL = $out;
        $confirmationLink = $baseURL . $this->urlGenerator->generate('user.edit.password1', ['email' => $recipientEmail], UrlGeneratorInterface::ABSOLUTE_PATH);



        // Create the email
        $sender = new Address('youssef.azzouz@esprit.tn', 'Nexus');
        $email = (new Email())
            ->addFrom($sender)
            ->to($recipientEmail)
            ->subject('Confirmation Email')
            ->text('Click this link to select your new password ' . $confirmationLink);

        // Send the email
        $mailer->send($email);

        // Return a response or perform other actions
        return new Response('Confirmation email sent!');
    }
}
