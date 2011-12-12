<?php
require_once("setup.inc.php");

include("header.inc.php");
?>
<div class="box">
   <h1>User Homepage</h1>
   <p>You have donated the following items:</p>
   <table border="1">
      <tr>
         <th>ISBN</th>
         <th>Title</th>
         <th>Author</th>
      </tr>
<?php
foreach ($USER->donations($db) as $donation)
{
   echo "<tr>";
   echo "<td>" . $donation->book->isbn   . "</td>";
   echo "<td>" . $donation->book->title  . "</td>";
   echo "<td>" . $donation->book->author . "</td>";
}
?>
   </table>
</div>
<?php
include("footer.inc.php");
?>

