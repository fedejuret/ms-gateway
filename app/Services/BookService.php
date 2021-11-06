<?php


namespace App\Services;

use App\Traits\ConsumesExternalService;

class BookService
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
        $this->baseUri = config('services.books.base_uri');
        $this->secret = config('services.books.secret');
    }

    public function obtaintBooks()
    {
        return $this->performRequest('GET', '/books');
    }

    public function createBook($data)
    {
        return $this->performRequest('POST', '/books', $data);
    }

    public function obtainBook($bookId)
    {
        return $this->performRequest('GET', "/books/{$bookId}");
    }

    public function updateBook($bookId, $data)
    {
        return $this->performRequest('PUT', "/books/{$bookId}", $data);
    }

    public function deleteBook($bookId)
    {
        return $this->performRequest('DELETE', "/books/{$bookId}");
    }
}
