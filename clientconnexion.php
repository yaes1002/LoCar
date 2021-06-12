<?php
    
  session_start();
  if( isset($_SESSION['user']) && !empty($_SESSION['user']) )
  {
    header('Location: ./'.$_SESSION['user']);
  }
  
  //$Login = 0 Pour afficher le <form> d'inscription au debut 
  $Login = 0;
  if (isset($_GET['Login']))
    $Login = $_GET['Login'];

  //Valeur par defaut et 4 pour ne pas afficher un alert
  $NoticeMsgS = 4;
  if(isset($_GET['NoticeS']))
  {
    $NoticeMsgS = $_GET['NoticeS'];
    // $NoticeMsgS = 0 : insertion avec succes dans la base
    // $NoticeMsgS = 1 : email deja exist dans la base
    // $NoticeMsgS = 2 : Num de Telephone deja exist dans la base
    // $NoticeMsgS = 3 : email et tel n'exist pas mais on a un erreur au moment de l'insertion dans la base
  }

  $NoticeMsgL = 0;
  if(isset($_GET['NoticeL']))
  {
    $NoticeMsgL = $_GET['NoticeL'];
    // $NoticeMsgL = 1 : Email ou Mot de passe Incorrecte
    // $NoticeMsgL = 2 : Email ou Mot de passe ou les deux sont vide
  }

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Client</title>

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">

  <!-- Animate .css-->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

  <!-- Bootstrap and style.css-->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/css/style.css" rel="stylesheet">

  <!--FOnt Awesome -->
  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />

</head>

