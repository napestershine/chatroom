<?php

namespace Tests\Browser;

use App\User;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ExampleTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * A basic browser test example.
     *
     * @return void
     */
    public function testBasicExample()
    {
        $user1 = factory(User::class)->create([
            'name' => 'Manoj'
        ]);

        $user2 = factory(User::class)->create([
            'name' => 'Kri'
        ]);

        $this->browse(function ($first, $second) use ($user1, $user2) {
            $first->loginAs($user1)
                ->visit('/chat')
                ->waitFor('.chat-composer');

            $second->loginAs($user2)
                ->visit('/chat')
                ->waitFor('.chat-composer')
                ->type('#message', 'Hey Manoj')
                ->press('Send');

            $first->waitForText('Hey Manoj')
                ->assertSee('Hey Manoj');
        });

    }
}
