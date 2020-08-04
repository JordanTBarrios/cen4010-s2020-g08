
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
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Scrolling Nav - Start Bootstrap Template</title>

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="css/scrolling-nav.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
        <div class="container">
            <a class="navbar-brand js-scroll-trigger" href="home.php">Home</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link js-scroll-trigger" href="#about">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link js-scroll-trigger" href="#login">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link js-scroll-trigger" href="#sign-up">Sign Up</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link js-scroll-trigger" href="corona_data.php">COVID-19 Data</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link js-scroll-trigger" href="emailnotifications.php">Email Notifications</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <header class="bg-primary text-white">
        <div class="container text-center">
            <h1>View and Comment on the latest articles</h1>
            <p class="lead">In order to use our service, please login or create an account.</p>
        </div>
    </header>


<?php


    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        date_default_timezone_set('America/New_York');
        $database = new mysqli("localhost", "cen4010s2020_g08", "faueng2020", "cen4010s2020_g08");
        
        //the article title
        //use this to find the associated comments
        $passed_title = $_POST["article_title"];
        
        $sql = "SELECT * FROM articles WHERE article_title = '$passed_title'";
        $result = mysqli_query($database, $sql);
        // count = 1 if article exists
        
        if ($result && mysqli_num_rows($result) != 0) {
            $row = mysqli_fetch_array($result,  MYSQLI_ASSOC);
            
            //get article attributes from table
            $title = $row["article_title"];
            $description = $row["main_text"];
            $img_url = $row["img_url"];
            $article_url = $row["article_url"];
            
            echo "
                <p> $row[article_title]</p>
                <section id=\"articles\">
                    <div class=\"container\">
                        <div class=\"row\">
                            <div class=\"col-lg-8 mx-auto\">
                            
                                <object data=\"" . $img_url . "\" type=\"image/png\">
                                    <img src=\"https://img.icons8.com/nolan/64/image.png\">
                                </object>
                                <h2>" . $title . "</h2>
                                <p class=\"lead\"> " . $description . " 
                                </p>
                                <a class=\"btn btn-primary\" href=\"".$article_url."\">Original Article</a>
                                
                            </div>
                        </div>
                    </div>
                </section>
            
            ";
            
            
            //add comments where have the same associated article_title
            

            function setComments($database, $passed_title, $row) {
                echo "<p>'$passed_title'</p>
                    <p>'$row[article_title]'</p>
                ";
                if (isset($_POST['commentSubmit'])){
                    $uid = $_POST['uid'];
                    $date = $_POST['date'];
                    $message = $_POST['message'];
            
                    $sql = "INSERT INTO comments (uid, date, message) VALUES ('$uid', '$date', '$message')";
                    $result = mysqli_query($database, $sql);
                }
            
            }

            function getComments($database, $passed_title, $row){
                $sql = "SELECT * FROM comments";
                $result = mysqli_query($database, $sql);
                while ($row = mysqli_fetch_array($result,  MYSQLI_ASSOC)){
                    echo "<div class = 'comment-box'><p>";
                        echo $row['uid']."<br>";
                        echo $row['date']."<br>";
                        echo nl2br($row['message']);
                    echo "</p></div>";

            
                }
                
            }

            echo "
            
                <section id=\"comments\">
                    <div class=\"container\">
                        <div class=\"row\">
                            <div class=\"col-lg-8 mx-auto\">
                            
                                <h3>
        
                                
                                    <form method='POST' action='".setComments($database, $passed_title, $row)."'>
                                        <input type='hidden' name = 'uid' value = 'Anonymous'>
                                        <input type='hidden' name = 'date' value = '".date('Y-m-d H:i:s')."'>
                                        <textarea name='message'></textarea><br>
                                        <button type = 'submit' name='commentSubmit'>Comment</button>
                                    </form>
                                    

                                    getComment($database, $passed_title, $row)

                                    
                                </h3>
                                
                            </div>
                        </div>
                    </div>
                </section>
            ";
            
        }
    }


?>
    
    

    <section id="developers" class="bg-light">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <h2>Learn more about the Developers</h2>
                    <p class="lead">If you would like to learn more about the developers who have created this website, please click <a href="about.html" target="_blank" style="font-weight:400">here</a> for more information.</p>
                </div>
            </div>
        </div>
        
        
    </section>

    <!-- Footer -->
    <footer class="py-5 bg-dark">
        <div class="container">
            <p class="m-0 text-center text-white"><a href="https://startbootstrap.com/templates/scrolling-nav/">Link to Bootstrap Template</a></p>
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
    
    <!-- Article Search -->
    <script src="js/article.js"></script>
</body>

</html>