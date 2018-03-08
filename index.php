<?php

  ob_start();
  session_start();

  require_once 'actions/db_connect.php';



  // it will never let you open index(login) page if session is set
  if ( isset($_SESSION['user'])!="" ) {
    header("Location: home.php");

    exit;
  }

  $error = false;
  $email = "";
  $name = "";
  $nameError ="";
  $emailError = "";
  $passError = "";

  if( isset($_POST['btn-login']) ) {

    // prevent sql injections/ clear user invalid inputs
    $email = trim($_POST['email']);
    $email = strip_tags($email);
    $email = htmlspecialchars($email);

    $pass = trim($_POST['pass']);
    $pass = strip_tags($pass);
    $pass = htmlspecialchars($pass);

    // prevent sql injections / clear user invalid inputs
    if(empty($email)){

      $error = true;
      $emailError = "Please enter your email address.";

    } else if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {

      $error = true;
      $emailError = "Please enter valid email address.";
    }

    if(empty($pass)){

      $error = true;
      $passError = "Please enter your password.";
    }

    // if there's no error, continue to login
    if (!$error) {
      $password = hash('sha256', $pass); // password hashing using SHA256

      $res=mysqli_query($conn, "SELECT userId, userName, userPass FROM users WHERE userEmail='$email'");

      $row=mysqli_fetch_array($res, MYSQLI_ASSOC);

      $count = mysqli_num_rows($res); // if uname/pass correct it returns must be 1 row
      if( $count == 1 && $row['userPass']==$password ) {

        $_SESSION['user'] = $row['userId'];
        header("Location: home.php");

      } else {

        $errMSG = "Incorrect Credentials, Try again...";

      }
    }
  }

  // count tables
  // $sql = mysqli_query($conn, "SELECT count(*) FROM `tables`");

  // $count_tables = $conn->query($sql);

  $sql = "SELECT count(*) as 'conny' FROM `tables` WHERE reservation = 0
";
    $result = $conn->query($sql);

    $data = $result->fetch_assoc();

    // echo $data["conny"];
    // $conn->close();

  require_once 'parts/head.php';

?>
<style type="text/css">
    body{
      background-image: url('cafe.jpg')
    }
  </style>
</head>

<body>

  <header id="header" class="">
    <div class="row">
      <div class="col-lg-4 col-md-4 col-4">
        <h1>&ltSource_Code_Café&gt</h1>
      </div>
      <div class="form_div">
          <div id="link">
            <a href="register.php" id="linka">Sign Up Here...</a>
          </div>
        <form class="form-inline" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off">


          <?php
            if ( isset($errMSG) ) {
              echo $errMSG; ?>

            <?php
            }

          ?>
          <input type="email" name="email" class="form-control" placeholder="Your Email" value="<?php echo $email; ?>" maxlength="40" />

          <span class="text-danger"><?php echo $emailError; ?></span>

          <input type="password" name="pass" class="form-control" placeholder="Your Password" maxlength="15" />

          <span class="text-danger"><?php echo $passError; ?></span>


          <button type="submit" name="btn-login" class="btn">Login</button>
          
        </form>
      </div>
    </div>
    
  </header><!-- /header -->

  <div class="container">
    <div class="row mainArea">
      <div class="col-md-5 col-lg-5">
        <h1>We have <?php echo $data["conny"]; ?> free Tables!</h1>

        <h3>Welcom!</h3>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
        quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
        consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
        cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
        proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
        quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
        consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
        cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
        proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
      </div>
      <div class="col-md-6 col-lg-6">
        <img src="cake.png" alt="">
      </div>
    </div>
    <div class="jumbotron">
      <div id="white">
        <h1>Contact us!</h1>
        <p>
          <a class="btn btn-lg" href="#" role="button">Email@gmail.com</a>
          Rechte Wienzeile 39, 1040 Wien
        </p>
      </div>
    </div>
  </div>

</body>
</html>
<?php ob_end_flush(); ?>