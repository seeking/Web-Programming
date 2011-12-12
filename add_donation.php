<?php
require_once("setup.inc.php");
require("login_required.inc.php");

include('header.inc.php');

$users = User::all_users($db);
$books = Book::all_books($db);
if(!empty($_POST["user_id"]) &&
           !empty($_POST["isbn"]) &&
           !empty($_POST["qty"]) &&
           !empty($_POST["cause"]) &&
           !empty($_POST["price"]) &&
	   !empty($_POST["location"]))
        {
	   $donation = new Donation();
	   $donation->donor = User::load($db,$_POST['user_id']);
           $donation->isbn = $_POST['isbn'];
           $donation->quantity = $_POST['qty'];
           $donation->cause = $_POST['cause'];
           $donation->value = str_replace(".","",$_POST['price']);
           $donation->location = $_POST['location'];
           $rc = Donation::add($db, $donation);
	if (!empty($rc)){
		echo "<h3> Duplicate donation found in the database, or fields were left blank</h3>";
	} else {
		echo "<h3> Donation added succesfully </h3>";
	}

  }

?>
<div class="box">
   <h1>Add Donation</h1>
   <form action="add_donation.php" method="post">
      <h3>Users</h3>
      <select name="user_id">
	      <?php
		foreach ($users as $user){
		   echo "<option value=$user->id>".$user->name()." </option>";
		}
	      ?>
      </select>
      <h3>Books (by ISBN)</h3>
      <select name="isbn" >
	      <?php
	       foreach ($books as $book){
			   echo "<option value=$book->isbn>$book->isbn </option>";
		}
	      ?>
      </select>
      <table>
	<tr>
		<td>Quantity</td>
		<td><input type="text" name="qty"></td>
	</tr>
        <tr>
                <td>Cause</td>
                <td><input type="text" name="cause"></td>
        </tr>
        <tr>
                <td>Sell Price</td>
                <td><input type="text" name="price"></td>
        </tr>
        <tr>
                <td>Location</td>
                <td><input type="text" name="location"></td>
        </tr>

      </table>
      <input type="submit" value="Create Donation">
   </form>
<?php
include('footer.inc.php');
?>

