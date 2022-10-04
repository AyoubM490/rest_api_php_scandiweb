<?php
abstract class JsonResponse extends Request{
	protected $class;
	function __construct($class)
	{
		parent::__construct();
		$this->class = new $class();
	}
	protected function getResponse($classMethod, $method, $param=false)
	{
		if ($this->requestMethod===$method) 
		{
			if ($param) $response = $this->class->$classMethod($param);
			else $response = $this->class->$classMethod();
		}
		else $response = $this->msg("Method is not allowed", 405);
		echo json_encode($response, JSON_UNESCAPED_UNICODE);
		return true;
	}
}
?>