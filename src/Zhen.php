<?php

namespace ZhenTest\Zhen;

use app\themes\actions\CartAction;
use app\themes\services\ShopThemeService;

class Zhen
{
    /**
     * 获取折扣页商品列表信息
     *
     * @return array[]
     * @throws \JsonException
     */
    public static function getCartList(): array
    {
        $cartConfig = ShopThemeService::getPageConfigs(CartAction::PAGE);
        $cartPageConfig = [];
        if ($cartConfig) {
            $cartPageConfig = json_decode($cartConfig, true, 512,
                JSON_THROW_ON_ERROR);
        }
        $cartPageConfig = ShopThemeService::getStructConfig($cartPageConfig, CartAction::PAGE);

        return [
            "settings" => [
                "enable_note" => $cartPageConfig["settings"]["enable_note"] ?? false,
                "enable_discount_code" => $cartPageConfig["settings"]["enable_discount_code"] ?? false
            ],
        ];
    }
}