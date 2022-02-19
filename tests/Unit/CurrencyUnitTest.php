<?php

namespace Tests\Unit;

use App\Interfaces\Models\Currency\CurrencyInterface;

use App\Models\Currency\Currency;

use Tests\TestCase;

class CurrencyUnitTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testCreateCurrency()
    {
        $currnecy = Currency::factory()->make();

        $createdCurrency =Currency::createObject
            (
            $currnecy->getTitle(),
            $currnecy->getRatio(),
            $currnecy->getIsDefault(),
            $currnecy->getSymbol(),
            $currnecy->getIso3(),
        );

        $this->assertTrue($createdCurrency instanceof CurrencyInterface);
        $this->assertEquals($currnecy->getTitle(), $createdCurrency->getTitle());
        $this->assertEquals($currnecy->getRatio(), $createdCurrency->getRatio());
        $this->assertEquals($currnecy->getIsDefault(), $createdCurrency->getIsDefault());
        $this->assertEquals($currnecy->getSymbol(), $createdCurrency->getSymbol());
        $this->assertEquals($currnecy->getIso3(), $createdCurrency->getIso3());

        $this->assertDatabaseHas(
            Currency::TABLE,
            [

                Currency::TITLE => $createdCurrency->getTitle(),
                Currency::RATIO => $createdCurrency->getRatio(),
                Currency::IS_DEFAULT => $createdCurrency->getIsDefault(),
                Currency::SYMBOL => $createdCurrency->getSymbol(),
                Currency::ISO3 => $createdCurrency->getIso3(),

            ]
        );
    }

    public function updateCurrency()
    {
        $curency = Currency::factory()->create();
        $fakeCurrency = Currency::factory()->make();
        $updatedCurrency = $curency->updateObject(
            $fakeCurrency->getTitle(),
            $fakeCurrency->getRatio(),
            $fakeCurrency->getIsDefault(),
            $fakeCurrency->getSymbol(),
            $fakeCurrency->getIso3(),
        );
        $this->assertTrue($updatedCurrency instanceof CurrencyInterface);
        $this->assertEquals($fakeCurrency->getTitle(), $updatedCurrency->getTitle());
        $this->assertEquals($fakeCurrency->getRatio(), $updatedCurrency->getRatio());
        $this->assertEquals($fakeCurrency->getIsDefault(), $updatedCurrency->getIsDefault());
        $this->assertEquals($fakeCurrency->getSymbol(), $updatedCurrency->getSymbol());
        $this->assertEquals($fakeCurrency->getIso3(), $updatedCurrency->getIso3());

        $this->assertDatabaseHas(
            Currency::TABLE,
            [
                Currency::TITLE => $updatedCurrency->getTitle(),
                Currency::RATIO => $updatedCurrency->getRatio(),
                Currency::IS_DEFAULT => $updatedCurrency->getIsDefault(),
                Currency::SYMBOL => $updatedCurrency->getSymbol(),
                Currency::ISO3 => $updatedCurrency->getIso3(),

            ]
        );
    }

}
