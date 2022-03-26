<?php

namespace Tests\Feature;

use App\Models\Book;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BookReservationTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_a_book_can_be_added_to_the_library()
    {
        $response = $this->post('/book', [
            'title' => 'Cool Book Title',
            'author' => 'Imtiaze'
        ]);


        // $response->assertOk();

        $book = Book::first();
        $this->assertCount(1, Book::all());

        $response->assertRedirect('/book/' . $book->id);
    }

    public function test_a_title_is_required()
    {
        $response = $this->post('/book', [
            'title' => '',
            'author' => 'Imtiaze'
        ]);

        $response->assertSessionHasErrors('title');

    }

    /** @test */
    public function a_author_is_required()
    {
        $response = $this->post('/book', [
            'title' => 'Cool title',
            'author' => ''
        ]);

        $response->assertSessionHasErrors('author');
    }

    /** @test */
    public function a_book_can_be_updated()
    {
        // $this->withoutExceptionHandling();

        $this->post('/book', [
            'title' => 'Cool Title',
            'author' => 'Imtiaze'
        ]);

        $book = Book::first();
        $response = $this->patch('/book/' . $book->id, [
            'title' => 'New Title',
            'author' => 'New Author'
        ]);

        $this->assertEquals('New Title', Book::first()->title);
        $this->assertEquals('New Author', Book::first()->author);

        $response->assertRedirect('/book/' . $book->fresh()->id);
    }

    public function test_a_book_can_be_deleted()
    {
        // $this->withoutExceptionHandling();

        $this->post('/book', [
            'title' => 'Cool Title',
            'author' => 'Imtiaze'
        ]);

        $book = Book::first();
        $this->assertCount(1, Book::all());
        

        $response = $this->delete('/book/' . $book->id);

        $this->assertCount(0, Book::all());

        $response->assertRedirect('/books');
    }

}
