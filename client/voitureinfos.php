<?php
  require_once "../scripts/connection.php";
  session_start();
  if( !isset($_SESSION['user']) || $_SESSION['user'] != 'client' )
  {
    header('Location: ../');
  }

  if (!isset($_GET['id']) || empty($_GET['id'])) 
    header('Location: ../erreur/404.php');

  $vehicule_id = $_GET['id'];
  
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
<body onload="GetAvatarPic('<?php echo $_SESSION['id']?>','<?php echo $_SESSION['user'] ?>'),GetVoitureDispo('<?php echo $vehicule_id?>')">

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
        <a href="./" class="navLogo">
          <i class='bx bxs-car'></i>
          <span class="navLogo-name">LoCar</span>
        </a>
        <div class="nav__list ">
          <a href="./" class="navLink active">
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
            <h1 class="VoitureTitle">Bonjour Dans L'espace Client</h1>   
          </div>
        </div>
      </div>
    </section><!------------------ End Hero -------------------->

    <div class="container-sm carsRowContainer mt-5 ">
    <!---------------- Car Row  -------------------->

    <?php
    if (isset( $vehicule_id)) 
    {
      $afichageQueery = " select *
                          from vehicule v JOIN locataire l
                          using (locataire_id)
                          where v.vehicule_id = $vehicule_id
                          and v.visibilite='Oui'";

      if ($tableContenu = $conn->query($afichageQueery)) 
      {
        if($tableContenu->num_rows != 0 )
        {
          while ($row = $tableContenu->fetch_assoc()) 
          {
      ?>

          <div class="row g-3">
            <!---------------- Car Column  -------------------->
            <div class="col-sm-12 col-lg-8 carInfosContainer">
              <div class="carImageTitleCont mb-3">
                <div class="row">
                  <h2 class="carInfosTitle col-sm-8"><?php echo ucfirst($row['marque']) . " " . ucfirst($row['modele']) . " " . ucfirst($row['annee']); ?> </h2>
                  <h2 class="carVilleCont col-sm-4">
                    <span class="carVille carInfosVille">
                      <i class="fas fa-map-marker-alt"></i> <?php echo ucfirst($row['ville']); ?>
                    </span>
                  </h2>
                </div>
                <div class="row carImageCont">
                  <img src="../<?php echo $row['vehicule_image'] ?>" class="carImage" alt="">
                </div>
              </div>

              <div class="carInfosCont mb-3">
                <h5>Caractéristiques Techniques</h5>
                <div class="row carInfosSpecs mb-4">
                  <div class="col-sm-6 CarSpecsCol">
                    <!---------------------------------->
                    <div class="CarSpecs odd">
                      <span class="left lightmorecolor">
                        <i class="fas fa-car-side"></i>
                        Nombre de Portes
                      </span>
                      <span class="right">
                        <?php echo $row['nbr_portes']; ?>
                      </span>
                    </div>
                    <!---------------------------------->
                    <div class="CarSpecs even">
                      <span class="left lightmorecolor">
                        <i class="fas fa-tachometer-alt"></i>
                        Kilométrage
                      </span>
                      <span class="right">
                        <?php echo $row['kilometrage']; ?> km
                      </span>
                    </div>
                    <!---------------------------------->
                    <div class="CarSpecs odd">
                      <span class="left lightmorecolor">
                        <i class="fas fa-map-marked-alt"></i>
                        GPS
                      </span>
                      <span class="right">
                        <?php echo $row['gps']; ?>
                      </span>
                    </div>
                    <!---------------------------------->
                    <div class="CarSpecs even">
                      <span class="left lightmorecolor">
                        <i class="fas fa-cog"></i>
                        Boîte de vitesses
                      </span>
                      <span class="right">
                        <?php echo $row['boite_vitesse']; ?>
                      </span>
                    </div>
                  </div>
                  <!------------------------------------------------------------------>
                  <div class="col-sm-6 CarSpecsCol">
                    <div class="CarSpecs even">
                      <span class="left lightmorecolor">
                        <i class="fa fa-male"></i>
                        Nombre de Places
                      </span>
                      <span class="right">
                        <?php echo $row['nbr_places']; ?>
                      </span>
                    </div>
                    <!---------------------------------->
                    <div class="CarSpecs odd">
                      <span class="left lightmorecolor">
                        <i class="fas fa-gas-pump"></i>
                        Energie
                      </span>
                      <span class="right">
                        <?php echo $row['energie']; ?>
                      </span>
                    </div>
                    <!---------------------------------->
                    <div class="CarSpecs even">
                      <span class="left lightmorecolor">
                        <i class="fas fa-fan"></i>
                        Climatisation
                      </span>
                      <span class="right">
                        <?php echo $row['climat']; ?>
                      </span>
                    </div>
                    <!---------------------------------->
                    <div class="CarSpecs odd">
                      <span class="left lightmorecolor">
                        <i class="fas fa-tint"></i>
                        Couleur
                      </span>
                      <span class="right">
                        <?php echo $row['couleur']; ?>
                      </span>
                    </div>
                  </div>
                </div>

                <h5>Conditions de location Requises</h5>
                <!-----------------Car Conditions-------------------->
                <div class="row carConditions">
                  <div class="col-sm-6 ">
                    <div class="col-auto  m-1">
                      <i class="fas fa-check-circle"></i>18 ans au minimum
                    </div>
                    <div class="col-auto  m-1">
                      <i class="fas fa-check-circle"></i>Titulaire d'un permis depuis plus de 3 ans
                    </div>
                  </div>
                  <!--------------------------------------->
                  <div class="col-sm-6 ">
                    <div class="col-auto  m-1">
                      <i class="fas fa-check-circle"></i>Permis en cours de validité
                    </div>
                    <div class="col-auto  m-1">
                      <i class="fas fa-check-circle"></i>Usage du véhicule en Ville Local
                    </div>
                  </div>
                </div><!-----------End Car Conditions--------------->
              </div>
              <!-----------------Locataire Informations------------------->
              <div class="carLocataireCont">
                <h5>À propos du Locataire</h5>
                <div class="row g-2">
                  <div class="col-auto locatairePhoto">
                  <img src="../<?php echo $row['locataire_image']  ?>" alt="">
                  </div>
                  <div class="col locataireInfos">
                    <div class="name">
                      <?php
                        echo "<span>";
                        if($row['civilite'] == 'M') 
                          echo "Monsieur, ";
                        else 
                          echo "Madame, ";
                        echo "</span>";
                        echo ucfirst($row['nom']) . " " . ucfirst($row['prenom'])
                      ?>
                    </div>
                    <div class="ageVille">
                      <?php
                        echo $row['age'] . " ans de " . ucfirst($row['ville']);
                      ?>
                    </div>
                  </div>
                </div>
              </div><!-----------------End Locataire Informations------------------->
            </div><!---------------- End Car Column  -------------------->


            <!-----------------Car Price------------------->
            <div class="col-lg-4">
              <div class="carInfosPriceCont">
                <h4 class="carInfosPrice">
                  <span id="carPricePerDay"><?php echo $row['prix_j']; ?></span>
                  <p>MAD/Jour</p>
                </h4>
              </div>
              <div class="carDispoCatalogueCont mt-4">
                <h4> Le Catalogue de Disponibilité</h4>
                <div class="carDispoCatalogue">
                </div>
              </div>

              <div class="carInfosLocDateCont mt-4">
                <label for=""> Choisir La date de Debut et Fin de Location </label>
                <input id="datePicker" type="text" name="datefilter" maxlength="23" value="" placeholder=" [ Date debut - Date Fin ]"  readonly/>
                <span ><i class="fas fa-play animate__heartBeat animate__animated animate__infinite" title="Afficher le prix total du Voiture" onclick="getCarPrice()"></i></span>
              </div>

              <div class="carInfosFullPriceCont animate__animated animate__bounceIn ">
                <h4 class="carInfosPrice">
                  <span id="carPriceFull">

                  </span>
                  <span id="NbrJoursText">

                  </span>
                </h4>
              </div>
              <div class="carReserverBtnCont mt-3 animate__animated animate__bounceIn" >
                <button class="Reserver animate__pulse animate__animated animate__infinite" onclick="ReserverVoiture('<?php echo $vehicule_id ?>','<?php echo $_SESSION['id'] ?>')" >
                  Reserver
                </button>
              </div>
            </div><!-----------------End Car Price------------------->
          </div>
          <!---------------- End Car Row  -------------------->
      <?php
          }
        }
        else
        {

        }    
      } 
    }

    ?>
  </div>


  </main>
    <div>
      <!--------------Alert--------------->
      <div class="alert myAlert alert-danger alert-dismissible fade show mt-2 animate__animated animate__bounceIn LocCarALertWarning" role="alert">
        <i class="fas fa-exclamation-circle"></i>
        <strong>Attention: </strong><span class="LocCarALertWarningText"> </span>
        <button type="button" id="hideReservErrorAlert" class="btn-close"  aria-label="Close"></button>
      </div>
      <!--------------Alert--------------->
      <div class="alert myAlert alert-success alert-dismissible fade show mt-2 animate__animated animate__bounceIn LocCarALertSucces" role="alert">
        <i class="fas fa-exclamation-circle"></i>
        <strong>Felicitation: </strong> Reservation ajoutée avec succes
        <button type="button"  id="hideReservSuccessAlert"  class="btn-close"  aria-label="Close"></button>
      </div>
    </div>
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