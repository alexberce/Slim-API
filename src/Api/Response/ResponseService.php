<?php

namespace Invobox\Api\Response;

use Invobox\Api\Resources\ResourceModelInterface;

class ResponseService
{
	/**
	 * @var
	 */
	private $statusCode = 200;
	
	/**
	 * @var array
	 */
	private $data = [];
	
	/**
	 * @var int
	 */
	private $errorCode;
	
	/**
	 * @var string
	 */
	private $errorMessage;
	
	/**
	 * @var array
	 */
	private $responseData = [];
	
	/**
	 * @var array
	 */
	private $headers = [];
	
	/**
	 * @var string
	 */
	private $message;
	
	/**
	 * @param $statusCode
	 *
	 * @return $this
	 */
	public function withStatusCode($statusCode)
	{
		$this->statusCode = $statusCode;
		
		return $this;
	}
	
	/**
	 * @param int $errorCode
	 *
	 * @return $this
	 */
	public function withErrorCode($errorCode)
	{
		$this->errorCode = $errorCode;
		
		return $this;
	}
	
	/**
	 * @param string $errorMessage
	 *
	 * @return $this
	 */
	public function withErrorMessage($errorMessage)
	{
		$this->errorMessage = $errorMessage;
		
		return $this;
	}
	
	/**
	 * @param array|ResourceModelInterface $data
	 *
	 * @return $this
	 * @throws \Exception
	 */
	public function withData($data = [])
	{
		if (!is_array($data) && !$data instanceof ResourceModelInterface) {
			throw new \Exception('Malformed response data.');
		}
		
		if ($data instanceof ResourceModelInterface) {
			$data = $data->expose();
		}
		
		$this->data = $data;
		
		return $this;
	}
	
	public function getResponse()
	{
		$this->addHeaders();
		
		$this->responseData['data']    = $this->data;
		$this->responseData['message'] = (string) $this->message;
		
		if ($this->errorCode)
			$this->responseData['error']['errorCode'] = $this->errorCode;
		
		if ($this->errorMessage)
			$this->responseData['error']['errorMessage'] = $this->errorMessage;
		
		if ($this->statusCode)
			http_response_code($this->statusCode);
		
		return json_encode($this->responseData, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
	}
	
	/**
	 * @return $this
	 */
	public function write()
	{
		echo $this->getResponse();
		
		return $this;
	}
	
	private function addHeaders()
	{
		foreach ($this->headers as $headerName => $headerValue) {
			header($headerName . ': ' . $headerValue);
		}
	}
	
	/**
	 * @param string $message
	 *
	 * @return ResponseService
	 */
	public function withMessage($message)
	{
		$this->message = (string) $message;
		
		return $this;
	}
}