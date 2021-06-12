<?php
require_once "scripts/connection.php";

session_start();
if( isset($_SESSION['user']) && !empty($_SESSION['user']) )
{
  header('Location: ./'.$_SESSION['user']);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Informations D'une Vehicule</title>

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">

  <!-- Animate .css-->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

  <!-- Bootstrap and style.css-->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/css/style.css" rel="stylesheet">
  
  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">

  <!---Font Awesome-->
  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />

  <!---------------jquery ------------>
  <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
  <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
  <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
  
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top">
    <div class="navCont container-fluid  d-flex justify-content-between">
      <h1 class="logo"><a href="index.php">LoCar</a></h1>
      <div class="col loCarLogoCont ">
        <img src="./assets/img/LoCarLogo.png" alt="">
      </div>
      <!-- Start navbar -->
      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="getstarted scrollto" href="locataireconnexion.php">Louer ma Voiture</a></li>
          <li><a class="nav-link scrollto" href="clientconnexion.php?Login=0">Inscription</a></li>
          <li><a class="nav-link scrollto" href="clientconnexion.php?Login=1">Connexion</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- End navbar -->
    </div>
  </header><!-- End Header -->

  <!-- ======= Hero Section ======= -->
  <section id="hero" class="align-items-center">
    <div class="row container-fluid voitureInfosTitle animate__animated animate__fadeInUp">
      <div class="col-ms-12 AcceuilTitle">
        <div class="row">
          <h1 class="">Voici la nouvelle manière de louer une voiture</h1>
          <h3 class="">Ensemble, nous améliorons la mobilité</h3>
        </div>
      </div>

    </div>
  </section><!-- End Hero -->


  <!------------------- Afficheg de list des voitures List  -------------------->
  <div class="container-sm carsRowContainer mt-5 ">
    <!---------------- Car Row  -------------------->

    <?php
    if (isset($_GET['id'])) 
    {
      $id = $_GET['id'];
      $afichageQueery = " select *
                          from vehicule v JOIN locataire l
                          using (locataire_id)
                          where v.vehicule_id = $id
                          and v.visibilite='Oui'";

      if ($tableContenu = $conn->query($afichageQueery)) 
      {
        if($tableContenu->num_rows != 0)
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
                  <img src="<?php echo $row['vehicule_image'] ?>" class="carImage" alt="">
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
                    <img src="<?php echo $row['locataire_image']; ?>" alt="locataire Photo">
                  </div>
                  <div class="col locataireInfos">
                    <div class="name">
                      <?php
                        echo "<span>";
                        if ($row['civilite'] == 'M') 
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

              <div class="carInfosLocDateCont mt-4">
                <label for=""> Choisir La date de Debut et Fin de Location </label>
                <input id="datePicker" type="text" name="datefilter" maxlength="23" value="" placeholder=" [ Date debut - Date Fin ]" readonly/>
                <span><i class="fas fa-play animate__heartBeat animate__animated animate__infinite" onclick="getCarPrice()"></i></span>
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
                <button class="Reserver animate__pulse animate__animated animate__infinite" onclick="window.location.href='./clientconnexion.php'" >
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
          header('Location: erreur/404.php');
      } 
      else
        header('Location: erreur/404.php');
    }
    else
      header('Location: erreur/404.php');
    ?>
  </div>
  <!------------------- End Affichage de list des voitures List  -------------------->

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
              <li><i class="fas fa-chevron-right"></i> <a href="./contact-us/">NOUS CONTACTER</a></li>
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

  <script>

  </script>

  <!-- Bootstrap js -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
  
  <script>
    $(function() {
    $('input[name="datefilter"]').daterangepicker({
      
        autoUpdateInput: false,
        locale: {
          cancelLabel: 'Clear'
        },
        "startDate": TodayDate(),
        "endDate": "05/25/2021",
        "minDate": TodayDate(),
        "maxDate": addDays(60)
      }, function(start, end, label) {
      console.log('New date range selected: ' + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD') + ' (predefined range: ' + label + ')');
      
      });
      
      $('input[name="datefilter"]').on('apply.daterangepicker', function(ev, picker) {
        $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));
      });

      $('input[name="datefilter"]').on('cancel.daterangepicker', function(ev, picker) {
        $(this).val('');
      });

    });


  </script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>
</html>