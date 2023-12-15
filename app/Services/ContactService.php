<?php

namespace App\Services;

use App\Models\Contact;
use App\Repositories\ContactRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class ContactService
{
    public function __construct(private readonly ContactRepository $contactRepository)
    {
    }

    /**
     * @param array $data
     * @return Model|Builder
     */
    public function createContact(array $data): \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Builder
    {
        return $this->contactRepository->create($data);
    }

    /**
     * @param $id
     * @param array $data
     * @return Contact
     */
    public function updateContact($id, array $data): \App\Models\Contact
    {
        $contact = $this->contactRepository->findOrFail($id);

        return $this->contactRepository->update($contact, $data);
    }

    /**
     * @param $id
     * @return void
     */
    public function deleteContact($id): void
    {
        $this->contactRepository->delete($id);
    }

    /**
     * @param $id
     * @return Model|Collection|Builder|array|null
     */
    public function getContact($id): Model|\Illuminate\Database\Eloquent\Collection|Builder|array|null
    {
        return $this->contactRepository->findOrFail($id);
    }

    /**
     * @return Collection|array
     */
    public function getContactList(): \Illuminate\Database\Eloquent\Collection|array
    {
        return $this->contactRepository->findAll();
    }
}
