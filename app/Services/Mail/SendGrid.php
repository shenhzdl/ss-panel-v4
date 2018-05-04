<?php

namespace App\Services\Mail;

use App\Contracts\Codes\Cfg;
use SendGrid as SendGridService;

class SendGrid extends Base implements Cfg
{
    private $config,$mg, $sender;

    /**
     * @codeCoverageIgnore
     */
    public function __construct()
    {
        $this->config = $this->getConfig();
        $this->mg = new SendGridService($this->config['key']);
        $this->sender = $this->config['sender'];
    }

    public function getConfig()
    {
        return [
            'key' => db_config(self::MailgunKey),
            'sender' => db_config(self::MailgunSender),
        ];
    }

    /**
     * @param $to
     * @param $subject
     * @param $template
     * @param $params
     * @param null $file
     * @codeCoverageIgnore
     */
    public function send($to, $subject, $template, $params, $file = null)
    {
        $from = new SendGridService\Email("",$this->sender);
        $to = new SendGridService\Email("",$to);
        $content = new SendGridService\Content("text/html", $this->genHtml($template,$params));
        $mail = new SendGridService\Mail($from, $subject, $to, $content);
        $response = $this->mg->client->mail()->send()->post($mail);
    }
}