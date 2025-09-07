<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Author;

class AuthorController extends Controller
{
    // GET /api/authors -> Получить список авторов
    public function index()
    {
        $authors = Author::all();
        return response()->json($authors);
    }
}
