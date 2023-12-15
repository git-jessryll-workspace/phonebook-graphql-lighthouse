<?php declare(strict_types=1);

namespace App\GraphQL\Queries;

use App\Services\ContactService;

final class ListContacts
{
    public function __construct(private readonly ContactService $contactService)
    {
    }

    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        return $this->contactService->getContactList();
    }
}
