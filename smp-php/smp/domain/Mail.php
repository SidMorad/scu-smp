<?php
/**
 * Created at 09/08/2010 4:43:43 PM
 * smp_bean_Mail
 *
 * @author <a href="mailto:smorad12@scu.edu.au">Sid</a>
 * @version 1.0
 */
class smp_bean_Mail {
	private $recipients;
	private $from;
	private $to;
	private $subject;
	private $body;

	function __construct($recipients = null, $from = null, $to = null, $subject = null, $body = null) {
		$this->recipients = $recipients;
		$this->from = $from;
		$this->to = $to;
		$this->subject = $subject;
		$this->body = $body;
	}

	public function getRecipients() {
		return $this->recipients;
	}
	public function getFrom(){
		return $this->from;
	}
	public function getTo()	{
		return $this->to;
	}
	public function getSubject(){
		return $this->subject;
	}
	public function getBody(){
		return $this->body;
	}
	public function setRecipients($recipients){
		$this->recipients = $recipients;
	}
	public function setFrom($from){
		$this->from = $from;
	}
	public function setTo($to){
		$this->to = $to;
	}
	public function setSubject($subject){
		$this->subject = $subject;
	}
	public function setBody($body){
		$this->body = $body;
	}
}