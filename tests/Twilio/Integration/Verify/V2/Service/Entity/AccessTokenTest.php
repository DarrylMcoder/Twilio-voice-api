<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */

namespace Twilio\Tests\Integration\Verify\V2\Service\Entity;

use Twilio\Exceptions\DeserializeException;
use Twilio\Exceptions\TwilioException;
use Twilio\Http\Response;
use Twilio\Tests\HolodeckTestCase;
use Twilio\Tests\Request;

class AccessTokenTest extends HolodeckTestCase {
    public function testCreateRequest(): void {
        $this->holodeck->mock(new Response(500, ''));

        try {
            $this->twilio->verify->v2->services("VAXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")
                                     ->entities("identity")
                                     ->accessTokens->create("push");
        } catch (DeserializeException $e) {}
          catch (TwilioException $e) {}

        $values = ['FactorType' => "push", ];

        $this->assertRequest(new Request(
            'post',
            'https://verify.twilio.com/v2/Services/VAXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX/Entities/identity/AccessTokens',
            null,
            $values
        ));
    }

    public function testCreateResponse(): void {
        $this->holodeck->mock(new Response(
            201,
            '
            {
                "token": "ACaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa"
            }
            '
        ));

        $actual = $this->twilio->verify->v2->services("VAXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")
                                           ->entities("identity")
                                           ->accessTokens->create("push");

        $this->assertNotNull($actual);
    }
}