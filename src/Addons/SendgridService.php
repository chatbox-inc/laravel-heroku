<?php
namespace Chatbox\Heroku\Addons;

use \SendGrid\Email;
use \Sendgrid;
use Psr\Log\LoggerInterface;

/**
 * Sendgridクラスのラッパー
 *
 * 依存の集約: 簡便のためEmailの依存は外に出す。
 * FROMの自動セット
 * 送信エラー時のログ
 * テキストメッセージの自動生成
 */
class SendgridService
{

    public function getEmail($subject,$htmlBody):Email{
        $email = new Email();
        $textBody = strip_tags($htmlBody);
        $email
            ->setFrom(env("SENDGRID_FROM"))
            ->setSubject($subject)
            ->setText($textBody)
            ->setHtml($htmlBody);
        return $email;
    }

    public function sendEmail(Email $email){
        $apiKeys = env("SENDGRID_APIKEY");
        if(is_null($apiKeys)){
            throw new SendgridServiceException;
        }
        if(!$email->getFrom()){
            throw new SendgridServiceException;
        }
        $sendgrid = new \SendGrid($apiKeys);
        try{
            $sendgrid->send($email);
        }catch (\Exception $e){
            var_dump($e->getMessage());
            throw new SendgridServiceException();
        }
    }

    public function send(array $toes,$subject,$htmlBody){

        $email = $this->getEmail($subject,$htmlBody);
        foreach ($toes as $to) {
            if (!filter_var($to, FILTER_VALIDATE_EMAIL)) {
                throw new SendgridServiceException;
            }
        }
        $email->setTos($toes);
        $this->sendEmail($email);
    }
}

class SendgridServiceException extends \Exception{}