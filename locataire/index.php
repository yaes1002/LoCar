<?php
  require_once "../scripts/connection.php";
  session_start();
  if( !isset($_SESSION['user']) || $_SESSION['user'] != 'locataire' )
  {
    header('Location: ../');
  }

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Espace Locataire</title>

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
<body  onload="GetAvatarPic('<?php echo $_SESSION['id']?>','<?php echo $_SESSION['user'] ?>')">

  <!-------------------Header --------------------->
  <header class="header" id="headerBar">
    <div class="headerToggle">
      <i class='bx bx-menu' id="header-toggle"></i>
    </div>
    <div class="headerNameImg">
      <span class="HeaderNom">
      </span>
      <img id="ProfileAvatar" class="dropdown-toggle" alt="profilePic" onclick="ShowDropMenu()">
      
      <ul id="dropMenu" class="dropdown-menu animate__animated animate__bounceIn" >
        <li><a class="dropdown-item" href="profil.php"><i class='bx bx-user-circle'></i>Profile</a></li>
        <li><hr class="dropdown-divider"></li>
        <li><a class="dropdown-item" href="../scripts/logout.php"><i class='bx bx-log-out'></i>Deconexion</a></li>
      </ul>
    </div>
    
  </header><!------------------- End Header --------------------->

  <!-------------------SideBar --------------------->
  <div class="l-navbar" id="nav-bar">
    <nav class="nav">
      <div>
        <a href="" class="navLogo">
          <i class='bx bxs-car'></i>
          <span class="navLogo-name">LoCar</span>
        </a>
        <div class="nav__list ">
          <a href="" class="navLink active">
            <i class='bx bx-grid-alt nav__icon'></i>
            <span class="nav__name">Accueil</span>
          </a>
          <a href="profil.php" class="navLink">
            <i class='bx bx-user nav__icon'></i>
            <span class="nav__name">Profil</span>
          </a>
          <a href="reservations.php" class="navLink">
            <i class="fas fa-stream"></i>
            <span class="nav__name">Reservations</span>
          </a>
          <a href="voitures.php" class="navLink ">
            <i class='bx bxs-car-garage nav__icon'></i>
            <span class="nav__name">Voitures</span>
          </a>
          <a href="../contact-us/message.php" class="navLink">
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
  <main  id="body-pd" class="main">

    <!------------------- Hero Section -------------------->
    <section id="hero" class="align-items-center">
      <div class="row container-fluid voitureInfosTitle animate__animated animate__fadeIn" >
        <div class="col-ms-12 AcceuilTitle">
          <div class="row">
            <h1 class="VoitureTitle">Bonjour Dans L'espace Locataire</h1>
            
          </div>
        </div>
      </div>
    </section><!------------------ End Hero -------------------->


  </main>

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