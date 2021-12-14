    <?php 
    session_start();

    echo $_GET['bookId'];

    $deleteId = $_GET['bookId'];

    try {


    require 'dbConnect1.php';

    $sql = "DELETE FROM book_project WHERE book_Id=:bookId";
    $stmt = $conn->prepare($sql);                           
    $stmt->bindParam(':bookId' ,$deleteId); 
    $stmt->execute();

    }

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
    <title>Delete Page</title>

    <meta charset="utf-8">
    <link href="basicCss.css" rel="stylesheet" type="text/css">

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
        integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>

</head>


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
    <h1>Admin</h1>
   <h1>The Book recommendation has been deleted!<h1>



        
</body>

</html>