<?php

namespace Messere\Cart\Domain\Product\Product;

use Messere\Cart\Domain\CartProduct\Product\CartProduct;
use Messere\Cart\Domain\Price\PriceBuilder;
use Messere\Cart\Domain\Price\PriceValidationException;
use Ramsey\Uuid\UuidInterface;

class CartProductBuilder
{
    private $priceBuilder;

    public function __construct(PriceBuilder $priceBuilder)
    {
        $this->priceBuilder = $priceBuilder;
    }

    /**
     * @param UuidInterface $id
     * @param string $name
     * @param int $priceAmount
     * @param int $priceDivisor
     * @param string $currencySymbol
     * @param int $amount
     * @return CartProduct
     * @throws PriceValidationException
     */
    public function build(
        UuidInterface $id,
        string $name,
        int $priceAmount,
        int $priceDivisor,
        string $currencySymbol,
        int $amount
    ): CartProduct {

        $price = $this->priceBuilder->buildPrice($priceAmount, $priceDivisor, $currencySymbol);
        return new CartProduct($id, $name, $price, $amount);
    }
}
