<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{

    public function store()
    {
        Book::create([
            'title' => request('title'),
            'author' => request('author')
        ]);
    }
}
