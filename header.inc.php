<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
   "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
   <meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
   <title>Compassion by Books</title>
   <link rel="stylesheet" type="text/css" href="style.css" />
   <script type="text/javascript" src="validateFields.js"></script>
</head>
<body>
   <div id="content">
      <div id="header">
         <div id="login">
            <?php if(!isset($USER)) { ?>
               <form action="login.php" method="post">
                  User:
                  <input class="input" type="text" name="username" />
                  Password:
                  <input class="input" type="password" name="password" />
                  <input type="submit" value="Login" />
                  <a href="register.php">Register</a>
               </form>
            <?php } else { ?>
               Logged in as <a href="home.php"><?php echo $USER->name() ?></a>.
               <a href="logout.php">Logout</a>
            <?php } ?>
         </div>
         <a href="index.php"><img src="images/logo.png" /></a>
         <div class="menu">
         <?php if(!isset($USER)) { ?>
            <ul>
               <li><a href="about.php">About</a></li>
               <li><a href="#">Get Involved</a></li>
               <li><a href="#">Donate</a></li>
               <li><a href="faq.php">FAQ</a></li>
               <li><a href="contact.php">Contact</a></li>
            </ul>
         <?php } else { ?>
            <ul>
               <li><a href="add_donation.php">Add Donation</a></li>
               <li><a href="add_donors.php">Add Donor</a></li>
               <li><a href="add_books.php">Add Book</a></li>
               <li><a href="all_donations.php">All Donations</a></li>
            </ul>
         <?php } ?>
         </div>
      </div>
      <div id="main">
