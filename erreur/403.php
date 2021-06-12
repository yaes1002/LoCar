
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Client</title>

  <!-- Favicons -->
  <link href="../assets/img/favicon.png" rel="icon">

  <!-- Animate .css-->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

  <!---boxicons---->
  <link href='https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css' rel='stylesheet'>

  <!-- Bootstrap and style.css-->
  <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../assets/css/style.css" rel="stylesheet">

  <!--FOnt Awesome -->
  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />



</head>

<body class="loginBody ">

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

    <div class="ErrorCont ">
      <div class="contaner errorCont  animate__animated animate__pulse animate__infinite">
        <img class="errorImage" src="../assets/img/Error/403.png" alt="">
      </div>
      <div class="returnBtnCont animate__animated animate__pulse animate__infinite ">
        <div>
          Vous n'avez pas le droit d'accéder à cette page.
        </div>
        <div>
          <a  class="returnBtn" href="../"><i class='bx bxs-left-arrow-alt'></i>Retour</a>
        </div>
      </div>

    </div>
    
  </main><!--------------- End Main ------------->

 <!-------------------- Footer -------------------->
   <footer id="footer" style="display:none">
      <div class="footer-top errorPageFooter">
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

  <div id="preloader"></div>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="fas fa-arrow-up"></i></a>

  <!-- BOotstrap js -->
  <script src="../assets/vendor/bootstrap/js/bootstrap.min.js"></script>

  <!-- Template Main JS File -->
  <script src="../assets/js/main.js"></script>
</body>
</html>

