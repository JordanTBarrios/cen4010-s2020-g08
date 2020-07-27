<html lang="en">

<head>

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
            <h1>Current COVID-19 Articles</h1>
            <p class="lead">In order to use our service, please login or create an account.</p>
        </div>
    </header>

    <!-- Search by Title -->
    <section id="search">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <p class="lead">Browse the latest articles or search by title.</p>
                    <form class="needs-validation" method="post" action="search_article.php">
                        <div class="form-row">
                            <div class="col-md mb-3">
                                <label for="title">Search</label>
                                <input type="text" class="form-control" id="title" placeholder="Article Title" name="title" required>
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                                <div class="invalid-feedback">
                                    Search field is empty.
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-primary" type="submit">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
    

<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        
        //search title
        $search_title = $_POST["title"];
        $search_SQL = "SELECT * FROM articles WHERE article_title LIKE '%" . $search_title . "%'";
        
        //connect to database
        $database = new mysqli("localhost", "cen4010s2020_g08", "faueng2020", "cen4010s2020_g08");
        //$result = mysqli_query($database, $search_SQL);
        $result = $database->query($search_SQL);
        $count = mysqli_num_rows($result);
        
        echo "<section id=\"articles\">";
        if (!($count > 0)){
            //if article is not in database, search api
            
            echo "
            
            <div class=\"container\">
                <div class=\"row\">
                    <div class=\"col-lg-8 mx-auto\">
                        <h2>Sorry, this title does not exist in the database, so no comments are yet associated with this/these articles. Instead, here are the first 10 results from the GNews API.</h2>
                    </div>
                </div>
            </div>
            
            ";
            
            //connect to GNews API
            $ch = curl_init(); 
            curl_setopt($ch, CURLOPT_URL, 'https://gnews.io/api/v3/search?q=covid%20'.$search_title.'&token=d2d2bf8812fe8a0c1e55049d328923a6'); 
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
            $data = curl_exec($ch); 

            //now data can be used
            $json_data = json_decode($data, true);
            
            
            for ($i = 0; $i < 10; $i++) {
                
                //attributes of each article
                $title = $json_data['articles'][$i]['title'];
                $description = $json_data['articles'][$i]['description'];
                $img_url = $json_data['articles'][$i]['image'];
                $article_url = $json_data['articles'][$i]['url'];
    
                //automatically add article to database
                //article_title, img_url, main_text, article_url
                $add = "INSERT IGNORE INTO articles VALUES('" . $database->real_escape_string($title) . "', '$img_url', '" . $database->real_escape_string($description) . "', '$article_url')";
        
                if (!$database->query($add)) {
                    die("Error ($database->errno) $database->error<br>SQL = $add\n");
                }
            
                echo "
            
                <div class=\"container\">
                    <div class=\"row\">
                        <div class=\"col-lg-8 mx-auto\">
                            <object data=\"" . $img_url . "\" type=\"image/png\">
                                <img src=\"https://img.icons8.com/nolan/64/image.png\">
                            </object>
                            <h2>" . $title . "</h2>
                            <p class=\"lead\"> " . $description . " 
                            </p>
                            <form class=\"needs-validation\" method=\"post\" action=\"article_view.php\">
                                <input type=\"text\" value=\"".$title."\" name=\"article_title\" style=\"display:none;\">
                                <button class=\"btn btn-primary\" type=\"submit\">Read More</button>
                            </form>
                        </div>
                    </div>
                </div>
            
                ";
                
            }
            
        } else {
            //article title is found in database
            
            while ($row = $result->fetch_assoc()) {
                
                $title = $row["article_title"];
                $description = $row["main_text"];
                $img_url = $row["img_url"];
                $article_url = $row["article_url"];
                
                echo "
            
                <div class=\"container\">
                    <div class=\"row\">
                        <div class=\"col-lg-8 mx-auto\">
                            <object data=\"" . $img_url . "\" type=\"image/png\">
                                <img src=\"https://img.icons8.com/nolan/64/image.png\">
                            </object>
                            <h2>" . $title . "</h2>
                            <p class=\"lead\"> " . $description . " 
                            </p>
                            <form class=\"needs-validation\" method=\"post\" action=\"article_view.php\">
                                <input type=\"text\" value=\"".$title."\" name=\"article_title\" style=\"display:none;\">
                                <button class=\"btn btn-primary\" type=\"submit\">Read More</button>
                            </form>
                        </div>
                    </div>
                </div>
            
                ";
                
            }
        }
        echo "</section>";
        
        
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