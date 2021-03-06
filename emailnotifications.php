﻿<!DOCTYPE html>
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
      <style>
         .center {
         top: 300px;
         margin: auto;
         width: 40%;
         border: 3px solid black;
         padding: 10px;
         }
         .row{
         margin: auto;
         width: 40%;
         padding: 10px;
         }
         .column{
         width: 50%;
         margin: auto;
         }
         .button {
         background-color: #4CAF50;
         border: none;
         color: white;
         padding: 15px 32px;
         text-align: center;
         text-decoration: none;
         display: inline-block;
         font-size: 16px;
         margin: 4px 2px;
         cursor: pointer;
         }
      </style>
   </head>
   <body id="page-top">
      <!-- Navigation -->
      <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
         <div class="container">
            <a class="navbar-brand js-scroll-trigger" href="home.php">Home</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
         </div>
      </nav>
      <body>
         <section id="emailnotifications" class="bg-light">
            <br> </br>
            <h1 style="text-align:center;"> <b>Subscribe to receive email notifications!</b></h1>
            <div class="center">
               <p>By subcribing to email notifications, you will receive up-to-date email alerts on the latest news regarding the COVID pandemic. Here is some of the alerts you will receive:</p>
            </div>
            <br> </br>
            <div class="row">
               <div class="column">
                  <ul>
                     <li>Statistics(Reported Cases/Deaths)</li>
                     <li>Precautions to prevent spreads</li>
                     <li>Weekly Summaries</li>
                  </ul>
               </div>
               <div class="column">
                  <ul>
                     <li>Data Visualization</li>
                     <li>Important Annoucements</li>
                     <li>Information on businesses/society</li>
                  </ul>
               </div>
            </div>
            <hr style="height:30px">
            <hr style="height:30px">
<?php	
	$msg = NULL;

?>
	    <form method="post" align = "center" action="updateemailnotifications.php">
		Email : <input type="email" name="user_email" placeholder="Enter Your Email" required>
		<br> </br>
		<input type="submit" class = "button" value="Subscribe" />
	    </form>
<?php	
	if(isset($_GET['message'])) { 
	   $msg=$_GET['message']; 
	   echo '<script type="text/javascript">alert("'.$msg.'");</script>';
	}
?>
   </body>
</html>
</section>