<body class="loginBody ">

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top">
    <div class="navCont container-fluid  d-flex justify-content-between">
      <h1 class="logo"><a href="index.php">LoCar</a></h1>
      <div class="col loCarLogoCont paddLoCarLogoCont">
        <img src="./assets/img/LoCarLogo.png" alt="">
      </div>
    </div>
    
  </header><!-- End Header -->
  <main id="main">
    <!-------------------------------------------------------------------->
    <div class="container EspaceHeader">
      <h2 class=" animate__animated animate__pulse animate__infinite">Espace Client</h2>
    </div>
    <div class="container LoginContainer LoginContainerClient">
      <div class="row justify-content-center  animate__animated animate__fadeIn">
        <div class="col-lg-6 d-none d-lg-block bg-login-image imgLogin"></div>
        <div class="col-lg-6">
          <div class="row justify-content-end LoginAreaCont ">
            <div class="col-xs-6 col-sm-6-Modified col-lg-6 loginAreaBtn <?php if ($Login == 0)  echo 'ShadowedAreaBtn'; ?> " onclick="ShowLogin();">LOGIN</div>
            <div class="col-xs-6 col-sm-6-Modified col-lg-6  signUpAreaBtn <?php if ($Login == 1)  echo 'ShadowedAreaBtn'; ?>" onclick="ShowSignUp();">SIGN UP</div>
          </div>
          <div class="row">
            <div class="FormContainer animate__animated animate__fadeIn">
              <!-----------------------------------Login Form------------------------------------------>
              <form action="./scripts/login.php" method="POST" class="LoginForm <?php if ($Login == 0)  echo 'hideForm'; ?> ">
                <h4 class="Welcome">Bonjour</h4>
                <div class="mb-3">
                  <input type="email" name="email" class="form-control loginInput" id="loginInputEmail" placeholder="Adresse E-mail" >
                </div>
                <div class="mb-3">
                  <input type="password" name="mot_de_passe" class="form-control loginInput" id="loginInputPassword" placeholder="Mot De Passe" >
                </div>
                <button type="submit" class="loginSubmit">Connexion</button>
                <!----------------Test Login Erreur Msg --------------------->
                <?php
                  if($NoticeMsgL == 1)
                  {
                    ?>
                      <div class="alert myAlert alert-danger alert-dismissible fade show alertMsgBox mt-2" role="alert">
                        <i class="fas fa-times-circle"></i>
                        <strong>Attention: </strong> Email ou Mot de passe Incorrecte
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>
                    <?php
                  }
                  else if($NoticeMsgL == 2)
                  {
                    ?>
                      <div class="alert myAlert alert-danger alert-dismissible fade show alertMsgBox mt-2" role="alert">
                        <i class="fas fa-times-circle"></i>
                        <strong>Attention: </strong> Email Et Mot de passe Sont Obligatoire
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>
                    <?php
                  }
                ?>
                <!---------------- Fin Test Login Erreur Msg --------------------->
              </form>
              <!-----------------------------------Sign Up form----------------------------------------->
              <form action="./scripts/insertclient.php" method="POST" class="signUpForm <?php if ($Login == 1)  echo 'hideForm'; ?>">
                <h4 class="CreateAccount">Créer Un Compte</h4>
                <div class="row form-group mb-3">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="text" name="nom" class="form-control signUpInput" id="FirstName" placeholder="Nom"  maxlength="20" required>
                  </div>
                  <div class="col-sm-6">
                    <input type="text" name="prenom" class="form-control signUpInput" id="LastName" placeholder="Prenom"  maxlength="20" required>
                  </div>
                </div>

                <div class="mb-3 input-group">
                  <label for="inputTel" class="input-group-text telPrefix">+212 </label>
                  <input type="tel" name="tel" class="form-control signUpInput" id="inputTel" pattern="[6-7][0-9]{8}" placeholder="Num De Tel: 666-666666" maxlength="9" required>
                </div>
                <div class="mb-3 input-group">
                  <select class="form-select gender" name="civilite" required>
                    <option value="" >Civilité</option>
                    <option value="M">Monsieur</option>
                    <option value="F">Madame</option>
                  </select>
                  <input type="number" name="age" class="form-control signUpInput" id="inputAge" placeholder="Age" min="18" max="100" required>
                </div>

                <div class="mb-3">
                  <input type="email" name="email" class="form-control signUpInput" id="inputEmail" pattern="^[a-zA-Z0-9]{2,10}[-|_]?[a-zA-Z0-9]{2,10}@[a-z]+\.[a-z]{2,5}$"  maxlength="35" placeholder="Adresse E-mail" required>
                </div>
                <div class="mb-3">
                  <input type="password" name="mot_de_passe" class="form-control signUpInput" id="inputPassword" minlength="8"  maxlength="40" placeholder="Mot De Passe (min 8 caracters)" required>
                </div>

                <button type="submit" class="SignUpSubmit">Inscription</button>
                <!----------------------------------------------------------------------------------------->
                 <!----------------Test Sign up Erreur Msg --------------------->
                 <?php
                  if($NoticeMsgS == 0)
                  {
                    ?>
                      <div class="alert myAlert alert-success alert-dismissible fade show alertMsgBox mt-2" role="alert">
                        <i class="fas fa-check-circle"></i>
                        <strong>Felicitaion: </strong> votre compte a été créé avec succès
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>
                    <?php
                  }
                  else if($NoticeMsgS == 1)
                  {
                    ?>
                      <div class="alert myAlert alert-warning alert-dismissible fade show alertMsgBox mt-2" role="alert">
                      <i class="fas fa-exclamation-circle"></i>
                        <strong>Attention: </strong> On a deja un Compte créé avec cette adresse Mail
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>
                    <?php
                  } 
                  else if($NoticeMsgS == 2)
                  {
                    ?>
                      <div class="alert myAlert alert-warning alert-dismissible fade show alertMsgBox mt-2" role="alert">
                      <i class="fas fa-exclamation-circle"></i>
                        <strong>Attention: </strong> On a deja un Compte créé avec ce Num de Telephone
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>
                    <?php
                  } 
                  else if($NoticeMsgS == 3)
                  {
                    ?>
                      <div class="alert myAlert alert-danger alert-dismissible fade show alertMsgBox mt-2" role="alert">
                        <i class="fas fa-times-circle"></i>
                        <strong>Attention: </strong> Une Erreur au moment de la creation du Compte
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

  <!-- BOotstrap js -->
  <script src="assets/vendor/bootstrap/js/bootstrap.min.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>
</body>
</html>

