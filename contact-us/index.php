<?php
  require_once "../scripts/connection.php";
  session_start();
  if( isset($_SESSION['user']) || !empty($_SESSION['user']) )
  {
    if(isset($_GET['err']))
    {
      $errMsg = $_GET['err'];
      header("Location: message.php?err=$errMsg");
    }
    else
      header("Location: message.php");
  }
  
  //Valeur par defaut est 2 pour ne pas afficher un alert
  $errMsg = 2;

  if(isset($_GET['err']))
    $errMsg = $_GET['err'];
  
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>LoCar - Contactez Nous</title>

  <!-- Favicons -->
  <link href="../assets/img/favicon.png" rel="icon">
  <link href="../assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Animate .css-->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

  <!-- Bootstrap and style.css-->
  <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../assets/css/style.css" rel="stylesheet">
  
  <!--Font Awesome -->
  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />



</head>

<body class="contactBody">

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top">
    <div class="navCont container-fluid  d-flex justify-content-between">
      <h1 class="logo"><a href="../">LoCar</a></h1>
      <div class="col loCarLogoCont paddLoCarLogoCont">
        <img src="../assets/img/LoCarLogo.png" alt="">
      </div>
    </div>
    
  </header><!-- End Header -->
  <main id="main">
    <!-------------------------------------------------------------------->
    <div class="container EspaceHeader">
      <h2 class=" animate__animated animate__pulse animate__infinite">Contactez-Nous</h2>
    </div>
    <div class="container contactContainer contactContainerClient">
      <div class="row justify-content-center  animate__animated animate__fadeIn">
        <div class="col-lg-6 d-none d-lg-block bg-contact-image imgContact"></div>
        <div class="col-lg-6">
          
          <div class="row">
            <div class="FormContainer contactFormContainer animate__animated animate__fadeIn">
              <!-----------------------------------Contact Form------------------------------------------>
              <h2 class="ContactTitle mt-4">NOUS SOMMES LÀ POUR VOUS AIDER</h2>
                <h4 class="Contact2ndTitle">Vous avez une question, une remarque, un commentaire à faire passer à nos équipes</h4>
              <form action="../scripts/savemessage.php" method="POST" class="contactForm mt-4">
                <div class="row form-group mb-3">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="text" class="form-control contactInput" id="FirstName" placeholder="Nom" name="nom"  maxlength="20" required>
                  </div>
                  <div class="col-sm-6">
                    <input type="text" class="form-control contactInput" id="LastName" placeholder="Prenom" name="prenom" maxlength="20" required>
                  </div>
                </div>
                <div class="mb-3">
                  <input type="email" class="form-control contactInput" id="inputEmail" name="email" pattern="^[a-zA-Z0-9]{2,10}[-|_]?[a-zA-Z0-9]{2,10}@[a-z]+\.[a-z]{2,5}$" maxlength="35" placeholder="Adresse E-mail" required>
                </div>
                <div class="mb-3 input-group">
                  <label for="inputTel" class="input-group-text telPrefix">+212 </label>
                  <input type="tel" class="form-control contactInput" id="inputTel" name="tel" pattern="[6-7][0-9]{8}" placeholder="Num De Tel" >
                </div>
                <div class="mb-3">
                  <input type="text" class="form-control contactInput" id="inputSujet" name="sujet" maxlength="30" placeholder="Sujet" maxlength="30" required>
                </div>
                <div class="mb-3">
                  <textarea id="" class="form-control contactInput" name="message" rows="4" placeholder="Entrer Votre Message Ici (Max 150 caractere)" maxlength="150"  required></textarea>
                 <!-- <label for="floatingTextarea2">Message</label>-->
                </div>
                <button type="submit" class="contactSubmit">Envoyez</button>
                <!----------------Test Erreur Msg --------------------->
                <?php
                  if($errMsg == 1)
                  {
                    ?>
                      <div class="alert myAlert  alert-danger alert-dismissible fade show alertMsgBox mt-2" role="alert">
                        <i class="fas fa-exclamation-triangle"></i>
                        <strong>Attention: </strong> Erreur Lors de L'envoie du message
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>
                    <?php
                  } 
                  else if($errMsg == 0)
                  {
                    ?>
                      <div class="alert myAlert alert-success alert-dismissible fade show alertMsgBox mt-2" role="alert">
                        <i class="fas fa-check-circle"></i>
                        <strong>Felicitaion: </strong> Votre Message a bien été Envoyé.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>
                    <?php
                  }
                 
                ?>
                 <!----------------Fin Test Erreur Msg --------------------->
              </form>
            </div>
          </div>
        </div>

      </div>
    </div>
  </main>
  <!-- ======= Footer ======= -->
  <footer id="footer">
    <div class="footer-top">
      <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6 footer-links"> 
              <h2>LoCar</h2>
              <p>Vous désirez louer une voiture? Ou bien vous avez une voiture à louer?<br> 
                 LoCar vous offre un service de haute qualité grâce à notre expérience
                 en tant qu'intermédiare de location de voitures dans tout le maroc.
              </p>
            </div>
            <div class="col-lg-3 col-md-6 footer-links">
              <h4>BESOIN D'AIDE?</h4>
              <ul>
                <li><i class="fas fa-chevron-right"></i> <a href="index.php">ACCUEIL</a></li>
                <li><i class="fas fa-chevron-right"></i> <a href="about-us.php">QUI SOMMES NOUS</a></li>
                <li><i class="fas fa-chevron-right"></i> <a href="">NOUS CONTACTER</a></li>
                <li><i class="fas fa-chevron-right"></i> <a href="faq.php">FOIRE AUX QUESTIONS</a></li>
              </ul>
            </div>
            <div class="col-lg-3 col-md-6 footer-links">
              <h4>DÉCOUVRIRE</h4>
              <ul>
                <li><i class="fas fa-chevron-right"></i><a href="assurance.php">ASSURANCE</a></li>
                <li><i class="fas fa-chevron-right"></i> <a href="lavage.php">LAVAGE</a></li>
                <li><i class="fas fa-chevron-right"></i> <a href="diagnostic.php">DIAGNOSTIC VEHICULE</a></li>
              </ul>
            </div>
            <div class="col-lg-3 col-md-6 footer-newsletter">
              <h4>RETROUVER-NOUS SUR</h4>
              <div class="social-links text-center text-md-right pt-3 pt-md-0">
                <a href="#" class="facebook"><i class="fab fa-facebook-square"></i></a>
                <a href="#" class="instagram"><i class="fab fa-instagram"></i></a>
                <a href="#" class="twitter"><i class="fab fa-twitter"></i></a>
                <a href="#" class="google-plus"><i class="fab fa-skype"></i></a>
                <a href="#" class="linkedin"><i class="fab fa-linkedin"></i></a>
              </div>
            </div>
        </div>
      </div>
      <div class="container d-md-flex py-4">
        <div class="me-md-auto text-center text-md-start">
            <div class="copyright">
              &copy; Copyright <strong><span>LoCar</span></strong>. All Rights Reserved
            </div>
            <div class="credits">
                 Designed by <i>Aserrar Youssef</i> & <i>Es-diri Yassine</i>
            </div>
        </div>
      </div>
    </div> 
  </footer>
  <!--------------- End Footer ------------->

    <div id="preloader"></div>
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="fas fa-arrow-up"></i></a>

    <!-- BOotstrap js -->
    <script src="../assets/vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Template Main JS File -->
    <script src="../assets/js/main.js"></script>



</body>

</html>