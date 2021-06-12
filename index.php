<?php

require_once "./scripts/connection.php";

session_start();
if( isset($_SESSION['user']) && !empty($_SESSION['user']) )
{
  header('Location: ./'.$_SESSION['user']);
};

header('Cache-Control: no-cache, must-realidate');

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>LoCar</title>

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <meta http-equiv=”refresh” content=”60;write_the_url_of_the_page_to_be_tested_over_here.html” />

  <!-- Animate .css-->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

  <!-- Bootstrap and style.css-->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/css/style.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
  
  <!---Font Awesome-->
  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />

  <!-----Jquery---->
  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
  <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
  <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
  <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

</head>
<body onload="setTodayDate()">

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top animate__animated animate__fadeIn">
    <div class="navCont container-fluid  d-flex justify-content-between">
      <h1 class="logo"><a href="index.php">LoCar</a></h1>
      
      <div class="col loCarLogoCont">
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
    <div class="row container-fluid animate__animated animate__fadeInUp">
      <div class="col-md-12  col-lg-6 AcceuilTitle">
        <div class="row">
          <h1 class="">Voici la nouvelle manière de louer une voiture</h1>
          <h3 class="">Ensemble, nous améliorons la mobilité</h3>
        </div>
      </div>
      <div class="col-md-12 col-lg-6 FrontImgCont">
        <img class="FrontImg" src="./assets/img/FrontImg.png" alt="">
      </div>
    </div>
  </section><!-- End Hero -->

  <!-------------------------- Main ------------------------------------------>
  <main class="main">
    <div class="container-sm animate__animated animate__fadeIn ">
        <form class="searchform searchContainer" action="<?php echo $_SERVER["PHP_SELF"];?>" method="POST">
          <div class="row g-2">
            <div class="col-lg-4 InputCont">
              <div class="input-group">
                <label for="SelectVille" class="SearchLabel">Ville de Prise de Vehicule</label>
                <select class="form-select selectVille" id="SelectVille" name="ville" aria-label="Floating label select example">
                  <option class="" value="maroc">Tout le Maroc</option>
                  <option class="boldVille" value="Casablanca">Casablanca</option>
                  <option class="boldVille" value="Rabat">Rabat</option>
                  <option class="boldVille" value="Tanger">Tanger</option>
                  <option class="boldVille" value="Fes">Fes</option>
                  <option class="boldVille" value="Marrakech">Marrakech</option>
                  <option class="boldVille" value="Agadir">Agadir</option>
                  <option class="boldVille" value="El jadida">El jadida</option>
                  <option class="boldVille" value="Safi">Safi</option>
                  <option class="boldVille" value="Tetouan">Tetouan</option>
                  <option class="boldVille" value="Oujda">Oujda</option>
                  <option value="Al Hoceima">Al Hoceima</option>
                  <option value="Arfoud">Arfoud</option>
                  <option value="Assilah">Assilah</option>
                  <option value="Azrou">Azrou</option>
                  <option value="Beni mellal">Beni mellal</option>
                  <option value="Berkane">Berkane</option>
                  <option value="Berrechid">Berrechid</option>
                  <option value="Bouskoura">Bouskoura</option>
                  <option value="Bouznika">Bouznika</option>
                  <option value="Chafchaouen">Chafchaouen</option>
                  <option value="Dakhla">Dakhla</option>
                  <option value="El Kelaa des Sraghna">El Kelaa des Sraghna</option>
                  <option value="Errachidia">Errachidia</option>
                  <option value="Fnideq">Fnideq</option>
                  <option value="Ifrane">Ifrane</option>
                  <option value="Kenitra">Kenitra</option>
                  <option value="Khenifra">Khenifra</option>
                  <option value="Khmissat">Khmissat</option>
                  <option value="Khouribga">Khouribga</option>
                  <option value="Laayoune">Laayoune</option>
                  <option value="Larache">Larache</option>
                  <option value="Martil">Martil</option>
                  <option value="MDiq">M'Diq</option>
                  <option value="Meknes">Meknes</option>
                  <option value="Mohammedia">Mohammedia</option>
                  <option value="Oualidia">Oualidia</option>
                  <option value="Ouarzazate">Ouarzazate</option>
                  <option value="Oued Zem">Oued Zem</option>
                  <option value="Saidia">Saidia</option>
                  <option value="Sale">Sale</option>
                  <option value="Sefrou">Sefrou</option>
                  <option value="Settat">Settat</option>
                  <option value="Skhirate">Skhirate</option>
                  <option value="Tantan">Tantan</option>
                  <option value="Taroudannt">Taroudannt</option>
                  <option value="Tata">Tata</option>
                  <option value="Temara">Temara</option>
                  <option value="Youssoufia">Youssoufia</option>
                </select>
              </div>
            </div>
            
            <div class="col-lg InputCont">
              <div class="col-auto input-group date" data-provide="datepicker" >
                <label for="dateDebut" class="SearchLabel"> Debut de Location </label>
                <input  id="dateDebut" type="date" class="form-control dateLoc"  onchange="setMinMaxDate()" >
                <div class="input-group-addon">
                  <span class="glyphicon glyphicon-th"></span>
                </div>
              </div>
            </div>

            <div class="col-lg InputCont">
              <div class="col-auto input-group date" data-provide="datepicker">
                <label for="dateFin" class="SearchLabel"> Fin de Location </label>
                <input id="dateFin" type="date" class="form-control dateLoc"  onchange="setMinMaxDate()">
                <div class="input-group-addon">
                  <span class="glyphicon glyphicon-th"></span>
                </div>
              </div>
            </div>
            
            <!--
                <div class="col-lg-6 ">
                    <div class="form-floating ">
                        <input type="text" class="form-control " id="floatingInputGrid" placeholder="Ford" >
                        <label for="floatingInputGrid">Marque De Voiture</label>
                    </div>
                </div>
                -->
            <div class="col-lg-auto col-sm-12 SearchCarBtnCont ">
              <input type="submit" class="SearchCarBtn" value="Rechercher">
            </div>
          </div>
        </form>
    </div>
    <!------------ End Main ------------>

    <!------------------- Afficheg de list des voitures List  -------------------->
    <div class="container-sm carsRowContainer mt-0 ">
      <?php
      $afichageQueery = "select v.vehicule_id,v.marque,v.modele,v.prix_j,v.nbr_portes,v.nbr_places,v.climat,v.vehicule_image,l.ville
                          from vehicule v JOIN locataire l
                          using (locataire_id)
                          where v.visibilite='Oui'";
      if (isset($_POST['ville'])) 
      {
        $ville = strtolower($_POST['ville']);
        if ($ville != 'maroc')
            $afichageQueery = " select v.vehicule_id,v.marque,v.modele,v.prix_j,v.nbr_portes,v.nbr_places,v.climat,v.vehicule_image,l.ville
                                from vehicule v JOIN locataire l
                                using (locataire_id)
                                where l.ville = '$ville' 
                                and v.visibilite='Oui';";
      }

      if ($tableContenu = $conn->query($afichageQueery)) {
        $i = 0;
        foreach ($tableContenu  as  $value) $i++;
      }

      ?>
      <!---------------- Car Row  -------------------->
      <div class="nbrRow"><i><i class="fas fa-stream"></i><?php echo "Nombre de Voitures trouvée : " . $i;  ?> </i></div>
      <div class="row g-3">
        <?php

        if ($tableContenu = $conn->query($afichageQueery)) 
        {
            while ($row = $tableContenu->fetch_assoc()) 
            {

        ?>
            <!---------------- Car Column  -------------------->

            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 carContainer" onclick="CarInfosRedirect('<?php echo $row['vehicule_id'] ?>');">
              <div class="row carImageCont">
                <img src="<?php echo $row['vehicule_image'] ?>" class="carImage" alt="">
              </div>

              <div class="row">
                <div class="row">
                  <h4 class="carTitle col-8"> <?php echo ucfirst($row['marque']) . " " . ucfirst($row['modele']); ?> <br>
                    <span class="carVille">
                      <i class="fas fa-map-marker-alt"></i> <?php echo ucfirst($row['ville']); ?>
                    </span>
                  </h4>
                    <h4 class="carPrice offset-0 col-4 order-last"><?php echo $row['prix_j']; ?> <p>MAD/Jour</p>
                  </h4>
                </div>
                <div class="carSpecs">
                  <ul class="row carSpecsList justify-content-center mb-0">
                    <!----------------------------------------------->
                    <li class="col-auto  m-1" title="Nombre de Portes">
                      <i class="fas fa-car-side"></i>
                    </li>
                    <li class="col-auto ">x <?php echo $row['nbr_portes']; ?></li>
                    <!----------------------------------------------->
                    <li class="col-auto m-1" title="Nombre de Places">
                      <i class="fa fa-male"></i>
                    </li>
                    <li class="col-auto">x <?php echo $row['nbr_places']; ?></li>
                    <!----------------------------------------------->
                    <li class="col-auto  m-1" title="Climatisation">
                      <i class="fas fa-fan"></i>
                    </li>
                    <li class="col-auto"><?php echo $row['climat']; ?></li>
                  </ul>
                </div>
              </div>
            </div>
            <!---------------- End Car Column  -------------------->

        <?php
            }
        }
        ?>

      </div>
      <!---------------- End Car Row  -------------------->
    </div>
    <!------------------- End Affichage de list des voitures List  -------------------->
  </main><!-- End #main -->

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
                <li><i class="fas fa-chevron-right"></i> <a href="contact-us/">CONTACTEZ NOUS</a></li>
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
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>
</body>
</html>

