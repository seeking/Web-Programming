<?php

require_once("donation.inc.php");

class User
{
   public $id = 0;
   public $name = "";
   public $username = "";
   public $email = "";
   public $admin = 0;
   public $password = "";
   public $epassword = "";

   public function name()
   {
      if($this->name)
      {
         return $this->name;
      }
      else
      {
         return $this->username;
      }
   }

   // return an array donations for a given user
   public function donations($db)
   {
      return donation::donations_for_user($db, $this->id);
   }

   // load the specified user with the specifed password (optional)
   public static function load($db, $username, $password = null)
   {
      $user = null;

      // query to load the user, if applicable
      $query = "SELECT id, name, email, admin, epassword FROM users WHERE username = ?";
      $statement = $db->prepare($query);
      $statement->bind_param('s', $username);

      // load user
      $statement->execute();
      $statement->bind_result($id, $name, $email, $admin, $epassword);
      if($statement->fetch())
      {
         // there is a user logged in
         $user = new User();
         $user->id = $id;
         $user->username = $username;
         $user->name = $name;
         $user->email = $email;
         $user->admin = $admin;
         $user->epassword = $epassword;

         $statement->close();
      }
      else
      {
         // was not valid - try to fetch using the id
         $id = $username;

         // close the last statement
         $statement->close();

         // query to load the user by id
         $query = "SELECT username, name, email, admin, epassword FROM users WHERE id = ?";
         $statement = $db->prepare($query);
         $statement->bind_param('i', $id);

         // load user
         $statement->execute();
         $statement->bind_result($username, $name, $email, $admin, $epassword);

         if($statement->fetch())
         {
            // there is a user logged in
            $user = new User();
            $user->id = $id;
            $user->username = $username;
            $user->name = $name;
            $user->email = $email;
            $user->admin = $admin;
            $user->epassword = $epassword;

            $statement->close();
         }
      }

      if($user && $password != null)
      {
         if($user->epassword != md5($password))
         {
            // non-valid password
            $user = null;
         }
      }

      return $user;
   }

   // returns the insert id
   public static function add($db, $username, $password, $name, $email, $admin)
   {
      if(!empty($username) && !empty($password))
      {
         // username and password are present
         $epassword = md5($password);

         $insert = "INSERT INTO users (username, epassword, name, email, admin) VALUES (?, ?, ?, ?, 0)";
         $statement = $db->prepare($insert);
         $statement->bind_param('ssss', $username, $epassword, $name, $email);

         $statement->execute();

         $id =  $statement->insert_id;

         $statement->close();
      }
      else
      {
         // no username nad password - only a donor
         $insert = "INSERT INTO users (name, email, admin) VALUES (?, ?, 0)";
         $statement = $db->prepare($insert);
         $statement->bind_param('ss', $name, $email);

         $statement->execute();

         $id =  $statement->insert_id;

         $statement->close();
      }

      return $id;
   }

   public static function all_users($db)
   {
      // list of users
      $users = array();

      // select all users
      $query = "SELECT id, username, name, email, admin, epassword FROM users";
      $statement = $db->prepare($query);

      $statement->execute();
      $statement->bind_result($id, $username, $name, $email, $admin, $epassword);

      // fetch all
      while($statement->fetch())
      {
         // there is a user logged in
         $user = new User();
         $user->id = $id;
         $user->username = $username;
         $user->name = $name;
         $user->email = $email;
         $user->admin = $admin;
         $user->epassword = $epassword;

         $users[] = $user;
      }

      return $users;
   }
}

?>
