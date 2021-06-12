<?php
  require_once "../scripts/connection.php";
  session_start();
  if( !isset($_SESSION['user']) || $_SESSION['user'] != 'locataire' )
  {
    header('Location: ../');
  }

?>

<!DOCTYPE html>
<html lang="fr">

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
<body onload="InitialiseNumberResults(),GetAvatarPic('<?php echo $_SESSION['id']?>','<?php echo $_SESSION['user'] ?>')">

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
        <div class="nav__list">
          <a href="./" class="navLink">
            <i class='bx bx-grid-alt nav__icon'></i>
            <span class="nav__name">Accueil</span>
          </a>
          <a href="profil.php" class="navLink">
            <i class='bx bx-user nav__icon'></i>
            <span class="nav__name">Profil</span>
          </a>
          <a href="" class="navLink active">
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
            <h1 class="VoitureTitle">Gestion des Reservations</h1>
            
          </div>
        </div>
      </div>
    </section><!------------------ End Hero -------------------->

    <div class="container VoitureTableCont ">
      <div class="card mb-4"> 
        <div class="card-header ">
          <div class="col-9">
            <div class="searchCont row">
              <div class="col-5">
                <input class="form-control searchInput " type="text" id="searchInput" onkeyup="FilterVoitureResult()">
              </div>
              <div class="col searchRes">
                <i class='bx bx-search-alt-2'></i>
                <span >  
                  <i class="fas fa-stream"></i>Reservation trouvée : <span class="searchNumberRes"></span> 
                </span>
              </div>
            </div>
          </div>
          <div class="col-3">
            <div class="plusCont">
             
            </div>
          </div>   
        </div>
        <div class="table-responsive">
          <div class="card-body" id="ReservCardBody">
            <table id="voituresTable" class="w3-table-all ReservationsTable">
              <thead>
                <tr>
                  <th onclick="showArrow(0)">Id<i class='bx bxs-sort-alt hideArrow'></i></th>
                  <th onclick="showArrow(1)">Voiture<i class='bx bxs-sort-alt hideArrow'></i></th>
                  <th class="prixt" onclick="showArrow(2)">Prix Total<i class='bx bxs-sort-alt hideArrow'></i></th>
                  <th onclick="showArrow(3)">Debut<i class='bx bxs-sort-alt hideArrow'></i></th>
                  <th onclick="showArrow(4)">Fin<i class='bx bxs-sort-alt hideArrow'></i></th>
                  <th onclick="showArrow(5)">Creation<i class='bx bxs-sort-alt hideArrow'></i></th>
                  <th class="etat" onclick="showArrow(6)">Etat<i class='bx bxs-sort-alt hideArrow'></i></th>
                  <th  class="action">Action<i class='bx bxs-sort-alt hideArrow'></i></th>
                </tr>
              </thead>
              <tbody class="tbody">
              <?php 
                $locataire_id = $_SESSION['id'];
                $reservationAffichageQueery = " select *,(date_fin - date_debut)*prix_j prixT
                                                from reservation join vehicule
                                                using (vehicule_id)
                                                where locataire_id = $locataire_id
                                                and visibilite = 'Oui'
                                                and etat not in ('Refuse','Annule')
                                                order by etat;";

                if ($tableContenu = $conn->query($reservationAffichageQueery)) 
                {
                  while ($row = $tableContenu->fetch_assoc()) 
                  {
              ?>
                <tr class="item">
                  <td> <?php echo "".$row['reservation_id']?></td>
                  <td> <?php echo ucwords($row['marque']." ".$row['modele'])?></td>
                  <td class="prixt"> <?php echo $row['prixT'].' MAD'?></td>
                  <td> <?php echo $row['date_debut']?></td>
                  <td> <?php echo $row['date_fin']?></td>
                  <td> <?php echo $row['date_creation']?></td>
                  <td class="etat"> 
                      <?php 
                        switch($row['etat']) 
                        {
                          case "En attente":
                            ?>
                              <span class="EtatIcon AttenteIcon" title="En Attente">  
                                <i class="fas fa-clock" ></i>
                              </span> 
                              <span class="abbr">E</span>
                            <?php
                          break;
                          case "Accepte":
                            ?>
                              <span class="EtatIcon AccepteIcon" title="Accepté">  
                                <i class="fas fa-check-circle"></i>
                              </span>
                              <span class="abbr">A</span> 
                            <?php
                          break;
                        }
                      ?>
                  </td>
                  <td class="action"> 
                    <i class="fad fa-search ActionIcon Afficher" title="Afficher plus d'informations" onclick="AfficherInfosClick('<?php echo $row['reservation_id']  ?>')" ></i>
                    <?php
                    if($row['etat']=='En attente')
                    {
                      ?>
                        <i class="fas fa-check ActionIcon Accepter"  onclick="AcceptReserv('<?php echo $row['reservation_id']  ?>','<?php echo $locataire_id  ?>'),AccepterClick()" title="Accepter"></i>
                        <i class="fad fa-times ActionIcon Refuser" onclick="RefuseReserv('<?php echo $row['reservation_id']  ?>','<?php echo $locataire_id  ?>'),refuserClick()"  title="Refuser"></i>
                      <?php
                    }
                    ?>
                  </td>
                </tr> 
              <?php
                  }
                }
                else
                {
                  echo "Erreur";
                }
              ?>
              </tbody>   
            </table>
          </div>
        </div>
      </div>
    </div>
  </main><!-------------------End  main -------------------->
  


  <!-------------------- Form Ajout Modification -------------------->
  <div class="container-fluid blurBackground hideCont animate__animated  " >
    <div class="row flexRow">
      <div class="TableFormCont animate__animated animate__bounceIn">
        <i class="fas fa-times closeTableForm" id="CloseFormIcon"></i>
        <!-------------------- Form Plus d'informations -------------------->        
        <form id="PlusInfosForm" method="POST" class="signUpForm hideCont"  enctype="multipart/form-data">
          <h4 class="TableFormTitle"> Plus d'information sur la reservation </h4> 
          
          <div class=" input-group suppQuestion">
          </div>

          <fieldset>
            <legend>Client</legend>
            <div class="row form-group mb-2">
              <div class="col-sm-4 mb-3 mb-sm-0">
                <label for="nom" class="ProfileLabel"> Nom </label>
                <input type="text"  class="form-control Reservationinput" id="nom" readonly >
              </div>
              <div class="col-sm-4">
                <label for="prenom" class="ProfileLabel"> Prenom </label>
                <input type="text" class="form-control Reservationinput" id="prenom" readonly>
              </div>
              <div class="col-sm-4">
                <label for="age" class="ProfileLabel"> Age </label>
                <input type="text"  class="form-control Reservationinput" id="age"  readonly>
              </div>
            </div>
          
            <div class="row form-group mb-4 TelContCont">
              <div class="col-sm-6 mb-3 mb-sm-0">
                <label for="civilite" class="ProfileLabel"> Civilite </label>
                <input type="text"  class="form-control Reservationinput" id="civilite" readonly >
              </div>
              <div class="col-sm-6">
                <label for="ville" class="ProfileLabel"> Ville </label>
                <input type="text"  class="form-control Reservationinput" id="ville" readonly>
              </div>
              
            </div>
          </fieldset>
         
          
          <fieldset>
            <legend>Voiture</legend>
            <div class="row form-group mb-4">
              <div class="col-sm-4 mb-3 mb-sm-0">
                <label for="marque" class="ProfileLabel"> Marque </label>
                <input type="text"  class="form-control Reservationinput" id="marque" readonly >
              </div>
              <div class="col-sm-4">
                <label for="modele" class="ProfileLabel"> Modele </label>
                <input type="text" class="form-control Reservationinput" id="modele" readonly>
              </div>
              <div class="col-sm-4">
                <label for="annee" class="ProfileLabel"> Annee </label>
                <input type="text"  class="form-control Reservationinput" id="annee"  readonly>
              </div>
            </div>
          </fieldset>

          <fieldset>
            <legend>Reservation</legend>
            <div class="row form-group mb-4">
              <div class="col-sm-4 mb-3 mb-sm-0">
                <label for="date_fin" class="ProfileLabel"> Date Debut </label>
                <input type="text"  class="form-control Reservationinput" id="date_debut" readonly >
              </div>
              <div class="col-sm-4">
                <label for="modele" class="ProfileLabel"> Date Fin </label>
                <input type="text" class="form-control Reservationinput" id="date_fin" readonly>
              </div>
              <div class="col-sm-4">
                <label for="date_creation" class="ProfileLabel"> Date Creation </label>
                <input type="text"  class="form-control Reservationinput" id="date_creation"  readonly>
              </div>
              <div class="col-sm-12 ReservPrixCont">
                <label for="prix_t" class="ProfileLabel Prixlabel"> Prix Total </label>
                <input type="text"  class="form-control Reservationinput" id="prix_t"  readonly>
              </div>
            </div>
          </fieldset>
            <div class="row form-group mb-3 mt-4 d-flex justify-content-center">
              <div class="col-sm-6 mb-3 mb-sm-0">
                <button type="button" class="TableFormReset">Annuler</button>
              </div>
            </div>
        </form>
        <!-------------------- End Form Ajout --------------------> 

        <!-------------------- Form Refuser -------------------->        
        <form id="AccepterForm" method="POST" class="signUpForm hideCont"  enctype="multipart/form-data">
          <h4 class="TableFormTitle">Accepter une Reservation </h4> 
        
          <div class="mb-3 input-group suppQuestion">
            Voulez-vous vraiment Accpeter cette Reservation ?
            <div class="moreInfos" >Plus d'informations</div>
          </div>

          <div class="row form-group mb-3 mt-4">
            <div class="col-sm-6 mb-3 mb-sm-0">
              <button type="button" class="TableFormReset">Annuler</button>
            </div>
            <div class="col-sm-6 mb-3 mb-sm-0">
              <button type="button" class="TableFormSubmit" id="AcceptSubmit" >Confirmer</button>
            </div>
          </div>
        </form>
        <!-------------------- End Form Refuser -------------------->  


        <!-------------------- Form Refuser -------------------->        
        <form id="RefuserForm" method="POST" class="signUpForm hideCont"  enctype="multipart/form-data">
          <h4 class="TableFormTitle">Refuser une Reservation </h4> 
        
          <div class="mb-3 input-group suppQuestion">
            Voulez-vous vraiment refuser cette Reservation ?
            <div class="moreInfos">Plus d'informations</div>
          </div>

          <div class="row form-group mb-3 mt-4">
            <div class="col-sm-6 mb-3 mb-sm-0 ">
              <button type="button" class="TableFormReset">Annuler</button>
            </div>
            <div class="col-sm-6 mb-3 mb-sm-0">
              <button type="button" class="TableFormSubmit" id="RefuseSubmit" >Confirmer</button>
            </div>
          </div>
        </form>
        <!-------------------- End Form Refuser -------------------->  

      </div>
    </div>
  </div><!-------------------- End form  Ajout Modification -------------------->

  <!-------------------- Modal -------------------->
  <div class="blackBlurBackground hideCont main"></div>

  <!-------------------- Modal -------------------->
  <div>
    <!--------------Alert--------------->
    <div class="alert myAlert alert-danger alert-dismissible fade show mt-2 animate__animated animate__bounceIn ReservALertWarning" role="alert">
      <i class="fas fa-exclamation-circle"></i>
      <strong>Attention: </strong>  <span class="ReservALertWarningText"> </span>
      <button type="button" id="hideReservErrorAlert" class="btn-close"  aria-label="Close"></button>
    </div>
    <!--------------Alert--------------->
    <div class="alert myAlert alert-success alert-dismissible fade show mt-2 animate__animated animate__bounceIn ReservALertSucces" role="alert">
      <i class="fas fa-exclamation-circle"></i>
      <strong>Felicitation: </strong> <span class="ReservALertSuccesText"> </span>
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