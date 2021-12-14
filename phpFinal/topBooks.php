<?php 
    include 'dbConnect1.php';

try{
    $sql = "SELECT * FROM book_project WHERE book_Id=4" ; 
                                       
    $stmt = $conn->prepare($sql);  
                               
    $stmt->execute();          

}

catch(PDOException $e){
    echo "Errors: " . $e->getMessage();
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
                    <a class="nav-link" href="#" >Book of the Month</a>
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
    <h1 style="padding: 10px 0 0 0;">Book of the month!</h1>

<p style="padding: 50px">Every 1st of the month, we pick a book that we want to read together. Members have a choice of whether or not they want to read it. 
Then, on the last weekend of the month, we get together and discuss it—both in-person or virtual.<p>

<img src="../phpFinal/images/bookMonth.jpg" alt="Girl in a jacket" width="500" height="600">


<main style="padding: 50px;">   
<?php foreach($stmt->fetchAll(PDO::FETCH_ASSOC) as $row){ 

?> 

<div >
  <p><strong>Title:</strong> <?php echo $row['book_title']; ?></p>
  <p><strong>Author:</strong> <?php  echo $row['book_author']; ?></p>
  <p><strong>Publishing Year:</strong> <?php echo $row['book_year']; ?></div>
  <p><strong>Publisher:</strong> <?php  echo $row['book_publisher']; ?></p>
  <p><strong>Description of Book:</strong> <?php echo $row['book_description']; ?> </p> 
</div>

<?php 
}    
?>
  </main>
</div>


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