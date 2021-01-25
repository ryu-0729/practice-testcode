<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class TaskNewTest extends DuskTestCase
{
    /**
     * New Task Page Test
     *
     * @return void
     */
    public function testShowNew()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/sample-test/public/tasks/new')
                ->assertSee('New Task');
        });
    }

    /**
     * New Task Page Test (Empty Title)
     *
     * @return void
     */
    public function testShowNewEmptyTitle_failed()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/sample-test/public/tasks/new')
                ->press('登録')
                ->pause(1000)
                ->assertPathIs('/sample-test/public/tasks/new')
                ->assertSee('The title field is required.')
                ->screenshot('task_show_new_empty_title');
        });
    }
}
