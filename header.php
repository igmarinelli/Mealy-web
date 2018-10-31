<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="img/favicon.png">
    <title>Mealy | Daily meals at delicious price</title>
    <meta property="og:image" content="img/mealy-og.png">
    <meta property="description" content="Mealy is a platform that provides high quality and affordable meals for students.">
    <link href="css/style.css?v=1.1" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <script src="https://www.gstatic.com/firebasejs/5.5.5/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/5.5.5/firebase-auth.js"></script>
    <script src="https://www.gstatic.com/firebasejs/5.5.5/firebase-database.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script type="text/javascript" src="js/config.js"></script>
    <script type="text/javascript" src="js/functions.js"></script>
  </head>
  <body>
    <div class=container>
      <div class="button_container" id="toggle">
        <span class="top"></span>
        <span class="middle"></span>
        <span class="bottom"></span>
      </div>
      <div class="overlay" id="overlay">
        <nav class="overlay-menu">
          <ul>
            <li ><a href="./">Home</a></li>
            <li><a href="./">My Reservations</a></li>
            <li><a href="./?ly=group-reservations">Group Reservations</a></li>
            <li><a href="./?ly=about-us">About Mealy</a></li>
            <li><a href="./?ly=contact">Contact</a></li>
          </ul>
        </nav>
      </div>

        <div style="text-align:center; padding-top:25px; color: #fff;"><a style="font-size: 50; font-family: zulia, sans-serif;" href="index.php">Mealy</a><br><small style="position: relative; top: -20px;">Daily meals at delicious price</small></div>

      <div class="button_login">
          <a style="display:none" id="signInStatusText"></a>
        <div><button id="signInOutButton" class="loginIcon" onclick="signInGoogle()" style="font-size:0px;"></button> </div>
      </div>