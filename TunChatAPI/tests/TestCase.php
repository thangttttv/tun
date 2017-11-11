<?php
namespace Tests;

use LaravelRocket\Foundation\Tests\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    /** @var bool */
    protected $useDatabase = false;

    /** @var string */
    public $baseUrl = 'http://localhost:8000';

    /** @var \Faker\Generator */
    protected $faker;

    public function setUp()
    {
        parent::setUp();
        if ($this->useDatabase) {
            $databaseName = \DB::connection()->getDatabaseName();
            $tables       = \DB::select('SHOW TABLES');
            $keyName      = 'Tables_in_'.$databaseName;
            foreach ($tables as $table) {
                if (property_exists($table, $keyName)) {
                    \DB::table($table->$keyName)->truncate();
                }
            }
            \DB::disableQueryLog();
            $this->artisan('db:seed');
        }
    }

    public function tearDown()
    {
        if ($this->useDatabase) {
            \DB::disconnect();
        }
        parent::tearDown();
    }
}
