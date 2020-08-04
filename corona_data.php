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
            <h1>COVID-19 Data by Country</h1>
            <p class="lead">In order to use our service, please login or create an account.</p>
        </div>
    </header>

    <!-- Search by Title -->
    <section id="search">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <p class="lead">Search current data by country</p>
                    <form class="needs-validation" method="post" action="corona_data.php">
                        <div class="form-row">
                            <div class="col-md mb-3">
                                <label for="title">Search</label>
                                <input type="text" class="form-control" id="country" placeholder="Country Name" name="country" required>
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
    
    //get global data
    $ch2 = curl_init(); 
    curl_setopt($ch2, CURLOPT_URL, 'https://disease.sh/v3/covid-19/all'); 
    curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true); 
    curl_setopt($ch2, CURLOPT_FOLLOWLOCATION, true);
    $data2 = curl_exec($ch2); 

    //now data can be used
    $json_data2 = json_decode($data2, true);
    
    $global_cases = $json_data2['cases'];
    $global_deaths = $json_data2['cases'];
    $global_recovered = $json_data2['cases'];
    
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    //if user types in a specific country
    
    //search country
    $search_country = $_POST["country"];
    
    $ch = curl_init(); 
    curl_setopt($ch, CURLOPT_URL, 'https://disease.sh/v3/covid-19/countries/'.$search_country); 
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    $data = curl_exec($ch); 

    //now data can be used
    $json_data = json_decode($data, true);
    
    //attributes of each country
    $country_flag = $json_data['countryInfo']['flag'];
    $country_cases = $json_data['cases'];
    $country_cases_today = $json_data['todayCases'];
    $country_deaths = $json_data['deaths'];
    $country_deaths_today = $json_data['todayDeaths'];
    $country_recovered = $json_data['recovered'];
    
} else {
    //otherwise, default show USA COVID-19 data
    
    $ch = curl_init(); 
    curl_setopt($ch, CURLOPT_URL, 'https://disease.sh/v3/covid-19/countries/usa'); 
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    $data = curl_exec($ch); 

    //now data can be used
    $json_data = json_decode($data, true);
    
    
    //attributes of each country
    $search_country = "usa";
    $country_flag = "https://disease.sh/assets/img/flags/us.png";
    $country_cases = $json_data['cases'];
    $country_cases_today = $json_data['todayCases'];
    $country_deaths = $json_data['deaths'];
    $country_deaths_today = $json_data['todayDeaths'];
    $country_recovered = $json_data['recovered'];
    
}
    
//display today's data for country
    echo "
        <section id=\"covid_data\">
            
            <div class=\"container\">
                <div class=\"row\">
                    <div class=\"col-lg-8 mx-auto\">
                    
                        <img src=\"".$country_flag."\">
                        <h2>Today's Statistics: " . $search_country . "</h2>
                        <p class=\"lead\">Today's Cases: " . $country_cases_today . "
                        </p>
                        <p class=\"lead\">Today's Deaths: " . $country_deaths_today . "
                        </p>
                        
                    </div>
                </div>
            </div>
            
            <div class=\"container\">
                <div class=\"row\">
                    <div class=\"col-lg-8 mx-auto\">
                    
                        <h2>Global Comparison</h2>
                        <p class=\"lead\">Cases (".$search_country."): " . $country_cases . "
                        </p>
                        <p class=\"lead\">Cases (global): " . $global_cases . "
                        </p>
                        <p class=\"lead\">Deaths (".$search_country."): " . $country_deaths . "
                        </p>
                        <p class=\"lead\">Deaths (global): " . $global_deaths . "
                        </p>
                        <p class=\"lead\">Recovered (".$search_country."): " . $country_recovered . "
                        </p>
                        <p class=\"lead\">Recovered (global): " . $global_recovered . "
                        </p>
                        
                    </div>
                </div>
            </div>
        
        </section>
    
    
    ";
    
//display global vs country data

curl_close($ch2);
curl_close($ch);

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