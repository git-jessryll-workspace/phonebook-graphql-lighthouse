<?php

namespace App\Repositories;

use App\Models\Contact;

class ContactRepository
{
    /**
     * @param array{} $data
     * @return Contact
     */
    public function create(array $data): Contact
    {
        return Contact::query()->create($data);
    }

    public function findOrFail(int $id): Contact
    {
        return Contact::findOrFail($id);
    }

    public function update(Contact $contact, array $data): Contact
    {
        $contact->update($data);

        return $contact;
    }

    public function delete(int $id): void
    {
        Contact::findOrFail($id)->delete();
    }

}
