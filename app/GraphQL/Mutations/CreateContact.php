<?php declare(strict_types=1);

namespace App\GraphQL\Mutations;

use App\Services\ContactService;
use Illuminate\Support\Facades\Validator;
use Nuwave\Lighthouse\Exceptions\ValidationException;

final class CreateContact
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
        $this->validate($args);
        return $this->contactService->createContact($args);
    }

    private function validate(array $args): void
    {
        $validator = Validator::make($args, [
            'name' => 'required|string|max:255',
            'contact_no' => 'required|string|max:20',
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
    }
}
