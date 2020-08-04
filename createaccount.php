<!DOCTYPE html>   <!-- createaccount.php-->
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
  <meta name="description" content="This php file will take information from the create account form in the index.php file and store the account information in a database. If the account information already exists, then the user is informed that the username already exists and their account will not be created.">
  <meta name="author" content="Muhammad Asmar">

  <title>Create Account for Coronavirus Search Application</title>

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
            function test_input($data) {
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                return $data;
            }

            // If POST then create account
            if ($_SERVER["REQUEST_METHOD"] == "POST") {

                // Get values submitted from the form
                $username = $_POST["username"];
                $email = $_POST["email"];
                $password = $_POST["password"];

                //test inputs for script attacks
                $username = test_input($username);
                $email = test_input($email);
                $password = test_input($password);
       
                // Hash the password
                $passwordHash = password_hash($password, PASSWORD_BCRYPT);

                // Insert username and password hash into user table
                $mysqli = new mysqli("localhost", "cen4010s2020_g08", "faueng2020", "cen4010s2020_g08");
                if($mysqli->connect_error){
                    die("Connection failed: " . $mysqli->connect_error);        
				}

                $sql = "INSERT INTO accounts (username, password, email) VALUES ('$username', '$passwordHash', '$email')";
                if ($mysqli->query($sql)) {
                    echo "<h2><center>Your account has been created.</center></h2>",
                    "<p><a href='index.html'>Login</a></p></html>";
                    die;
                }
                elseif ($mysqli->errno == 1062) {
                    echo "<h2><center>The username <strong>$username</strong> already exists.",
                    " Please choose another username and click the link below to go back to the home page.</center></h2>";
                    echo '<h2><center><a href="http://lamp.cse.fau.edu/~cen4010s2020_g08/" target="_self">Back to Home Page</center></h2>';
                }
                else {
                    die("Error ($mysqli->errno) $mysqli->error");
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