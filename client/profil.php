<?php
  require_once "../scripts/connection.php";
  
  header('Cache-Control: no-cache, must-realidate');
  session_start();
  if( !isset($_SESSION['user']) || $_SESSION['user'] != 'client' )
  {
    header('Location: ../');
  }

  $NoticeMsg = 2;
  if(isset($_GET['Notice'])  )
  {
    $NoticeMsg =$_GET['Notice'];
  }

  $NpassMsg = 3;
  if(isset($_GET['Npass'])  )
  {
    $NpassMsg =$_GET['Npass'];
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
<body onload="InitialiseProfilePage('<?php echo $_SESSION['id']?>','<?php echo $_SESSION['user'] ?>')">

  <!-------------------Header --------------------->
  <header class="header" id="headerBar" >
    <div class="headerToggle">
      <i class='bx bx-menu' id="header-toggle"></i>
    </div>
    <div class="headerNameImg">
      <span class="HeaderNom">
      </span>
      <img id="ProfileAvatar" class="dropdown-toggle" alt="profilePic" onclick="ShowDropMenu()">
      
      <ul id="dropMenu" class="dropdown-menu animate__animated animate__bounceIn" >
        <li><a class="dropdown-item" href=""><i class='bx bx-user-circle'></i>Profile</a></li>
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
        <div class="nav__list">
          <a href="./" class="navLink">
            <i class='bx bx-grid-alt nav__icon'></i>
            <span class="nav__name">Accueil</span>
          </a>
          <a href="" class="navLink active">
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
            <h1 class="VoitureTitle">Mon Profil</h1>
          </div>
        </div>
      </div>
    </section><!------------------ End Hero -------------------->

    <div class="row container-fluid ConOfConProfile">
      <div class="ProfileFormLabels col-sm-3 animate__animated animate__fadeInUp ">
        <div class="ProfileBtn" onclick="AfficheProfileForm(1)"><i class="fas fa-chevron-right"></i>Modifier mon Profil</div>
        <div class="ParameterBtn hideBtn" onclick="AfficheProfileForm(2)"><i class="fas fa-chevron-right"></i>Paramètres du Compte</div>
      </div>
      <div class="container VoitureTableCont ProfilFormCont col animate__animated  animate__fadeIn">
        <!-------------------- Informarions -------------------->
        <div class="card mb-4 " id="infos"> 
          <div class="card-header ">
          <h4 class="">Modifier vos information </h4> 
          </div>
          <div class="table-responsive">
            <div class="card-body">       
              <form action="./scripts/profilmodif.php" method="POST" class="signUpForm profileForm "   enctype="multipart/form-data">
                <input type="hidden" name="client_id" value="<?php echo $_SESSION['id'] ?>"  >
                <div class="mb-3 input-group ProfilImageCont">
                  <label title="C'est Mieux d'utiliser une image avec un resolution 1x1">
                    <input type="file" name="client_image" class="ProfilImageSrc" class="form-control TableFormInput"  accept="image/png, image/jpeg, image/jpg, image/gif" onchange="showProfilImgModif()"  >
                    <img id="ProfilImageModif" src="" alt="profileImage">
                    <div class="overlay">
                      <div class="text"><i class='bx bx-upload'></i></div>
                    </div>
                  </label>
                </div>
                <div class="row form-group mb-3">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <label for="FirstName" class="ProfileLabel"> Nom </label>
                    <input type="text" name="nom" class="form-control signUpInput" id="FirstName" placeholder="Nom" maxlength="20" value="" required>
                  </div>
                  <div class="col-sm-6">
                    <label for="LastName" class="ProfileLabel"> Prenom </label>
                    <input type="text"  name="prenom" class="form-control signUpInput" id="LastName" placeholder="Prenom" maxlength="20" value=""  required>
                  </div>
                </div>

                
                <div class="row form-group mb-3">
                  
                  <div class=" col-sm-6" >
                    <label for="inputAge" class="ProfileLabel"> Age </label>
                    <input type="number" name="age"  class="form-control signUpInput" id="inputAge" placeholder="Age" min="18" max="100" value=""  required>
                  </div>
                  <div class=" col-sm-6 " >
                    <label for="SelectCivilite" class="ProfileLabel"> Civilité </label>
                    <select class="form-select gender selectPadd" id="SelectCivilite" name="civilite" required>
                      <option value="">Civilité</option>
                      <option value="M">Monsieur</option>
                      <option value="F">Madame</option>
                    </select>
                  </div>
                </div>


                <div class="row form-group mb-3">
                  <div class=" col-sm-6 " >
                    <label for="inputTel" class="ProfileLabel NumTelProfile">Numéro du Téléphone </label>
                    <div class=" input-group">
                      <label for="inputTel" class="input-group-text telPrefix">+212 </label>
                      <input type="tel" name="tel" class="form-control signUpInput" id="inputTel" pattern="[6-7][0-9]{8}" placeholder="Num De Tel: 666-666666" value=""   required>
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <label for="Cin" class="ProfileLabel"> Cin </label>
                    <input type="text" name="cin" class="form-control signUpInput" id="Cin" maxlength="20" placeholder="Cin" value=""  >
                  </div>
                </div>

                <div class="row form-group mb-3">
                  <div class=" col-sm-6">
                    <label for="SelectVille" class="ProfileLabel"> Ville </label>
                    <select class="form-select gender selectPadd" id="SelectVille" name="ville" aria-label="Floating label select example" required >
                      <option class="" value="">Ville</option>
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
                  <div class="col-sm-6">
                    <label for="inputZip" class="ProfileLabel"> Code Postal </label>
                    <input type="number" name="code_postal" class="form-control signUpInput" id="inputZip" maxlength="5" min="10000" placeholder="Code Postal" value="" required  >
                  </div>
                </div>

                <div class="mb-3">
                  <label for="inputAdresse" class="ProfileLabel"> Adresse </label>
                  <input type="text" name="adresse" class="form-control signUpInput" id="inputAdresse" maxlength="100" placeholder="Adresse" value=""  >
                </div>
                <div class="mb-4">
                  <label for="inputEmail" class="ProfileLabel"> Adresse Mail </label>
                  <input type="email" name="email" class="form-control signUpInput" id="inputEmail" pattern="^[a-zA-Z0-9]{2,10}[-|_]?[a-zA-Z0-9]{2,10}@[a-z]+\.[a-z]{2,5}$" maxlength="35" placeholder="Adresse E-mail" value=""  required>
                </div>

                <div class="row form-group mb-3 mt-5">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <button type="button" class="TableFormReset" onClick="window.location.href='profil.php'">Annuler</button>
                  </div>
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <button type="submit" class="TableFormSubmit" >Mettre a jour mon Profile</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
        <!-------------------- Parameters -------------------->
        <div class="card mb-5 hideProfile" id="param"> 
          <div class="card-header ">
          <h4 class="">Modifier Le mot de passe </h4> 
          </div>
          <div class="table-responsive">
            <div class="card-body">
                    
              <form action="./scripts/profilmodifpassword.php" method="POST" class="signUpForm profileForm"   enctype="multipart/form-data">
                <input type="hidden" name="client_id" value="<?php echo $_SESSION['id'] ?>"  >

                <div class="mb-3">
                  <label for="ancienPassword" class="ProfileLabel"> Ancien mot de passe </label>
                  <input type="password" name="ancienmdp" class="form-control signUpInput" id="ancienPassword" maxlength="40" placeholder=""  required>
                </div>
                <div class="row form-group mb-3">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <label for="NvPassword" class="ProfileLabel"> Nouveau mot de passe  </label>
                    <input type="password" name="nouveaumdp" class="form-control signUpInput" id="NvPassword" minlength="8" maxlength="40" placeholder="" required>
                  </div>
                  <div class="col-sm-6">
                    <label for="ConfNvPassword" class="ProfileLabel"> Confirmation  </label>
                    <input type="password"  name="confirmmdp" class="form-control signUpInput" id="ConfirmPassword" minlength="8" maxlength="40" placeholder=""  required>
                  </div>
                </div>

                <div class="row form-group mb-3 mt-4">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <button type="button" class="TableFormReset" onClick="window.location.href='profil.php'">Annuler</button>
                  </div>
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <button type="submit" class="TableFormSubmit" >Enregistrer</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>  
    
  </main><!-------------------End  main -------------------->
  

  <!-------------------- Modal -------------------->
  <div class="blackBlurBackground hideCont main"></div>

  <!-------------------- Modal -------------------->
  <div>
    <?php
      if($NoticeMsg == 0)
      {
        ?>
          <div class="alert myAlert alert-success alert-dismissible fade show profileALert mt-2 animate__animated animate__bounceIn" role="alert">
            <i class="fas fa-check-circle"></i>
            <strong>Felicitaion: </strong> Modification avec Succès
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        <?php
      }
      else if($NoticeMsg == 1)
      {
        ?>
          <div class="alert myAlert alert-danger alert-dismissible fade show profileALert mt-2 animate__animated animate__bounceIn" role="alert">
          <i class="fas fa-exclamation-circle"></i>
            <strong>Attention: </strong> Erreur Au moment de La Modifcation
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        <?php
      } 

      if($NpassMsg == 0)
      {
        ?>
          <div class="alert myAlert alert-success alert-dismissible fade show profileALert mt-2 animate__animated animate__bounceIn" role="alert">
            <i class="fas fa-check-circle"></i>
            <strong>Felicitaion: </strong> Mot de passe Modifié 
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        <?php
      }
      else if($NpassMsg == 1)
      {
        ?>
          <div class="alert myAlert alert-danger alert-dismissible fade show profileALert mt-2 animate__animated animate__bounceIn" role="alert">
          <i class="fas fa-exclamation-circle"></i>
            <strong>Attention: </strong> Les mots de ne passe sont pas Identiques
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        <?php
      } 
      else if($NpassMsg == 2)
      {
        ?>
          <div class="alert myAlert alert-danger alert-dismissible fade show profileALert mt-2 animate__animated animate__bounceIn" role="alert">
          <i class="fas fa-exclamation-circle"></i>
            <strong>Attention: </strong> Mot de passe Incorrect
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        <?php
      } 

      ?>
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
