<?php
namespace App\Enums;

/**
 * リクエスト許可を定義する Enum です。
 * 現在、サポートされているキーは 'city' と 'country' です。
 * @package App\Enums
 */
enum ReqStr: string
{
  case City = 'city';
  case Country = 'country';
}