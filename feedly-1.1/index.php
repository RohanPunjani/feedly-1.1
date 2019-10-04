<?php
    session_start();
    $conn = mysqli_connect("localhost","root","","feedly");
 ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link
      rel="stylesheet"
      href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
    />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <title>Welcome</title>
    <style>
      * {
        margin: 0;
        padding: 0;
      }
      body,
      .sect1 {
        height: 100vh;
        width: 100%;
        background: url("./assets/img/event-bg-1.jpg");
        background-size: cover;
        background-attachment: fixed;
      }
      .tagline-container {
        height: 10vh;
        width: 80%;
        border-radius: 150px;
        margin: auto;
        display: flex;
        justify-content: center;
        align-items: center;
        margin-top: 10vh;
        background: #eee;
      }
      .sect2 {
        background: rgba(255, 255, 255, 0.5);
      }
      .col-md-6 {
        display: flex;
        justify-content: center;
        align-items: center;
      }
      .login,
      .register {
        height: 50vh;
        width: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
        margin: 5vh 0 5vh;
      }
      h1 {
        color: black;
        font-family: monospace;
      }
      .form-group {
        display: flex;
        justify-content: space-around;
      }
      h3 span {
        transition: all 0.1s ease-in-out;
      }
      .tagline-container:hover span {
        font-size: 2.2rem;
      }
    </style>
  </head>
  <body>
    <section class="sect sect1">
      <div class="container">
        <div class="tagline-container">
          <h3 class="tagline">
            Don't know whats going on in ur cllg?..
            <span>Login</span> to find out
          </h3>
        </div>
      </div>
    </section>
    <section class="sect sect2">
      <div class="container">
        <div class="row">
          <div class="col-md-6">
            <div class="login">
              <form action="" method="POST">
                <h1 align="center">
                  LOGIN
                </h1>
                <br />
                <div class="form-group">
                  <input
                    type="email"
                    class="form-control"
                    placeholder="Email"
                    name="email"
                  />
                </div>
                <div class="form-group">
                  <input
                    type="password"
                    class="form-control"
                    placeholder="Password"
                    name="password"
                  />
                </div>
                <div class="form-group">
                  <button type="submit" name="login" class="btn btn-dark">Login</button>
                  <button type="reset" class="btn btn-danger">Reset</button>
                </div>
              </form>
              <?php
              if(isset($_POST['login']))
              {
                $q = "SELECT * from users where user_email='$_POST[email]' and user_pass='$_POST[password]';";
                $result = mysqli_query($conn,$q);
                if($result)
                {
                  $count = mysqli_num_rows($result);
                  if($count)
                  {
                    alert("Success");
                    $row = mysqli_fetch_assoc($result);
                    $_SESSION['user_email'] = $row['user_email'];
                    header('location:pages/feedly.php');
                  }
                  else{
                    alert('Try again');
                  }
                }
              }
              function alert($msg) {
                echo "<script type='text/javascript'>alert('$msg');</script>";
              }
               ?>
            </div>
          </div>
          <div class="col-md-6">
            <div class="register">
              <form action="" method="POST">
                <h1 align="center">
                  REGISTER
                </h1>
                <br />
                <div class="form-group">
                  <input type="text" class="form-control" placeholder="Name" name="name" />
                </div>
                <div class="form-group">
                  <input
                    type="email"
                    class="form-control"
                    placeholder="Email"
                    name="email"
                  />
                </div>
                <div class="form-group">
                  <input
                    type="number"
                    class="form-control"
                    placeholder="Contact No."
                    name="number"
                    min="1000000000"
                    max="10000000000"
                  />
                </div>
                <div class="form-group">
                  <input
                    type="password"
                    class="form-control"
                    placeholder="Password"
                    name="password"
                  />
                </div>
                <div class="form-group">
                  <input
                    type="password"
                    class="form-control"
                    placeholder="Confirm password"
                  />
                </div>
                <div class="form-group">
                  <button type="submit" name="register" class="btn btn-dark">Register</button>
                  <button type="reset" class="btn btn-danger">Reset</button>
                </div>
              </form>
              <?php
                if(isset($_POST['register']))
                {
                  $count = "select distinct count(user_email) from users";
                  $id = $count + 1;
                  $q = "
                    INSERT INTO `users`
                    (
                      `user_id`, `user_username`, `user_email`, `user_mobile`, `user_pass`,`user_type`
                    )
                    VALUES 
                    (
                      $id,'$_POST[name]','$_POST[email]','$_POST[number]','$_POST[password]','student'
                    );
                  ";
                  $_SESSION['user_id'] = $id;
                  $_SESSION['user_email'] = $_POST['email'];
                  header("location:pages/sele ctTags.php");
                }
               ?>
            </div>
          </div>
        </div>
      </div>
    </section>
  </body>
</html>
