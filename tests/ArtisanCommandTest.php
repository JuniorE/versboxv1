<?php

    namespace JuniorE\Versbox\Tests;


    use PHPUnit\Framework\TestCase;

    class ArtisanCommandTest extends TestCase
    {
        /** @test */
        public function test_versbox_clear_artisan_command()
        {
            $this->artisan('versbox:clear')
                ->expectsOutput('You just wiped all the records away!')
                ->expectsOutput('Database table Versbox successfully truncated!')
                ->assertExitCode(0);
        }
    }
