<?php

namespace Tests\Http\Api;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\AbstractTestCase;

abstract class AbstractApiTestCase extends AbstractTestCase
{
    use DatabaseMigrations;
}
