<?php

namespace App\Library\Framework;

/**
 * Class Mail
 *
 * @package App\Library\Framework
 */
class Mail
{
	/** @var array $sendTo */
	protected $sendTo = ['somebody@example.com','somebodyelse@example.com'];

	/** @var string $sendFrom */
	protected $sendFrom = 'webmaster@example.com';

	/** @var string $cc */
	protected $cc = 'webmaster@example.com';

	/** @var string $headers */
	protected $headers = '';

	/** @var string $subject */
	protected $subject = 'HTML email';

	/** @var string $body */
	protected $body = '';

	/**
	 * Mail constructor.
	 */
	public function __construct()
	{
		$this->initHeaders();
		$this->initBody();
	}

	/**
	 * initHeaders.
	 */
	public function initHeaders()
	{
		$headers  = "From: Sender Name <".$this->sendFrom.">" . "\r\n";
		$headers = 'MIME-Version: 1.0' . "\r\n";
		$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
		$headers .= 'Cc: '.$this->cc.'' . "\r\n";
		$this->headers = $headers;
	}

	/**
	 * initBody.
	 */
	public function initBody()
	{
		$this->body = "
			<html>
				<head>
					<title>HTML email</title>
				</head>
				<body>
					<p>This email contains HTML Tags!</p>
					<table>
						<tr>
							<th>First name</th>
							<th>Last name</th>
						</tr>
						<tr>
							<td>John</td>
							<td>Doe</td>
						</tr>
					</table>
				</body>
			</html>
		";
	}

	/**
	 * send.
	 *
	 * @return bool
	 */
	public function send()
	{
		$this->initHeaders();
		return mail(implode(',', $this->sendTo), $this->subject, $this->body, $this->headers);
	}

	/**
	 * getSendTo
	 *
	 * @return array
	 */
	public function getSendTo(): array
	{
		return $this->sendTo;
	}

	/**
	 * setSendTo
	 *
	 * @param array $sendTo
	 *
	 * @return Mail
	 */
	public function setSendTo(array $sendTo)
	{
		$this->sendTo = $sendTo;
		return $this;
	}

	/**
	 * getSendFrom
	 *
	 * @return string
	 */
	public function getSendFrom(): string
	{
		return $this->sendFrom;
	}

	/**
	 * setSendFrom
	 *
	 * @param string $sendFrom
	 *
	 * @return Mail
	 */
	public function setSendFrom(string $sendFrom)
	{
		$this->sendFrom = $sendFrom;
		return $this;
	}

	/**
	 * getCc
	 *
	 * @return string
	 */
	public function getCc(): string
	{
		return $this->cc;
	}

	/**
	 * setCc
	 *
	 * @param string $cc
	 *
	 * @return Mail
	 */
	public function setCc(string $cc)
	{
		$this->cc = $cc;
		return $this;
	}

	/**
	 * getHeaders
	 *
	 * @return string
	 */
	public function getHeaders(): string
	{
		return $this->headers;
	}

	/**
	 * setHeaders
	 *
	 * @param string $headers
	 *
	 * @return Mail
	 */
	public function setHeaders(string $headers)
	{
		$this->headers = $headers;
		return $this;
	}

	/**
	 * getSubject
	 *
	 * @return string
	 */
	public function getSubject(): string
	{
		return $this->subject;
	}

	/**
	 * setSubject
	 *
	 * @param string $subject
	 *
	 * @return Mail
	 */
	public function setSubject(string $subject)
	{
		$this->subject = $subject;
		return $this;
	}

	/**
	 * getBody
	 *
	 * @return string
	 */
	public function getBody(): string
	{
		return $this->body;
	}

	/**
	 * setBody
	 *
	 * @param string $body
	 *
	 * @return Mail
	 */
	public function setBody(string $body)
	{
		$this->body = $body;
		return $this;
	}
}