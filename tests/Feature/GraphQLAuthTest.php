<?php

namespace Tests\Feature;

use App\Models\Contact;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GraphQLAuthTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        // Create and authenticate a user for testing
        $this->actingAs(User::factory()->create());
    }

    public function testAuthenticatedViewContact()
    {
        // Create a contact for testing
        $contact = Contact::factory()->create();

        // Send a GraphQL request to view a contact
        $response = $this->graphQL('
            query {
                viewContact(id: ' . $contact->id . ') {
                    id
                    name
                    contact_no
                }
            }
        ');

        // Assert the response
        $response->assertJson([
            'data' => [
                'viewContact' => [
                    'id' => (string) $contact->id,
                    'name' => $contact->name,
                    'contact_no' => $contact->contact_no,
                ],
            ],
        ]);
    }

    public function testAuthenticatedCreateContact()
    {

        // Send a GraphQL request to create a contact
        $response = $this->graphQL('
            mutation {
                createContact(name: "John Doe214", contact_no: "123-456-7890") {
                    id
                    name
                    contact_no
                }
            }
        ');
        // Extract the actual created ID from the response
        $createdContactId = $response->json('data.createContact.id');

        $response->assertJson([
            'data' => [
                'createContact' => [
                    'id' => $createdContactId, // Assuming this is the ID of the newly created contact
                    'name' => 'John Doe214',
                    'contact_no' => '123-456-7890',
                ],
            ],
        ]);
    }

    public function testDeleteContact()
    {
        // Create a contact to delete
        $contact = Contact::factory()->create();

        // Send a GraphQL request to delete the contact
        $response = $this->graphQL('
            mutation {
                deleteContact(id: ' . $contact->id . ')
            }
        ');

        // Assert the response
        $response->assertJson([
            'data' => [
                'deleteContact' => $contact->id,
            ],
        ]);

        // Ensure the contact was deleted from the database
        $this->assertDatabaseMissing('contacts', ['id' => $contact->id]);
    }

    public function testListContacts()
    {
        // Create some contacts for testing
        $contacts = Contact::factory()->count(5)->create();

        // Send a GraphQL request to list contacts
        $response = $this->graphQL('
            query {
                listContacts {
                    id
                    name
                    contact_no
                }
            }
        ');

        // Assert the response
        $response->assertJson([
            'data' => [
                'listContacts' => $contacts->map(function ($contact) {
                    return [
                        'id' => (string) $contact->id,
                        'name' => $contact->name,
                        'contact_no' => $contact->contact_no,
                    ];
                })->toArray(),
            ],
        ]);
    }
}
