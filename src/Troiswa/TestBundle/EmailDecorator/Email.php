<?php

namespace Troiswa\TestBundle\EmailDecorator;

/**
 * Class Email
 * Email Class Service
 * @package Cinhetic\PublicBundle\Email
 */
class Email {

    /**
     * @var EngineInterface
     * Template service
     */
    protected $templating;

    /**
     * @var Mailer Service
     * Mailer service
     */
    protected $mailer;


    /**
     *  Constructor of dependencies
     * @param EngineInterface $templating
     * @param $mailer
     */
    public function __construct(EngineInterface $templating, $mailer) {
        $this->templating = $templating;
        $this->mailer = $mailer;
    }


    /**
     *  Send E-Mail
     * @param null $user
     * @param null $templating
     * @param string $subject
     * @param null $to
     * @param null $key
     * @param array $datas
     * @param string $contentType
     * @param string $base_url
     * @param null $sender
     * @param int $level
     * @return bool
     */
    public function send($templating, $to, $datas = array(), $subject = "Email de Troiswa")
    {

        $message = \Swift_Message::newInstance()
            ->setSubject($subject)
            ->setTo($to)
            ->setFrom($sender)
            ->setContentType('text/html')
            ->setBody($this->templating->render($templating, array(
                'datas' => $this->datas,
            )));

        $this->mailer->send($message);
        return true;
    }

}

?>