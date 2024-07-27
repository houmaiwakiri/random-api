<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\App;

use App\Contracts\ApiController;

use App\Enums\ReqWorldStr;

class WorldController extends Controller
{
	private ?ApiController $_worldService = null;
	private ?object $_model;
	private string $_method = "";

	public function __construct(ApiController $worldService)
	{
		$this->_worldService = $worldService;
	}

	/**
	 * $moveKeyで呼び出すモデルを選択
	 * @param string $moveKey
	 * @param string $option
	 * @return string
	 */
	public function index(string $moveKey, string $option = ''): string
	{
		if (!$this->_checkMoveKey($moveKey)) {
			return $this->_worldService->returnError("Invalid Access", 403);
		}
		;

		//モデルとメソッド定義
		$this->_define($moveKey);

		if (is_null($this->_model)) {
			return $this->_worldService->returnError("System Error", 500);
		}

		if (!method_exists($this->_model, $this->_method)) {
			return $this->_worldService->returnError("System Error", 500);
		}

		$value = $this->_model->{$this->_method}();
		return $this->_worldService->return($value);
	}

	/**
	 * MoveKeyの定義存在チェック
	 * @param string $reqStr
	 * @return bool
	 */
	private function _checkMoveKey(string $reqStr): bool
	{
		return ReqWorldStr::tryFrom($reqStr) !== null;
	}

	/**
	 * モデル、メソッドの名前を定義
	 * @param string $moveKey
	 * @return void
	 */
	private function _define(string $moveKey): void
	{
		$this->_model = $this->_getModel($moveKey);
		$this->_method = 'get' . ucfirst($moveKey);
	}

	/**
	 * インスタンス化成功：モデルのオブジェクト
	 * インスタンス化失敗：null
	 * @param string $moveKey
	 * @return object|null
	 */

	private function _getModel(string $moveKey): ?object
	{
		$modelName = ucfirst($moveKey) . 'Model';
		try {
			return App::make('App\\Models\\' . $modelName);
		} catch (\Exception) {
			return null;
		}
	}
}
