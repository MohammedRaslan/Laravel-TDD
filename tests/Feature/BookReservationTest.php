<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Book;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BookReservationTest extends TestCase
{
    use RefreshDatabase;
   /** @test */
   public function a_book_can_be_added_to_the_library()
   {
       $this->withoutExceptionHandling();
       $response = $this->post('/books',[
           'title' => 'Cool Book',
           'author' => 'Mohamed Raslan'
       ]);
       $response->assertOk();
       $this->assertCount(1, Book::all());
   }
}
