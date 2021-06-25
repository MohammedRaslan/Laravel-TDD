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
       $response = $this->post('/books',[
           'title' => 'Cool Book',
           'author' => 'Mohamed Raslan'
       ]);
       $response->assertOk();
       $this->assertCount(1, Book::all());
   }

   /** @test */
   public function a_title_is_required()
   {
        $response = $this->post('/books',[
            'title' => '',
            'author' => 'Mohamed Raslan'
        ]);

        $response->assertSessionHasErrors('title');
   }

     /** @test */
     public function a_author_is_required()
     {
          $response = $this->post('/books',[
              'title' => 'Mohamed Raslan',
              'author' => ''
          ]);
  
          $response->assertSessionHasErrors('author');
     }

     /** @test */
     public function a_book_can_be_updated()
     {
        $this->withoutExceptionHandling();
        $this->post('/books',[
            'title' => 'Cool Book',
            'author' => 'Mohamed Raslan'
        ]);

        $book = Book::first();
        $response = $this->patch('/books/' . $book->id,[
            'title' => 'New Title',
            'author' => 'New Author',
        ]);

        $this->assertEquals('New Title',Book::first()->title);
        $this->assertEquals('New Author',Book::first()->author);
     }
     /** @test */
     public function a_book_can_be_deleted()
     {
        $this->withoutExceptionHandling();
        $this->post('/books',[
            'title' => 'Cool Book',
            'author' => 'Mohamed Raslan'
        ]);
        $this->assertCount(1, Book::all());

        $book = Book::first();
        $response = $this->delete('/books/' . $book->id);
        $this->assertCount(0, Book::all());
        $response->assertRedirect('/books');
     }
}
