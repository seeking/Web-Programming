<?php

class Book
{
   public $isbn = "";
   public $title = "";
   public $author = "";
   public $value = 0.0;
   public $status = "";

   public function add($db, $isbn, $title, $author, $value, $status)
   {
      $insert = "INSERT INTO books (isbn, title, author, value, status) VALUES (?, ?, ?, ?, ?)";
      $statement = $db->prepare($insert);
      $statement->bind_param('sssis', $isbn, $title, $author, $value, $status);
      $statement->execute();

      return $db->error;
   }

   public static function load($db, $isbn)
   {
      $book = null;

      // query to load the book, if applicable
      $query = "SELECT title, author FROM books WHERE isbn = ?";

      $statement = $db->prepare($query);
      $statement->bind_param('i', $isbn);

      // load the book
      $statement->execute();
      $statement->bind_result($title, $author);
      if($statement->fetch())
      {
         // the book is valid
         $book = new Book();
         $book->isbn = $isbn;
         $book->title = $title;
         $book->author = $author;
      }

      $statement->close();
      return $book;
   }

   public static function all_books($db)
   {
      // list of books
      $books = array();

      // select all books
      // TODO: genre
      $query = "SELECT isbn, title, author FROM books";
      $statement = $db->prepare($query);

      $statement->execute();
      $statement->bind_result($isbn, $title, $author);

      // fetch all books
      while($statement->fetch())
      {
         $book = new Book();
         $book->isbn = $isbn;
         $book->title = $title;
         $book->author = $author;

         $books[] = $book;
      }

      return $books;
   }
}
?>
