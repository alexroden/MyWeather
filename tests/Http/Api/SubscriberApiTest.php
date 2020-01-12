<?php

namespace Tests\Http\Api;

use App\User;
use Illuminate\Http\Response;
use Spatie\Snapshots\MatchesSnapshots;

class SubscriberApiTest extends AbstractApiTestCase
{
    use MatchesSnapshots;

    public function testSubscribe()
    {
        $response = $this->post('api/subscribe', [
            'city'       => 'Foo',
            'email'      => 'foo@bar.com',
            'first_name' => 'Foo',
            'last_name'  => 'Bar',
            'password'   => 'F00B4R',
        ]);

        $response->assertOk();
        $this->assertMatchesJsonSnapshot($response->getContent());
    }

    public function testLogin()
    {
        $subscriber = factory(User::class)->create([
            'city'       => 'Foo',
            'email'      => 'foo@bar.com',
            'first_name' => 'Foo',
            'last_name'  => 'Bar',
            'password'   => 'F00B4R',
        ]);

        $response = $this->post('api/login', [
            'email'      => $subscriber->email,
            'password'   => 'F00B4R',
        ]);

        $response->assertOk();
        $this->assertMatchesJsonSnapshot($response->getContent());
    }

    public function testLoginFailedAttempt()
    {
        $response = $this->post('api/login', [
            'email'      => 'test@test.com',
            'password'   => 'F00B4R',
        ]);

        $response->assertStatus(Response::HTTP_NOT_FOUND);
    }

    public function testSetDefaultLocation()
    {
        $subscriber = factory(User::class)->create([
            'city'       => 'Foo',
            'email'      => 'foo@bar.com',
            'first_name' => 'Foo',
            'last_name'  => 'Bar',
            'password'   => 'F00B4R',
        ]);

        $response = $this->put("api/{$subscriber->id}/location", [
            'city' => 'Manchester',
        ]);

        $response->assertOk();
        $this->assertMatchesJsonSnapshot($response->getContent());
    }
}
