<?php

namespace App\Services;

use App\Traits\ConsumesExternalService;

class AuthorService
{
    use ConsumesExternalService;

    /**
     * @var string
     */
    public $baseUri;

    /**
     * @var string
     */
    public $secret;

    public function __construct()
    {
        $this->baseUri = config('services.authors.base_uri');
        $this->secret = config('services.authors.secret');
    }

    public function obtaintAuthors()
    {
        return $this->performRequest('GET', '/authors');
    }

    public function createAuthor($data)
    {
        return $this->performRequest('POST', '/authors', $data);
    }

    public function obtainAuthor($authorId)
    {
        return $this->performRequest('GET', "/authors/{$authorId}");
    }

    public function updateAuthor($authorId, $data)
    {
        return $this->performRequest('PUT', "/authors/{$authorId}", $data);
    }

    public function deleteAuthor($authorId)
    {
        return $this->performRequest('DELETE', "/authors/{$authorId}");
    }
}
