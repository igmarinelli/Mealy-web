<?php
  
  if(!isset($_SESSION)) {session_start();}

  include('./header.php');

  if(!empty($_GET['ly']))
  {
    switch($_GET['ly'])
    {
      case 'checkout':
        include('./views/checkout.php');
        break;
      case 'success':
        include('./views/success.php');
        break;
      case 'group-reservations':
        include('./views/group-reservations.php');
        break;
      case 'about-us':
        include('./views/about-us.php');
        break;
      case 'contact':
        include('./views/contact.php');
        break;
    }
  }
  else
    include('./views/home.php');


  include('./footer.php');
?>