<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class US08_PermissoesTest extends USTestBase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->seedNormalUsers();
        $this->seedDesativadoUser();
        $this->seedEmailNaoVerificadoUser();
        $this->seedSoftDeletedUser();
    }

    public function testProtecaoSociosParaAnonimo()
    {
        $this->get('/socios')
                ->assertUnauthorized('GET', '/socios',
                'Utilizadores anónimos pode ver a lista de sócios!');
    }

    public function testProtecaoSociosParaUserComEmailNaoVerificado()
    {
        $this->actingAs($this->emailNaoVerificadoUser)->get('/socios')
                ->assertUnauthorized('GET', '/socios',
                'Utilizador sem o e-mail verificado pode ver a lista de sócios!');
    }

    public function testProtecaoSociosParaSocioDesativado()
    {
        $this->actingAs($this->desativadoUser)->get('/socios')
                ->assertUnauthorized('GET', '/socios',
                'Utilizador desativado (ativo=0) pode ver a lista de sócios!');
    }

    public function testProtecaoSociosParaSocioSoftdeleted()
    {
        $this->actingAs($this->softDeletedUser)->get('/socios')
                 ->assertNotStatus(200, 'Utilizador apagado (com SoftDeleted) tem acesso à lista de sócios!');
    }
}
    
