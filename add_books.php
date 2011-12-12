<?php
require_once("setup.inc.php");
require("login_required.inc.php");

include("header.inc.php");

if(isset($_POST['add_book']))
{
   if(!empty($_POST['isbn']))
   {
      $isbn = $_POST['isbn'];
      // remove all non-digit characters
      $isbn = preg_replace('/\D/', '', $isbn);
   }
   else
   {
      $isbn = "";
   }
   if(!empty($_POST['author']))
   {
      $author = trim($_POST['author']);
   }
   else
   {
      $author = "";
   }
   if(!empty($_POST['title']))
   {
      $title = trim($_POST['title']);
   }
   else
   {
      $title = "";
   }
   if(!empty($_POST['value']))
   {
      $value = trim($_POST['value']);
   }
   else
   {
      $value = "";
   }
   if(!empty($_POST['status']))
   {
      $status = trim($_POST['status']);
   }
   else
   {
      $status = "";
   }

   // if one of the Google books fields is blank, use Google Books
   if(!empty($isbn) && (empty($title) || empty($author) || empty($value)))
   {
      // title, author, or value is blank - use Google Books
      $google_url = "https://www.googleapis.com/books/v1/volumes?q=$isbn+isbn";
      $jsondata = file_get_contents($google_url);
      $json = json_decode($jsondata);
      if($json->totalItems)
      {
         if(empty($title))
         {
            if(isset($json->items[0]->volumeInfo->title))
            {
               $title = $json->items[0]->volumeInfo->title;
            }
         }
         if(empty($author))
         {
            if(isset($json->items[0]->volumeInfo->authors[0]))
            {
               $author = $json->items[0]->volumeInfo->authors[0];
            }
         }
         if(empty($value))
         {
            if(isset($json->items[0]->saleInfo->listPrice->amount))
            {
               $value = $json->items[0]->saleInfo->listPrice->amount;
            }
            else if(isset($json->items[0]->saleInfo->retailPrice->amount))
            {
               $value = $json->items[0]->saleInfo->retailPrice->amount;
            }
         }
         $found = 1;
      }

      if(empty($title) || empty($author) || empty($value))
      {
         echo "<h3>Partial book information found using Google Books. Please complete and verify the information before submitting.</h3>";
      }
      else if($found == 1)
      {
         echo "<h3>Book found using Google Books. Please verify the information before submitting.</h3>";
      }
   }
   else if(is_numeric($value))
   {
      // value is not blank - add the book
      $value = $value * 100;

      $rc = Book::add($db, $isbn, $author, $title, $value, $status);
      if (!empty($rc)){
         echo "<h3>Duplicate book found in the database, or fields left blank</h3>";
      } else {
         echo "<h3>Book added succesfully</h3>";
      }
   }
   else
   {
      // value is not numeric
      echo "<h3>Error: value is not numeric!</h3>";
   }
}
?>
<div class="box">
   <h1>Add New Books</h1>
   <p>Leave the title, author, or value blank in order to use the Google Books API.</p>
   <form method="POST">
      <table>
         <tr>
            <td>ISBN</td>
            <td><input type="text" name="isbn" value="<?php echo $isbn ?>" /></td>
         </tr>
         <tr>
            <td>Title</td>
            <td><input type="text" name="title" value="<?php echo $title ?>" /></td>
         </tr>
         <tr>
            <td>Author</td>
            <td><input type="text" name="author" value="<?php echo $author ?>" /></td>
         </tr>
         <tr>
            <td>Value</td>
            <td>
               <input type="text" name="value" value="<?php echo $value ?>" />
            </td>
         </tr>
         <tr>
            <td>Status</td>
            <td><input type="text" name="status" value="<?php echo $status ?>" /></td>
         </tr>
      </table>
      <input type="submit" value="Add Book" name="add_book" />
   </form>
</div>
<?php
include("footer.inc.php");
?>
