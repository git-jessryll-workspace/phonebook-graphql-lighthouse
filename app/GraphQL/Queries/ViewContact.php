<?php declare(strict_types=1);

namespace App\GraphQL\Queries;

use App\Models\Contact;

final class ViewContact
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $contact = Contact::findOrFail($args['id']);
        return $contact;
    }
}
