<?php

namespace App\Http\Controllers\Api;

use App\Http\Exceptions\InvalidUserCredentialsException;
use App\Http\Requests\ForecastRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\SubscriberRequest;
use App\Http\Resources\SubscriberResource;
use App\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class SubscriberController extends Controller
{
    /**
     * @param \App\Http\Requests\LoginRequest $request
     *
     * @return \App\Http\Resources\SubscriberResource
     */
    public function login(LoginRequest $request): SubscriberResource
    {
        return new SubscriberResource(
            $this->attemptLogin(
                $request->only(['email', 'password'])
            )
        );
    }

    /**
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function logout()
    {
        Auth::logout();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    /**
     * @param \App\User                          $user
     * @param \App\Http\Requests\ForecastRequest $request
     *
     * @return \App\Http\Resources\SubscriberResource
     */
    public function setDefaultLocation(User $user, ForecastRequest $request): SubscriberResource
    {
        $user->update(['city' => $request->get('city')]);

        return new SubscriberResource($user->fresh());
    }

    /**
     * @param \App\Http\Requests\SubscriberRequest $request
     *
     * @return \App\Http\Resources\SubscriberResource
     */
    public function subscribe(SubscriberRequest $request): SubscriberResource
    {
        try {
            User::create(
                $request->only([
                    'city',
                    'email',
                    'first_name',
                    'last_name',
                    'password',
                ])
            );
        } catch (QueryException $e) {
            throw $e;
        }

        return new SubscriberResource(
            $this->attemptLogin(
                $request->only(['email', 'password'])
            )
        );
    }

    /**
     * @param array $credentials
     *
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    protected function attemptLogin(array $credentials = [])
    {
        if (!Auth::attempt($credentials, true)) {
            throw new InvalidUserCredentialsException();
        }

        return Auth::user();
    }
}
