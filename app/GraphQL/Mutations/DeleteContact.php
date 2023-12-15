<?php declare(strict_types=1);

namespace App\GraphQL\Mutations;

use App\Models\Contact;
use App\Services\ContactService;

final class DeleteContact
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
        $this->contactService->deleteContact($args['id']);
        return $args['id'];
    }
}
