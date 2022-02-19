<?php

namespace Tests\Unit;

use App\Interfaces\Models\Contacts\EmailInterface;
use App\Models\Contacts\Email;
use Tests\TestCase;

class EmailUnitTest extends TestCase
{
    /**
     * @test
     */
    public function testCreateEmail()
    {
        $email = Email::factory()->make();

        $createdEmail = Email::createObject
        (
            $email->getEmail()
        );

        $this->assertTrue($createdEmail instanceof EmailInterface);
        $this->assertEquals($email->getEmail(), $createdEmail->getEmail());

        $this->assertDatabaseHas(
            Email::TABLE,
            [
                Email::EMAIL => $createdEmail->getEmail(),
            ]
        );
    }

    /**
     * @test
     */
    public function testupdateEmail()
    {
        $email = Email::factory()->create();
        $fakeEmail = Email::factory()->make();

        $updatedEmail = $email->updateObject(
            $fakeEmail->getEmail(),
        );

        $this->assertTrue($updatedEmail instanceof EmailInterface);
        $this->assertEquals($fakeEmail->getEmail(), $updatedEmail->getEmail());

        $this->assertDatabaseHas(
            Email::TABLE,
            [
                Email::EMAIL => $updatedEmail->getEmail(),
            ]
        );
    }
}
