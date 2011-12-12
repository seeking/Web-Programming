<?php
require_once("setup.inc.php");

include("header.inc.php");

$donations = Donation::all_donations($db);
?>
<div class="box">
   <h1>All Donations</h1>
   <?php if(count($donations)) { ?>
   <p>The following items have been donated:</p>
   <table border="1">
      <tr>
         <th>Donor</th>
         <th>ISBN</th>
         <th>Title</th>
         <th>Author</th>
      </tr>
      <?php
      foreach ($donations as $donation)
      {
         echo "<tr>\n";
         echo "<td><a href='donor_info.php?donor=" . $donation->donor->id . "'>" . $donation->donor->name() . "</a></td>\n";
         echo "<td>" . $donation->book->isbn    . "</td>\n";
         echo "<td>" . $donation->book->title   . "</td>\n";
         echo "<td>" . $donation->book->author  . "</td>\n";
      }
      ?>
   </table>
   <?php } else { ?>
      <p>There are no donations</p>
   <?php } ?>
</div>

<?php
include("footer.inc.php");
?>
