<?php

class Donation
{
   public $book = null;
   public $donor = null;
   public $location = null;
   public $cause = null;
   public $notes = "";
   public $value = 0;
   public $sell_rpice = 0;
   public $created_at = null;
   public $listed_at = null;
   public $quantity = 0;
   // returns an array of donations for a given user id
   public static function donations_for_user($db, $user_id)
   {
      $donations = array();

      $query = "SELECT id, isbn, donor_id, location, cause, notes, value, quantity, created_at, listed_at FROM donations WHERE donor_id = ?";
      $statement = $db->prepare($query);
      $statement->bind_param('i', $user_id);

      // load the donations
      $statement->execute();
      // buffer the results
      $statement->store_result();
      $statement->bind_result($id, $isbn, $donor_id, $location, $cause, $notes, $value, $quantity, $created_at, $listed_at);
      while($statement->fetch())
      {
         // a single donation
         $donation = new Donation();
         $donation->id = $id;
         $donation->isbn = $isbn;
         $donation->location = $location;
         $donation->cause = $cause;
         $donation->notes = $notes;
         $donation->value = $value;
         $donation->quantity = $quantity;
         $donation->created_at = $created_at;
         $donation->listed_at = $listed_at;

         // load the book
         $donation->book = Book::load($db, $isbn);

         // load the donor
         $donation->donor = User::load($db, $donor_id);

         $donations[] = $donation;
      }

      return $donations;
   }

   public static function all_donations($db)
   {
      $donations = array();

      $query = "SELECT id, isbn, donor_id, location, cause, notes, value, quantity, created_at, listed_at FROM donations";
      $statement = $db->prepare($query);

      // load the donations
      $statement->execute();
      // buffer the results
      $statement->store_result();
      $statement->bind_result($id, $isbn, $donor_id, $location, $cause, $notes, $value, $quantity, $created_at, $listed_at);
      while($statement->fetch())
      {
         // a single donation
         $donation = new Donation();
         $donation->id = $id;
         $donation->isbn = $isbn;
         $donation->location = $location;
         $donation->cause = $cause;
         $donation->notes = $notes;
         $donation->value = $value;
         $donation->quantity = $quantity;
         $donation->created_at = $created_at;
         $donation->listed_at = $listed_at;

         // load the book
         $donation->book = Book::load($db, $isbn);

         // load the donor
         $donation->donor = User::load($db, $donor_id);

         $donations[] = $donation;
      }

      return $donations;
   }

   public static function add($db, $donation)
   {
      $insert = "INSERT INTO donations (isbn, donor_id, location, cause, notes, value, quantity, created_at, listed_at) VALUES (?, ?, ?, ?, ?, ?, ?, NOW(), NOW())";
      $statement = $db->prepare($insert);
      // TODO: donor, location, cause
      $statement->bind_param('iisssii', $donation->isbn, $donation->donor->id, $donation->location, $donation->cause, $donation->notes, $donation->value, $donation->quantity);
      $statement->execute();

      $statement->close();

      return $db->error;
   }
}
?>
