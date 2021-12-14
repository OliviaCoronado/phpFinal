<?php 
session_start();




//if you are a valid user then you can access this page else redirect to login page


if(isset( $_SESSION['validUser']) && $_SESSION['validUser']){
    //allow access
}
else{
    //deny access, returen to login page/homepage
    header("Location: loginPage.php");
}


if(isset($_POST['presenter_message']) && $_POST['presenter_message'] !="")//https://www.youtube.com/watch?v=fdIsENbgBn8
    //Checking to see if honeyPot is filled out
die(); 


/*The algorithm - whether or not form has been submitted
    if(form is submitted){
        process form data
        do database stuff
    }
    else{
        display form
    }

    isset(_Post)
*/


if(isset($_POST['submit'])){ //there is a variable called submit on the $_POST
    echo "Form has been SUBMITTED! ";
    //How to connect to a database!!
            //-Name/Value Pairs
            //-connect to database
            //-create the SQL statement
            //-prepare the SQL statement
            //-bind parameters into the prepared statement - Yes b/c Passing data
            //-execute the prepared statement
        //extra stuff  
            //display a confirmation message
            //create honeyPot 

//get all 'name' attruibute in the form/html
$bookTitle = $_POST['book_title'];
$bookAuthor = $_POST['book_author'];
$bookYear = $_POST['book_year'];
$bookPublisher = $_POST['book_publisher'];
$bookDescription = $_POST['book_description'];


try{
    require 'dbConnect1.php';
    $sql = "INSERT INTO book_project (book_title, book_author, book_year, book_publisher, book_description) 
    VALUES (:bookTitle,:bookAuthor,:bookYear,:bookPublisher,:bookDescription)"; //placeholder

    $stmt = $conn->prepare($sql);


    $stmt->bindParam(':bookTitle' ,$bookTitle);
    $stmt->bindParam(':bookAuthor' ,$bookAuthor);
    $stmt->bindParam(':bookYear' ,$bookYear);
    $stmt->bindParam(':bookPublisher' ,$bookPublisher);
    $stmt->bindParam(':bookDescription' ,$bookDescription);
    
    echo "Working so far";
    $stmt->execute();


    $newBookId = $conn->lastInsertId();


    //send to a 'response page' to display to customer that everything worked
    header('Location: bookResponsePage.php?bookId=' . $newBookId);
}

catch(PDOException $e)
{
    $message = "There has been a problem. The system administrator has been contacted. Please try again later.";

    error_log($e->getMessage());			//Delivers a developer defined error message to the PHP log file at c:\xampp/php\logs\php_error_log
    error_log(var_dump(debug_backtrace()));				
}



}//end of if statement - submit
else{
    echo "Form NOT SUBMITTED! "; //NOT submitted - SO display Form!!

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
            .formField{
        display: none;}

</style>
<script>
    
</script>
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


<!--Nav End-->
    
    <div class="container">
      <div style="text-align:center">
        <p style="border-bottom: 1px solid black; margin: 50px 200px;"></p>
        <h2>Add a Book</h2>
   
        <p style="border-bottom: 1px solid black; margin: 50px 200px;">
      </div>
 

        <form method="POST" action="bookAddForm.php">

            <p>
                <label for="book_title">Title</label>
                <input type="text" name="book_title" id="book_title"/>
            </p>
            <p>
                <label for="book_author">Author Full Name</label>
                <input type="text" name="book_author" id="book_author"/>
            </p>
            <p>
                <label for="book_year">Year Published:</label>
                <input type="text" name="book_year" id="book_year"/>
            </p>
            <p>
                <label for="book_publisher">Publisher:</label>
                <input type="text" name="book_publisher" id="book_publisher"/>
            </p>

            <p>
                <label for="book_description">Description:</label>
                <textarea rows="5" cols="50" name="book_description" id="book_description"></textarea>
            </p>
            <p class="formField">
			    <label for="presenter_message">Message: </label>
			    <input type="text" name="presenter_message" id="presenter_message">
		    </p>
            <p>
                <input type="submit" value="Submit"name="submit" />
                <input type="reset" id="button2" value="Try Again" />
            </p>

        </form>
       </div> 
    </body>
</html>

<?php
}
?>

