<?php
/**
 * PHP Email Form Library
 * A simple form handler class for sending emails via PHP mail() or SMTP
 */

class PHP_Email_Form {
  public $to;
  public $from_name;
  public $from_email;
  public $subject;
  public $ajax = false;
  public $smtp = false;
  private $messages = [];

  public function add_message($content, $label = '', $length = 0) {
    if ($length > 0 && strlen($content) < $length) {
      return;
    }

    $message = $label ? "<strong>$label:</strong> $content<br>" : "$content<br>";
    $this->messages[] = $message;
  }

  public function send() {
    $headers = "MIME-Version: 1.0\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8\r\n";
    $headers .= "From: {$this->from_name} <{$this->from_email}>\r\n";
    $headers .= "Reply-To: {$this->from_email}\r\n";

    $message_body = implode("", $this->messages);

    if ($this->smtp) {
      return $this->send_via_smtp($message_body);
    } else {
      return mail($this->to, $this->subject, $message_body, $headers) ? 'OK' : 'Could not send mail!';
    }
  }

  private function send_via_smtp($message_body) {
    // OPTIONAL: Implement SMTP if needed using PHPMailer or similar library
    return 'SMTP not configured';
  }
}
