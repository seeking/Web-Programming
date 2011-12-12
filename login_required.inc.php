<?php

// ensures that a user is logged in; if the user is not logged in, then an
// error message is displayed
// require this file before setup and before header

if(!isset($USER))
{
   include("header.inc.php");
?>
<div class="box">
   <h3>ERROR: You must be logged into the system in order to access this page.</h3>
   <p>Please login using the username and password fields at the top of this file.</p>
</div>
<?php
   include("footer.inc.php");
   exit(1);
}

?>
