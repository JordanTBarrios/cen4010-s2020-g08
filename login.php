<!DOCTYPE html>    <!-- login.php -->
<html lang="en">

<head>
    <!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-174374590-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-174374590-1');
</script>
    
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="This page will be used to determine if the user has entered in correct login informaiton.">
  <meta name="author" content="Muhammad Asmar">

  <title>Login php file for account validation</title>

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="css/scrolling-nav.css" rel="stylesheet">
  <link href="css/style.css" rel="stylesheet">
</head>

<body id="page-top">
  <div class="container-fluid">
    <div class="card-deck mb-3 text-center">
      <div class="card mb-4 shadow-sm">
        <div class="card-body">
          <?php
            // If POST then check submitted username and password
            if ($_SERVER["REQUEST_METHOD"] == "POST") {

                // Get values submitted from the form
                $username = $_POST["username"];
                $password = $_POST["password"];
       
                // Get user's hashed password from the user table
                $mysqli = new mysqli("localhost", "cen4010s2020_g08", "faueng2020", "cen4010s2020_g08");
                $username = $mysqli->real_escape_string($username);
                $password = $mysqli->real_escape_string($password);
                $sql = "SELECT * FROM accounts WHERE username='$username'";
                $result = $mysqli->query($sql);
                if (!$result) {
                    die("Error executing query: ($mysqli->errno) $mysqli->error");
                }
                elseif ($result->num_rows == 0) {
                    echo "<p>Username does not exist. Try again</p>";
                }
                else {
                    $row = $result->fetch_assoc();

                    // See if submitted password matches the hash stored in the user table    
                    if (password_verify($password, $row["password"])) {
                        $_SESSION["username"] = $username;
                        header("Location: home.php");
                        die;
                    } 
                    else {
                        echo "<h2><center>Incorrect username or password.</center></h2>";
                        echo '<h2><center><a href="https://lamp.cse.fau.edu/~cen4010s2020_g08/" target="_self">Back to Home Page</center></h2>';
                    }
                }
           }
          ?>
         </div>
      </div>
    </div>
  </div>
  
            
  <!-- Footer -->
  <footer class="py-5 bg-dark">
  <div class="container">
      <p class="m-0 text-center text-white">Copyright &copy; Muhammad Asmar</p>
      <p class="m-0 text-center text-white"><a href="https://startbootstrap.com/templates/scrolling-nav/" target="_blank">Link to Bootstrap Template</a></p>
    </div>
    <!-- /.container -->
  </footer>

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- Plugin JavaScript -->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
  <!-- Custom JavaScript for this theme -->
  <script src="js/scrolling-nav.js"></script>

</body>
</html>