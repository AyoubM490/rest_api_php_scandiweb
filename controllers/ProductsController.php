<?php
class ProductsController extends JsonResponse{
	function __construct()
	{
		parent::__construct("Product");
	}
	public function actionAll()
	{
		return $this->getResponse("all", "GET");
	}
	public function actionStore()
	{
		return $this->getResponse("store", "POST");
	}
	public function actionDelete()
	{
		return $this->getResponse("delete", "DELETE");
	}
}
