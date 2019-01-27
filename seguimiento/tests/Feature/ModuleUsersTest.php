<?php

namespace Tests\Feature;

use App\Models\Docente;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ModuleUsersTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_try_refuse_user()
    {
        $this->generateUserAndLogin();

        $randomDocente = factory(Docente::class)->create();

        factory(User::class)->create([
            'docente_id' => $randomDocente->id,
            'status' => 0
        ]);

        $this->delete("users/{$randomDocente->id}")
            ->assertRedirect('/docentes');
    }

    /** @test */
    public function it_try_activate_user()
    {
        $this->generateUserAndLogin();

        $randomDocente = factory(Docente::class)->create();

        factory(User::class)->create([
            'docente_id' => $randomDocente->id,
            'status' => 1
        ]);

        $this->put("users/{$randomDocente->id}")
            ->assertRedirect('/docentes');
    }




}
