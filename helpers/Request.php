<?php
abstract class Request{
	protected $requestMethod;
	protected $conn;
	function __construct()
	{
		$this->conn = DB::getConnection();
		$this->requestMethod = $_SERVER['REQUEST_METHOD'];
	}

	protected function msg($data, $customCode=false)
	{
		if ($customCode) 
		{
			http_response_code(intval($customCode));
			return array ("ok"=>false,"msg"=>$data);
		}
		else 
		{
			http_response_code(200);
			return array("ok"=>true,"data"=>$data);
		}
	}
}
?>