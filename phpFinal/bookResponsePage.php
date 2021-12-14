<?php 
session_start();

if(isset( $_SESSION['validUser']) && $_SESSION['validUser']){
    //allow access
}
else{
    //deny access, returen to login page/homepage
    header("Location: loginPage.php");
}


$bookId = $_GET['bookId'];    //get the parameter from the URL GET name value pair
//echo "<p> You Entered a new Record with an id of $bookId. We will look that info up from the database and display it to you.</p>";

//The plan
    //-connect to database
    //-create the SQL statement. -using SELECT with WHERE clause
    //-prepare the SQL statement
    //-bind parametters into the prepared statement
    //-execute the prepared statement
    //-fetch the row from the statement object into a php associative array - on inputEvent.php
    //-display the fields on the page as needed.  


    try{
 
        require 'dbConnect1.php';   //-connect to database
    
        $sql = "SELECT book_title, book_author, book_year, book_publisher, book_description FROM book_project WHERE book_Id=:bookId";   //-create the SQL statement. -using SELECT with WHERE clause
        $stmt = $conn->prepare($sql);     //-prepare the SQL statement 
        $stmt->bindParam(':bookId' ,$bookId);    //-bind parametters into the prepared statement
    
        $stmt->execute(); //-execute the prepared statement
    
        //echo "Works so far!!";  //Check if it works
    
        $bookRecord = $stmt->fetch(PDO::FETCH_ASSOC);
        //echo $bookRecord['book_title'];
        
    
    
        }//end of try
    
        catch(PDOException $e)
        {
            $message = "There has been a problem. The system administrator has been contacted. Please try again later.";
    
            error_log($e->getMessage());			//Delivers a developer defined error message to the PHP log file at c:\xampp/php\logs\php_error_log
            error_log(var_dump(debug_backtrace()));
        
            //Clean up any variables or connections that have been left hanging by this error.		
        
            //header('Location: files/505_error_response_page.php');	//sends control to a User friendly page					
        }

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <title> Contact Us </title>

  <meta charset="utf-8">

  <link href="basicCss.css" rel="stylesheet" type="text/css">

  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
    integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
    integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
    crossorigin="anonymous"></script>

</head>
<style>


</style>

<body>

<!--Nav-->
<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
    <img src="../phpFinal/images/vintage-logo.gif" width="50" height="50" alt="logo">
        <a class="navbar-brand" href="#">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="collapsibleNavbar">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="../phpFinal/homePage.html" >Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../phpFinal/contentPage.php" >Recomendations</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../phpFinal/topBooks.php" >Book of the Month</a>
                </li>     
                <li class="nav-item">
                    <a class="nav-link" href="../phpFinal/emailPage.html" >Contact Us</a>
                </li>                

                <li class="nav-item">
                    <a class="nav-link" href="../phpFinal/loginPage.php" >Login</a>
                </li>
            </ul>
        </div>
    </nav>

        </ul>
    </div>
</nav>


<!--Nav End-->
  <section style="padding: 50px;">  

<div style="text-align: center;">
   <p style="font-size: 40px;">Your New Book! </p>     
    <div>
        <p>Thank You for your suggestion! Your book "<?php echo $bookRecord['book_title']; ?>" has been added! We all look forward to reading "<?php echo $bookRecord['book_title']; ?>" 
        by <?php echo $bookRecord['book_author']; ?>. </p>

        <p>Below is the information you have entered. If this is incorrect please contact us and we will get it fixed.</p>
        <li>Title: <?php echo $bookRecord['book_title']; ?></p>  
        <li>Author:  <?php echo $bookRecord['book_title']; ?></p>  
        <li>Publishing Year: <?php echo $bookRecord['book_year']; ?></p>
        <li>Publisher: <?php echo $bookRecord['book_publisher']; ?></p>
        <li>Description: <?php echo $bookRecord['book_description']; ?></p>
        </div>
</div>

<button> <a href="../phpFinal/loginPage.php" >Back to Admin</a></button>
<section>

</body>

</html>