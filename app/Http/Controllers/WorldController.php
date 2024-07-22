<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\App;

use App\Contracts\ApiController;

use App\Enums\ReqStr;

class WorldController extends Controller
{
	private ?ApiController $_worldService = null;
	private ?object $_model;
	private string $_method = "";

	public function __construct(ApiController $worldService)
	{
		$this->_worldService = $worldService;
	}
	public function index(string $moveKey): string
	{
		if (!$this->_checkMoveKey($moveKey)) {
			return $this->_worldService->returnError("Invalid Access", 400);
		}
		;

		$this->_define($moveKey);

		if (!method_exists($this->_model, $this->_method)) {
			return $this->_worldService->returnError("System Error", 500);
		}

		$value = $this->_model->{$this->_method}();
		return $this->_worldService->return($value);
	}

	private function _checkMoveKey(string $reqStr): bool
	{
		return ReqStr::tryFrom($reqStr) !== null;
	}

	private function _define(string $moveKey)
	{
		$this->_model = $this->_getModel($moveKey);
		$this->_method = 'get' . ucfirst($moveKey);
	}

	private function _getModel(string $moveKey)
	{
		$modelName = ucfirst($moveKey) . 'Model';
		return App::make('App\\Models\\' . $modelName);
	}
}
