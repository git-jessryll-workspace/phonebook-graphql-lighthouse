<?php

namespace App\Services;

use App\Repositories\ContactRepository;

class ContactService
{
    public function __construct(private readonly ContactRepository $contactRepository)
    {
    }

    public function createContact(array $data)
    {
        return $this->contactRepository->create($data);
    }

    public function updateContact($id, array $data)
    {
        $contact = $this->contactRepository->findOrFail($id);

        return $this->contactRepository->update($contact, $data);
    }

    public function deleteContact($id): void
    {
        $this->contactRepository->delete($id);
    }
}
