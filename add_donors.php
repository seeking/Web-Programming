<?php
require_once("setup.inc.php");
require("login_required.inc.php");

include('header.inc.php');

// check if a new donor was submitted
if(!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['organization']))
{
   $name = $_POST['name'];
   $email = $_POST['email'];
   $organization = $_POST['organization'];

   $rc = User::add($db, null, null, $name, $email, 0);
}

if(isset($rc) && $rc)
{
   // successfully added donor
?>
   <div class="box">
      <h3>Add Donor</h3>
      <p>
         Successfully added the donor <?php echo $name ?>
      </p>
   </div>
<?php } else { ?>
   <div class="box">
      <h3>Add Donor</h3>
      <?php if(isset($rc)) { ?>
         <p>Unknown error while adding donor.</p>
      <?php } ?>
      <form method="post">
         <table>
            <tr>
               <td>Name</td>
               <td><input type="text" name="name"></td>
            </tr>
            <tr>
               <td>Email</td>
               <td><input type="text" name="email"></td>
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
         <input type="submit" value="Create Donor" />
      </form>
   </div>
<?php } ?>
<?php
include('footer.inc.php');
?>
