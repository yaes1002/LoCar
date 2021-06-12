<?php


  require_once "../scripts/connection.php";
  session_start();
  if( !isset($_SESSION['user'])  )
  {
    header('Location: ../');
  }


  //Valeur par defaut est 2 pour ne pas afficher un alert
  $errMsg = 2;

  if(isset($_GET['err']))
  {
    if( $_GET['err']==1 )
      $errMsg = 1;
    else if ( $_GET['err']==0 )
      $errMsg = 0;
  }
  
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Vos Voitures</title>

  <!-- Favicons -->
  <link href="../assets/img/favicon.png" rel="icon">

  <!-- Animate .css-->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

  <!---Font Awesome-->
  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
  
  <!---boxicons---->
  <link href='https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css' rel='stylesheet'>

  <!---------------W3s ------------>
  <link href="https://www.w3schools.com/w3css/4/w3.css" rel="stylesheet" />

  <!---------------jquery ------------>
  <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
  <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
  <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
  
  <!-- Bootstrap and style.css-->
  <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../assets/css/style.css" rel="stylesheet">
  <link href="../assets/css/espace.css" rel="stylesheet">

</head>
<body onload="GetAvatarPic('<?php echo $_SESSION['id']?>','<?php echo $_SESSION['user'] ?>')">

  <!-------------------Header --------------------->
  <header class="header" id="headerBar">
    <div class="headerToggle">
      <i class='bx bx-menu' id="header-toggle"></i>
    </div>
    <div class="headerNameImg">
      <span class="HeaderNom">
      </span>
      <img id="ProfileAvatar"  class="dropdown-toggle" alt="profilePic" onclick="ShowDropMenu()">
      
      <ul id="dropMenu" class="dropdown-menu animate__animated animate__bounceIn" >
        <li><a class="dropdown-item" href="../locataire/profil.php"><i class='bx bx-user-circle'></i>Profile</a></li>
        <li><hr class="dropdown-divider"></li>
        <li><a class="dropdown-item" href="../scripts/logout.php"><i class='bx bx-log-out'></i>Deconexion</a></li>
      </ul>
    </div>
    
  </header><!------------------- End Header --------------------->

  <!-------------------SideBar --------------------->
  <div class="l-navbar" id="nav-bar">
    <nav class="nav">
      <div>
        <a href="../<?php echo $_SESSION['user'] ?>" class="navLogo">
          <i class='bx bxs-car'></i>
          <span class="navLogo-name">LoCar</span>
        </a>
        <div class="nav__list">
          <a href="../<?php echo $_SESSION['user'] ?>" class="navLink">
            <i class='bx bx-grid-alt nav__icon'></i>
            <span class="nav__name">Accueil</span>
          </a>
          <a href="../<?php echo $_SESSION['user'] ?>/profil.php" class="navLink">
            <i class='bx bx-user nav__icon'></i>
            <span class="nav__name">Profil</span>
          </a>
          <a href="../<?php echo $_SESSION['user'] ?>/reservations.php" class="navLink">
            <i class="fas fa-stream"></i>
            <span class="nav__name">Reservations</span>
          </a>
          <?php
          if($_SESSION['user'] == 'locataire')
          {
          ?>
          <a href="../locataire/voitures.php" class="navLink ">
            <i class='bx bxs-car-garage nav__icon'></i>
            <span class="nav__name">Voitures</span>
          </a>
          <?php
          }
          ?>
          <a href="" class="navLink active">
            <i class='bx bx-message-square-detail nav__icon'></i>
            <span class="nav__name">Messages</span>
          </a>
        </div>
      </div>
      <a href="../scripts/logout.php" class="navLink">
        <i class='bx bx-log-out nav__icon'></i>
        <span class="nav__name">Deconnexion</span>
      </a>
    </nav>
  </div>
  <!-------------------End SideBar --------------------->

  <!------------------- main -------------------->
  <main  id="body-pd" class="main" id="main">
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
  </main><!-------------------End  main -------------------->
  
  <!-------------------- Footer -------------------->
  <footer id="footer">
    <div class="footer-top">
      <div class="container py-4">
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

  <!--------------- PreLoader ------------->  
  <div id="preloader"></div>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="fas fa-arrow-up"></i></a>


  <!-- BOotstrap js -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
  
  <!-- Template Main JS File -->
  <script src="../assets/js/main.js"></script>
  <script src="../assets/js/espace.js"></script>

  <!-- W3s js -->
  <script src="https://www.w3schools.com/lib/w3.js"></script>
  
</body>
</html>