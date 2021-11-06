<?php

namespace App\Http\Controllers;

use App\Services\AuthorService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AuthorController extends Controller
{

    /**
     * The Service to consume author service
     * @var AuthorService
     */
    public $authorService;

    public function __construct(AuthorService $authorService)
    {
        $this->authorService = $authorService;
    }

    /**
     * Retrieve and show all authors
     * @return Illuminate\Http\Response
     */
    public function index()
    {
        return $this->successResponse($this->authorService->obtaintAuthors());
    }

    /**
     * Create an instance of author
     * @return Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $this->successResponse($this->authorService->createAuthor($request->all()), Response::HTTP_CREATED);
    }

    /**
     * Show author data
     * @return Illuminate\Http\Response
     */
    public function show($authorId)
    {
        return $this->successResponse($this->authorService->obtainAuthor($authorId));
    }

    /**
     * Update author data
     * @return Illuminate\Http\Response
     */
    public function update(Request $request, $authorId)
    {
        return $this->successResponse($this->authorService->updateAuthor($authorId, $request->all()));
    }

    /**
     * Destroy author data
     * @return Illuminate\Http\Response
     */
    public function destroy($authorId)
    {
        return $this->successResponse($this->authorService->deleteAuthor($authorId));
    }
}
