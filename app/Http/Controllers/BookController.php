<?php

namespace App\Http\Controllers;

use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Services\BookService;
use App\Services\AuthorService;

class BookController extends Controller
{
  use ApiResponser;
  public $bookService;

  /**
     * The service to consume the author service
     * @var AuthorService
     */
  public $authorService;

  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct(BookService $bookService, AuthorService $authorService)
  {
      //
      $this->bookService = $bookService;
      $this->authorService = $authorService;
  }

  //
  /**
   * Return books list
   * @return Illuminate\Http\Response
   */

  public function index()
  {
    return $this->successResponse($this->bookService->obtainBooks());
  }
  /**
    * Create an instance of Author
    * @return Illuminate\Http\Response
    */

  public function store(Request $request)
  {
    $this->authorService->obtainAuthor($request->author_id);
    return $this->successResponse($this->bookService->createBook($request->all()), Response::HTTP_CREATED);
  }
  /**
    * Return an specific author
    * @return Illuminate\Http\Response
    */

  public function show($book)
  {
    return $this->successResponse($this->bookService->obtainBook($book));
  }
  /**
    * Update the information of an existing author
    * @return Illuminate\Http\Response
    */

  public function update(Request $request, $book)
  {
    return $this->successResponse($this->bookService->editBook($request->all(), $book));
  }
  /**
    * Removes an existing author
    * @return Illuminate\Http\Response
    */

  public function destroy($book)
  {
    return $this->successResponse($this->bookService->deleteBook($book));
  }
}
