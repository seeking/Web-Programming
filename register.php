<?php
require_once("setup.inc.php");

if(isset($_POST["username"]) &&
   isset($_POST["password"]) &&
   isset($_POST["name"]) &&
   isset($_POST["email"]))
{
   $username = $_POST['username'];
   $password = $_POST['password'];
   $name = $_POST['name'];
   $email = $_POST['email'];

   $rc = User::add($db, $username, $password, $name, $email, 0);
}

include("header.inc.php");
?>
<div class="box">
   <h3>Registration</h3>
   <?php if(isset($rc) && $rc) { ?>
      <p>Successfully added user <?php echo $username ?>.</p>
   <?php } else { ?>
      <?php if(isset($rc)) { ?>
         <p>There was an error adding the user account. Perhaps your username
         has been taken</p>
      <?php } ?>
      <form name="register" onsubmit="return validate();" method="post">
         <table>
            <tr>
               <td>Username</td>
               <td><input type="text" name="username"></td>
            </tr>
            <tr>
               <td>Name</td>
               <td><input type="text" name="name"></td>
            </tr>
            <tr>
               <td>Email</td>
               <td><input type="text" name="email"></td>
            </tr>
            <tr>
               <td>Password</td>
               <td><input type="password" name="password"></td>
            </tr>
            <tr>
               <td>Confirm Password</td>
               <td><input type="password" name="confirm_password"> </td>
            </tr>
            <tr>
               <td>Organization</td>
               <td>
                  <select name="organization">
                     <option value="csm">CSM</option>
                     <option value="csu">CSU</option>
                  </select>
               </td>
            </tr>
         </table>
         <input type="submit" value="Create Account" />
      </form>
<?php } ?>
<?php
include('footer.inc.php');
?>
