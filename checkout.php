<?php
  
  if(!isset($_SESSION)) {session_start();}

  include('./header.php');

?>

<?php 

  switch($_COOKIE['reservationAmount'])
  {
    case 1:
      $button_id = 'A4REMAQEPW7XC';
      break;

    case 2:
      $button_id = 'H4C8L5K8YX6NQ';
      break;

    case 3:
      $button_id = 'QHKJQP79XTHUY';
      break;

    case 4:
      $button_id = 'MXS5FMSBZXZF6';
      break;

    case 5:
      $button_id = '2GBZHYB8C8EYL';
      break;
  }

?>

<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="hosted_button_id" value="<?php echo $button_id; ?>">
<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_paynowCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
</form>

<?php
  include('./footer.php');
?>