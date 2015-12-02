<?php

/**
 * Custom Yii Framework extension for forwarding email (aka Mailer)
 * @package Mailer
 */
class Mailer {

  public $URL = "";

  public $System = "";

  public $Subject = "";

  public function init(){}

  public function SetFrom() {

  }

  public function AddAddress($address) {
    $this->To = $address;
  }

  public function MsgHTML($body) {
    $this->Body = $body;
  }

  public function Send() {
    if (strlen($this->System) > 0) {
      $this->Subject = '[' . $this->System . '] ' . $this->Subject;
    }

    $data = array('to' => $this->To, 'subject' => $this->Subject, 'message' => $this->Body);

    // use key 'http' even if you send the request to https://...
    $options = array(
        'http' => array(
            'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
            'method'  => 'POST',
            'content' => http_build_query($data),
        ),
    );
    $context  = stream_context_create($options);
    $this->ErrorInfo = "";
    return file_get_contents($this->URL, false, $context);
  }

}

?>
