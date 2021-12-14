<?php 

    try{
 
        require 'dbConnect1.php';

            $sql = "SELECT * FROM book_project" ;                               
            $stmt = $conn->prepare($sql);                           
            $stmt->execute();
        
        //foreach($stmt->fetchAll(PDO::FETCH_ASSOC) as $row){ 

           // echo $row['book_Id'];            
            //echo $row['book_title'];
           // echo $row['book_description']; 

    

 

                
    
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
    <title>Homepage</title>
 
    <meta charset="utf-8">

    <link href="basicCss.css" rel="stylesheet" type="text/css">
    <script src="script.js" type="text/javascript"></script>

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
                    <a class="nav-link" href="#" >Recomendations</a>
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


    <div class="contaniner"> 
        

        <h1 style="padding: 10px 0 0 0;">Recommended Books!</h1>
    
        <main style="padding: 50px;">
    <?php 
            foreach($stmt->fetchAll(PDO::FETCH_ASSOC) as $row){ 
    ?>

            <div class="card" style="padding:50px">
                <strong><?php echo $row['book_title']; ?></strong>
                <p><?php echo $row['book_author']?>: <?php echo $row['book_year']; ?>, <?php echo $row['book_publisher']; ?></p></p>
                <p><?php echo $row['book_description']; ?></p> 
            </div>
        
    <?php
            }
    ?>
        </main>
    </div>



  


    

    <section>
        <section class="mid_h4">
            <h4>Have a Look at the books that have been Recommended!</h4>
        </section>
        <section class="mid_para">
            <p class="intro">You’ve no doubt heard this very common saying before, perhaps from your parents when you were younger, as
                it conveys an important lesson—one not actually, or at least not exclusively, about books, as you might
                guess. Read on to discover the meaning of the idiomatic expression don’t judge a book by its cover.</p>
        </section>
    </section>
    <!--Social-->
    <div class="mid">
        <p>
            <a href="https://www.facebook.com/" target="_blank">
                <img src="images/facebook.svg" width="50" height="50" alt="facebook icon"></a>

            <a href="https://www.twitter.com/" target="_blank">
                <img src="images/twitter.svg" width="50" height="50" alt="twitter icon"></a>

            <a href="https://www.pinterest.com/" target="_blank">
                <img src="images/pinterest.svg" width="50" height="50" alt="pinterest icon"></a>

            <a href="https://www.instagram.com/" target="_blank">
                <img src="images/instagram.svg" width="50" height="50" alt="instagram icon"></a>

        </p>
   
    </div>

    <!--Social-->
    <!--Footer-->
    <footer>

        <div class="row">
            <div class="col-sm-6 offset-sm-3">
                <p> Reading Between the Spines Book Club | 604 24th Street Des Moine, Iowa | (702) 971-1154</p>
                <p>Copyright &copy; <script>document.write(new Date().getFullYear())</script> Reading Between the Spines Book Club | All Rights Reserved | Site by <em>Olivia Coronado</em> </p>
                <img src="../phpFinal/images/vintage-logo.gif" width="50" height="50" alt="logo">
            </div>
        </div>

    </footer>
    <!--Footer End-->

</body>

</html>