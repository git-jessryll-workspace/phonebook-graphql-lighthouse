<?php

namespace App\Repositories;

use App\Models\Contact;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class ContactRepository
{
    /**
     * @param array $data
     * @return Model|Builder
     */
    public function create(array $data): Model|Builder
    {
        return Contact::query()->create($data);
    }

    /**
     * @param int $id
     * @return Model|Collection|Builder|array|null
     */
    public function findOrFail(int $id): \Illuminate\Database\Eloquent\Model|Collection|\Illuminate\Database\Eloquent\Builder|array|null
    {
        return Contact::query()->findOrFail($id);
    }

    /**
     * @param Contact $contact
     * @param array $data
     * @return Contact
     */
    public function update(Contact $contact, array $data): Contact
    {
        $contact->update($data);

        return $contact;
    }

    /**
     * @param int $id
     * @return void
     */
    public function delete(int $id): void
    {
        Contact::query()->findOrFail($id)->delete();
    }

    /**
     * @return Collection|array
     */
    public function findAll(): \Illuminate\Database\Eloquent\Collection|array
    {
        return Contact::query()->get();
    }

}
