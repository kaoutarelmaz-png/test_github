<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Stagiaire;

class StagiaireCrudTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_stagiaire()
    {
        /* $this->post(...) : Laravel simule une requête HTTP POST
        route('stagiaire.store') : récupère l’URL de la route nommée */
        $response = $this->post(route('comments.store'), [
            'name' => 'test1',
            'email' => '3@gmail.com',
            'messager' => 'test',
        ]);
        /*302 = redirection.Dans un CRUD Laravel, après store, on fait souvent return redirect(...)*/
        $response->assertStatus(302); // souvent redirect après store
        /*vérifie si vraiment l'objet a été créé*/
        $this->assertDatabaseHas('commants', [
            'name' => 'test1',
            'email' => '3@gmail.com',
            'messager' => 'test',
        ]);
    }

 /*  public function test_update_stagiaire()
    {
        $stagiaire = Stagiaire::factory()->create([
            'nom' => 'Ancien',
            'prenom' => 'Ancien',
            'adresse' => 'Rabat'
        ]);

        $response = $this->put(route('stagiaire.update', $stagiaire), [
            'nom' => 'Nouveau',
            'prenom' => 'Nouveau',
            'datenaissance' => $stagiaire->datenaissance,
            'adresse' => 'Tanger',
        ]);

        $response->assertStatus(302);
        $this->assertDatabaseHas('stagiaires', [
            'id' => $stagiaire->id,
            'nom' => 'Nouveau',
            'prenom' => 'Nouveau',
            'adresse' => 'Tanger',
        ]);
    }

    public function test_delete_stagiaire()
    {
        $stagiaire = Stagiaire::factory()->create();

        $response = $this->delete(route('stagiaire.destroy', $stagiaire));

        $response->assertStatus(302);
        $this->assertDatabaseMissing('stagiaires', [
            'id' => $stagiaire->id,
        ]);
    }
      */
}
