<?php

namespace Tests\Unit;

use App\Interfaces\Models\Contacts\PhoneModelInterface;
use App\Models\Contacts\Phone;
use Tests\TestCase;

class PhoneUnitTest extends TestCase
{
    /**
     * @test
     */
    public function testCreatePhone()
    {
        $phone = Phone::factory()->create();

        $createdPhone = Phone::createObject
        (
            $phone->getType(),
            $phone->getNumber(),
        );

        $this->assertTrue($createdPhone instanceof PhoneModelInterface);
        $this->assertEquals($phone->getType(), $createdPhone->getType());
        $this->assertEquals($phone->getNumber(), $createdPhone->getNumber());

        $this->assertDatabaseHas(
            Phone::TABLE,
            [
                Phone::TYPE => $createdPhone->getType(),
                Phone::NUMBER => $createdPhone->getNumber()
            ]
        );
    }

    /**
     * @test
     */
    public function testupdatePhone()
    {
        $phone = Phone::factory()->create();
        $fakePhone = Phone::factory()->make();

        $updatedPhone = $phone->updateObject(
            $fakePhone->getType(),
            $fakePhone->getNumber()
        );

        $this->assertTrue($updatedPhone instanceof PhoneModelInterface);
        $this->assertEquals($fakePhone->getType(), $updatedPhone->getType());
        $this->assertEquals($fakePhone->getNumber(), $updatedPhone->getNumber());

        $this->assertDatabaseHas(
            Phone::TABLE,
            [
                Phone::TYPE => $updatedPhone->getType(),
                Phone::NUMBER => $updatedPhone->getNumber()
            ]
        );
    }
}
