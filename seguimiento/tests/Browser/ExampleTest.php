<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ExampleTest extends DuskTestCase
{
    /**
     * A basic browser test example.
     *
     * @return void
     */
    public function testBasicExample()
    {
        $this->browse(function (Browser $browser) {
            $browser->visitRoute('login')
                ->assertSee("Sistema de seguimiento de alumnos")
                ->assertSee("E-Mail")
                ->assertSee("Contraseña")
                ->assertSee("Recordarme")
                ->assertSee("Ingresar")
                ->assertSee("¿Olvidó su contraseña?");
        });
    }
}
