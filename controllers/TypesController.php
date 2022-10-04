<?php
class TypesController extends JsonResponse{
	function __construct()
	{
		parent::__construct("Types");
	}
	public function actionAll()
	{
		return $this->getResponse("all", "GET");
	}
	public function actionGetSpecificAttr($type_name){
		return $this->getResponse("getSpecificAttr", "GET", $type_name);
	}
}
