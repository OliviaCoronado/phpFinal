<?php 
session_start();        //allow access to the application session
///Not working - $_SESSION['loginName'] = $_POST['loginName']    //super session globel - https://www.youtube.com/watch?v=W4rSS4-LdIE   
/*The algorithm

    if(form is submitted){
        process form data
        do database stuff
    }
    else{
        display form
    }

    isset(_Post)
*/

//How to connect to a database!!
    //try & Catch structure
    //connect to database
    //create the SQL statement
    //prepare the SQL statement
    //bind parametters into the prepared statement
    //execute the prepared statement
        //LOGIN -
            //How do we tell that we have a valid user?
            //  if the SELECT returns at least one recored - assume valid user
            //  if the SELECT returns 0 records - assume invalid user

            //if you have a valid username/pw then display admin info
            //else display "Invalid username/pw" and display form again!

    $validUser = false; // assume invalid user until sign on
    $errMsg = "";

if( isset($_POST['submit']) ){
    
    echo "Form had been submitted!";

    $loginName = $_POST{'loginName'};
    $loginPW = $_POST{'loginPassword'};

    //echo $loginUserName; //Test - Works
    //echo $loginPW;    //Test - Works

    try{
   
            require 'dbConnect1.php'; 
            $sql = "SELECT admin_user_name, admin_user_password FROM admin_user WHERE admin_user_name=:userName AND admin_user_password=:userPW";

            $stmt = $conn->prepare($sql);
   
            $stmt->bindParam(':userName' ,$loginName);
            $stmt->bindParam(':userPW' ,$loginPW);
           
            $stmt->execute();

           $resultArray = $stmt->fetchAll(PDO::FETCH_ASSOC);

           $numRows = count($resultArray);
            echo " Number of rows found: $numRows ";
             if($numRows == 1){
                    $_SESSION['validUser'] = true; //set session variable for this user
                    $validUser = true; //valid User
                    //Display Admin Option
             }
             else{
                    //Invalid User
                    //Display Form and Error message "invalid username/password"
                    $errMsg = "Invalid username/password. Please try again!";
             }



            echo " Works so far!!"; //testing
    
    
        }
    
        catch(PDOException $e)
        {
            $message = "There has been a problem. The system administrator has been contacted. Please try again later!";
    
            error_log($e->getMessage());			//Delivers a developer defined error message to the PHP log file at c:\xampp/php\logs\php_error_log
            error_log(var_dump(debug_backtrace()));
        
            //Clean up any variables or connections that have been left hanging by this error.		
        
            //header('Location: files/505_error_response_page.php');	//sends control to a User friendly page					
        }
 
}//end if

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
                    <a class="nav-link" href="#" >Login</a>
                </li>
            </ul>
        </div>
    </nav>
<!--Nav End-->
    <div class="container">
      <div style="text-align:center">
        <p style="border-bottom: 1px solid black; margin: 50px 200px;"></p>
        <h2>Admin Login</h2>

        <p style="border-bottom: 1px solid black; margin: 50px 200px;">
      </div>

    <?php 
        /*
        if you have a vlaid user diplay Block 1 (admin)
        else display Block 2(form)
        */
        if($validUser){

    ?>  

        <div> <!--Block 1 Display this to a valid user AFTER signing on -->
            
            <h3>Available for Administrator: </h3>
            <br>
                <ul style="list-style-type:none">
                    <li><button><a href="bookAddForm.php">Add Book To Recomendation List</a></button></li>
                    <br>
                    <li><button><a href="bookSelectAll.php">Delete Book from List</a></button></li>
                    <br>
                    <li><button>Update Book</li></button>
                    <br>
                    <li><button>Update Yearly Book Winner</li></button>
                    <br>
                    <li><button>Update Book of the Month</li></button>
                    <br>
                    <li><button>Update Membership List</li></button>
                    <br>
                    <li><button><a href="logoutPage.php">Log off</a></li></button>
                </ul>
        </div> 

    <?php 
        }
        else{
            echo "<h3> $errMsg </h3>";
    ?>
    <div><!--Block 2 Display this block when you link to this page -->
        <form method="POST" action="loginPage.php">
            <p>
                <label for="loginName">Username:</label>
                <input type="text" name="loginName" id="loginName">
            </p>
            <p>
                <label for="loginPassword">Password: </label>
                <input type="password" name="loginPassword" id="loginPassword">
            </p>
            <p>
                <input type="submit"  name="submit" value="Sign On">
                <input type="reset">
            </p>
        </form>  
    </div>

    <div>
</body>
<p>Copyright &copy; <script>document.write(new Date().getFullYear())</script> Reading Between the Spines Book Club | All Rights Reserved 
</html>
    <?php
        } //End of (validUser) if/else
    ?>