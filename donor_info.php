<?php
require_once("setup.inc.php");

include("header.inc.php");

if(!empty($_GET['donor']))
{
   $donor_id = $_GET['donor'];
   $donor = User::load($db, $donor_id);
}

if(isset($donor))
{
?>
   <div class="box">
      <h1>Information about <?php echo $donor->name() ?>:</h1>
      <table>
         <tr>
            <td>Name:</td>
            <td><?php echo $donor->name ?></td>
         </tr>
         <tr>
            <td>Username:</td>
            <?php if(empty($donor->username)) { ?>
               <td>None</td>
            <?php } else { ?>
               <td><?php echo $donor->username ?></td>
            <?php } ?>
         </tr>
         <tr>
            <td>Email:</td>
            <td><?php echo $donor->email ?></td>
         </tr>
      </table>
   </div>
<?php } else { ?>
   <div class="box">
      <h1>The specified donor is invalid</h1>
   </div>
<?php } ?>

<?php
include("footer.inc.php");
?>

