<?php
/**
 * Created by PhpStorm.
 * User: skillup_student
 * Date: 15.05.18
 * Time: 21:16
 */

namespace App\Service;


use FOS\UserBundle\Mailer\TwigSwiftMailer;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Routing\RouterInterface;

class Mailer extends TwigSwiftMailer
{
    public function __construct(\Swift_Mailer $mailer, RouterInterface $router, \Twig_Environment $twig)
    {
        parent::__construct($mailer, $router, $twig, []);
    }

    public function sendMessage($templateName, $context, $fromEmail, $toEmail)
    {
        parent::sendMessage($templateName, $context, $fromEmail, $toEmail);
    }

}