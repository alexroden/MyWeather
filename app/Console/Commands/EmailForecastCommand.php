<?php

namespace App\Console\Commands;

use App\Mail\SendForecastEmail;
use App\Services\Contracts\Forecast;
use App\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class EmailForecastCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'myweather:email-forecast';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Email weekly forecast to subscribers.';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        User::all()->each(function ($user) {
            $forecast = app(Forecast::class)
                ->getWeeks($user->city);

            Mail::to($user->email)
                ->queue(new SendForecastEmail($user, $forecast));
        });
    }
}
