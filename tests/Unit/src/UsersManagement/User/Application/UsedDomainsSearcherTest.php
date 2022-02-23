<?php

namespace Tests\Unit\src\UsersManagement\User\Application;

use App\Models\User as EloquentUser;
use App\Models\UserEmailAlias as EloquentUserEmailAlias;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Src\UsersManagement\User\Application\UsedDomainsSearcher;
use Src\UsersManagement\User\Infrastructure\Repositories\EloquentUserRepository;

class UsedDomainsSearcherTest extends TestCase
{

    use DatabaseMigrations;


    public function test_domains_searcher_returns_correct_data()
    {
        EloquentUser::factory()->create()->emails()->createMany([
            ["email" => "email@gmail.com"],
            ["email" => "email@hotmail.com"],
            ["email" => "email2@gmail.com"]
        ]);
        EloquentUser::factory()->create()->emails()->createMany([
            ["email" => "test@hotmail.com"],
            ["email" => "test@hotmail.es"],
            ["email" => "test2@gmail.com"],
            ["email" => "test@example.es"]
        ]);
        EloquentUser::factory()->hasEmails(1, ["email" => "example@gmail.com"])->create();

        $userRepository = new EloquentUserRepository(new EloquentUser(), new EloquentUserEmailAlias());

        $domainSearcher = new UsedDomainsSearcher($userRepository);
        $response = $domainSearcher->execute(null);

        $expected = [
            "gmail.com" => 4,
            "hotmail.com" => 2,
            "hotmail.es" => 1,
            "example.es" => 1
        ];

        $this->assertEquals($expected, $response);
    }


    public function test_domains_searcher_returns_correct_data_when_max_given()
    {
        EloquentUser::factory()->create()->emails()->createMany([
            ["email" => "email@gmail.com"],
            ["email" => "email@hotmail.com"],
            ["email" => "email2@gmail.com"]
        ]);
        EloquentUser::factory()->create()->emails()->createMany([
            ["email" => "test@hotmail.com"],
            ["email" => "test@hotmail.es"],
            ["email" => "test2@gmail.com"],
            ["email" => "test@example.es"]
        ]);
        EloquentUser::factory()->hasEmails(1, ["email" => "example@gmail.com"])->create();

        $userRepository = new EloquentUserRepository(new EloquentUser(), new EloquentUserEmailAlias());

        $domainSearcher = new UsedDomainsSearcher($userRepository);
        $response = $domainSearcher->execute(2);

        $expected = [
            "gmail.com" => 4,
            "hotmail.com" => 2,
        ];

        $this->assertEquals($expected, $response);
    }
}
