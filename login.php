<?php
require_once("setup.inc.php");

if(isset($_POST['username']) && isset($_POST['password']))
{
   $username = $_POST['username'];
   $password = $_POST['password'];

   $user = User::load($db, $username, $password);
   if($user)
   {
      // user is valid
      global $USER;

      $USER = $user;
      $_SESSION['username'] = $user->username;

      $valid = true;
   }
   else
   {
      // user is not valid
      $valid = false;
   }
}

if($valid)
{
   header('Location: home.php');
}
else
{
   include("header.inc.php");
?>
   <div class="box">
      <h1>User or password is invalid</h1>
      <p>Please enter another username and password to login.</p>
   </div>
<?php
   include("footer.inc.php");
}
?>
