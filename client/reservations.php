<?php
  require_once "../scripts/connection.php";
  session_start();
  if( !isset($_SESSION['user']) || $_SESSION['user'] != 'client' )
  {
    header('Location: ../');
  }

  /*$NoticeMsg = 2;
  if(isset($_GET['Fct']) && isset($_GET['Notice'])  )
  {
    $NoticeMsg =$_GET['Notice'];
    $Fct =$_GET['Fct'];
    
  }*/
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
                  <i class="fas fa-stream"></i>Reservation trouv??e : <span class="searchNumberRes"></span> 
                </span>
              </div>
            </div>
          </div>
          <div class="col-3">
            <div class="plusCont">
              <i class="fas fa-plus" id="AjoutTableForm" title="Ajouter Une Voiture"  onclick="showTableForm(1)"></i>
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
              <tbody>
              <?php 
                $client_id = $_SESSION['id'];
                $reservationAffichageQueery = " select *,(date_fin - date_debut)*prix_j prixT
                                                from reservation join vehicule
                                                using (vehicule_id)
                                                where client_id = $client_id
                                                and visibilite = 'Oui'
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
                              <span class="EtatIcon AccepteIcon" title="Accept??">  
                                <i class="fas fa-check-circle"></i>
                              </span>
                              <span class="abbr">A</span> 
                            <?php
                          break;
                          case "Refuse":
                            ?>
                              <span class="EtatIcon RefuseIcon" title="Refus??">  
                                <i class="fas fa-times-circle"></i>
                              </span>  
                              <span class="abbr">R</span> 
                            <?php
                          break;
                          case "Annule":
                            ?>
                              <span class="EtatIcon AnnuleIcon" title="Annul??">  
                                <i class="fas fa-minus-circle"></i>
                              </span>  
                              <span class="abbr">Z</span> 
                            <?php
                          break;
                        }
                      ?>
                  </td>
                  <td class="action"> 
                    <i class="fad fa-info ActionIcon Afficher"  title="Afficher plus d'informations"></i>
                    <?php
                    if($row['etat']=='En attente')
                    {
                      ?>
                        <i class="fad fa-times ActionIcon Annuler"  title="Annuler"></i>
                      <?php
                    }
                    else
                    {
                      ?>
                        <i class="fad fa-trash ActionIcon Supprimer"  title="Supprimer"></i>
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
      <div class="TableFormCont hideCont animate__animated animate__bounceIn">
        <i class="fas fa-times closeTableForm" onclick="hideTableForm()"></i>
        <!-------------------- Form Ajout -------------------->        
        <form id="ajoutForm" action="./scripts/voitureajout.php" method="POST" class="signUpForm hideCont"  enctype="multipart/form-data">
          
          <h4 class="TableFormTitle MarginForALert">Ajouter une Voiture </h4>
          <input type="hidden" name="locataire_id" value="<?php echo $_SESSION['id'] ;   ?>" >      
          <div class="firstFormPart">
            <div class="row form-group mb-3">
              <div class="col-sm-4 mb-3 mb-sm-0">
                <input type="text" name="marque" class="form-control TableFormInput" placeholder="Marque" maxlength="15" title="Marque" required>
              </div>
              <div class="col-sm-4 mb-3 mb-sm-0">
                <input type="text" name="modele" class="form-control TableFormInput"  placeholder="Modele" maxlength="15" title="Modele" required>
              </div>
              <div class="col-sm-4">
                <input type="number" name="annee" class="form-control TableFormInput"  placeholder="Annee" max="2022" min="1990" title="Annee" required>
              </div>
            </div>

            <div class="mb-3 ">
              <input type="text" name="matricule" class="form-control TableFormInput" maxlength="10" minlength="5" placeholder="Matricule" title="matricule" required>
            </div>
            <div class="mb-3 input-group">
              <input type="text" name="couleur" class="form-control TableFormInput" placeholder="Couleur" maxlength="20" title="Couleur" required>
              <select class="form-select sideSelect" name="boite_vitesse" required>
                <option value="" >Bo??te de Vitesse</option>
                <option value="Manuelle">Manuelle</option>
                <option value="Automatique">Automatique</option>
              </select>
            </div>

            <div class="mb-3 input-group">
              <input type="number" name="kilometrage" class="form-control TableFormInput"  placeholder="Kilometrage (Km)" max="999999" title="Kilometrage (Km)" required>
              <select class="form-select sideSelect" name="energie" title="Energie" required>
                <option value="" >Energie</option>
                <option value="Essence">Essence</option>
                <option value="Diesel">Diesel</option>
                <option value="Electrique">Electrique</option>
              </select>
            </div>

            <div class="mb-3 input-group">
              <select class="form-select sideSelect" name="nbr_places" title="Nombre De Places" required>
                <option value="" >Nombre De Places</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
              </select>
              <select class="form-select sideSelect" name="nbr_portes" title="Nombre De Portes" required>
                <option value="" >Nombre De Portes</option>
                <option value="2">2</option>
                <option value="4">4</option>
              </select>
            </div>

            <div class="mb-3 input-group">
              <select class="form-select sideSelect" name="gps" title="GPS" required>
                <option value="" >GPS</option>
                <option value="Oui">Oui</option>
                <option value="Non">Non</option>
              </select>
              <select class="form-select sideSelect" name="climat" title="Climatisation" required>
                <option value="" >Climatisation</option>
                <option value="Oui">Oui</option>
                <option value="Non">Non</option>
              </select>
            </div>

            <div class="mb-3 input-group" >
              <input type="number" name="prix_j" class="form-control TableFormInput" placeholder="Prix Par Jour (DH)" min="100" max="5000" title="Prix Par Jour (DH)"  required>      
            </div>

            <div class="mb-3 input-group" >
              <label class=" form-control TableFormInput custom-file-upload">
                <input type="file" name="vehicule_image" class="carImageSrc" class="form-control TableFormInput"  accept="image/png, image/jpeg, image/jpg, image/gif"   required onchange="showCarImg(),changeInputFileBorder()" >
                <i class='bx bx-upload'></i>Choisir l'Image de Votre Voiture
              </label>  
            </div>

            <div class="mb-3 input-group carImageCont" >
              <img id="carImage"  src="" alt="">
            </div>

            <div class="row form-group mb-3">
              <div class="col-sm-6 mb-3 mb-sm-0">
                <button type="reset" class="TableFormReset" onclick="hideCarImg(),RemoveInputFileBorder()">Supprimer</button>
              </div>
              <div class="col-sm-6 mb-3 mb-sm-0">
                <button type="button" class="TableFormSubmit NextPartSubmit" onclick="changeInputFileBorder()">Suivant</button>
              </div>
            </div>
          </div> 
          
          <!-------------Second part---------------->
          <div class="seconFormPart">
            <div class="mb-3 input-group" >
              <h4>Gestion de disponibilite</h4>
            </div>
            <div class="mb-3 input-group" >
              <input type="text" name="datefilter" id="datePicker" class="form-control TableFormInput"  maxlength="23" value="" placeholder=" [ Date debut - Date Fin ]"  title="Debut et Fin de Location"  required readonly editable:true >
              <label class="input-group-text addIntervalCont"><i class="fas fa-plus addIntervalAjout" title="Ajouter Une disponibilite"></i></label>
            </div> 

            <div id="intervalesContAjout">
              
            </div>

            <div class="row form-group mb-3">
              <div class="col-sm-6 mb-3 mb-sm-0">
                <button type="button" class="TableFormReset" onclick="hideTableForm()">Annuler</button>
              </div>
              <div class="col-sm-6 mb-3 mb-sm-0">
                <button type="button" class="TableFormSubmit " onclick="changeInputFileBorder(),TestFormInputsAjout()">Enregistrer</button>
              </div>
            </div>
          </div><!-------------End Second part---------------->


          <!----- Erreur Handler -----> 
          <div id="FormAjoutAlert" class="alert myAlert alert-danger alert-dismissible fade show animate__animated animate__bounceIn" role="alert">
            <i class="fas fa-exclamation-circle"></i>
            <strong>Attention: </strong><span id="FormAjoutAlertText"> </span>
            <button id="hideFormAjoutAlert" type="button" class="btn-close" aria-label="Close"></button>
          </div>

          <!----- NextPartArrow ----->       
          <div class="NextPartArrow "  >
            <i class="fas fa-angle-right animate__animated animate__heartBeat animate__infinite"></i>
          </div>
          <div class="PreviousPartArrow " >
            <i class="fas fa-angle-left animate__animated animate__heartBeat animate__infinite"></i>
          </div>
        </form>
        <!-------------------- End Form Ajout -------------------->            

        <!-------------------- Form Modification -------------------->        
        <form id="modificationForm" action="./scripts/voituremodif.php" method="POST" class="signUpForm hideCont"  enctype="multipart/form-data">
          <h4 class="TableFormTitle MarginForALert">Modifier une Voiture </h4> 
          <input type="hidden" name="vehicule_id" >
          <div class="firstFormPart">

            <div class="row form-group mb-3">
              <div class="col-sm-4 mb-3 mb-sm-0">
                <input type="text" name="marque" class="form-control TableFormInput"  placeholder="Marque" maxlength="15" title="Marque" readonly>
              </div>
              <div class="col-sm-4 mb-3 mb-sm-0">
                <input type="text" name="modele" class="form-control TableFormInput"  placeholder="Modele" maxlength="15" title="Modele" readonly>
              </div>
              <div class="col-sm-4">
                <input type="number" name="annee" class="form-control TableFormInput"  placeholder="Annee" max="2022" min="1990" title="Annee" readonly>
              </div>
            </div>

            <div class="mb-3 ">
              <input type="text" name="matricule" class="form-control TableFormInput" maxlength="10" minlength="5" placeholder="Matricule" title="matricule" readonly>
            </div>
            <div class="mb-3 input-group">
              <input type="text" name="couleur" class="form-control TableFormInput"  placeholder="Couleur" maxlength="20" title="Couleur" required>
              <select class="form-select sideSelect" name="boite_vitesse" title="Bo??te de Vitesse" disabled>
                <option value="" >Bo??te de Vitesse</option>
                <option value="Manuelle">Manuelle</option>
                <option value="Automatique">Automatique</option>
              </select>
            </div>

            <div class="mb-3 input-group">
              <input type="number" name="kilometrage" class="form-control TableFormInput"  placeholder="Kilometrage (Km)" max="999999" title="Kilometrage (Km)"  required>
              <select class="form-select sideSelect" name="energie" title="Energie"  disabled>
                <option value="" >Energie</option>
                <option value="Essence">Essence</option>
                <option value="Diesel">Diesel</option>
                <option value="Electrique">Electrique</option>
              </select>
            </div>

            <div class="mb-3 input-group">
              <select class="form-select sideSelect" name="nbr_places"  title="Nombre De Places" disabled>
                <option value="" >Nombre De Places</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
              </select>
              <select class="form-select sideSelect" name="nbr_portes" title="Nombre De Portes" disabled>
                <option value="" >Nombre De Portes</option>
                <option value="2">2</option>
                <option value="4">4</option>
              </select>
            </div>

            <div class="mb-3 input-group">
              <select class="form-select sideSelect" name="gps" title="GPS"  required>
                <option value="" >GPS</option>
                <option value="Oui">Oui</option>
                <option value="Non">Non</option>
              </select>
              <select class="form-select sideSelect" name="climat" title="Climatisation"  required>
                <option value="" >Climatisation</option>
                <option value="Oui">Oui</option>
                <option value="Non">Non</option>
              </select>
            </div>

            <div class="mb-3 input-group" >
              <input type="number" name="prix_j" class="form-control TableFormInput" placeholder="Prix Par Jour (DH)" min="100" max="5000"  title="Prix Par Jour (DH)" required>      
            </div>

            <div class="mb-3 input-group" >
              <label class=" form-control TableFormInput custom-file-upload">
                <input type="file" name="vehicule_image" class="carImageSrc" class="form-control TableFormInput"  accept="image/png, image/jpeg, image/jpg, image/gif"  onchange="showCarImgModif(),changeInputFileBorder()" >
                <i class='bx bx-upload'></i>Choisir l'Image de Votre Voiture
              </label>  
            </div>

            <div class="mb-3 input-group carImageCont" >
              <img id="carImageModif"  src="" alt="">
            </div>

            <div class="row form-group mb-3">
              <div class="col-sm-6 mb-3 mb-sm-0">
                <button type="button" class="TableFormReset " onclick="hideTableForm()">Annuler</button>
              </div>
              <div class="col-sm-6 mb-3 mb-sm-0">
                <button type="button" class="TableFormSubmit NextPartSubmit" onclick="changeInputFileBorder()">Suivant</button>
              </div>
            </div>

          </div>
          <!-------------Second part---------------->
          <div class="seconFormPart">
            <div class="mb-3 input-group" >
              <h4>Gestion de disponibilite</h4>
            </div>
            <div class="mb-3 input-group" >
              <input type="text" name="datefilter" id="newDatePicker" class="form-control TableFormInput"  maxlength="23" value="" placeholder=" [ Date debut - Date Fin ]"  title="Debut et Fin de Location"  required readonly editable:true >
              <label class="input-group-text addIntervalCont"><i class="fas fa-plus addIntervalAjout" title="Ajouter Une disponibilite"></i></label>
            </div> 

            <div id="intervalesCont">
              
            </div>

            <div class="row form-group mb-3">
              <div class="col-sm-6 mb-3 mb-sm-0">
                <button type="button" class="TableFormReset" onclick="hideTableForm()">Annuler</button>
              </div>
              <div class="col-sm-6 mb-3 mb-sm-0">
                <button type="button" class="TableFormSubmit" onclick="changeInputFileBorder(),TestFormInputs()">Enregistrer</button>
              </div>
            </div>
          </div><!-------------End Second part---------------->




          <!----- Erruer Handler -----> 
          <div id="FormEditAlert" class="alert myAlert alert-danger alert-dismissible fade show animate__animated animate__bounceIn" role="alert">
            <i class="fas fa-exclamation-circle"></i>
            <strong>Attention: </strong><span id="FormEditAlertText"> </span>
            <button id="hideFormEditAlert" type="button" class="btn-close" aria-label="Close"></button>
          </div>

          <!----- NextPartArrow ----->       
          <div class="NextPartArrow "  >
            <i class="fas fa-angle-right animate__animated animate__heartBeat animate__infinite"></i>
          </div>
          <div class="PreviousPartArrow " >
            <i class="fas fa-angle-left animate__animated animate__heartBeat animate__infinite"></i>
          </div>
        </form>

        <!-------------------- Form Suppresion -------------------->        
        <form id="suppressionForm" action="./scripts/voituresupprime.php" method="POST" class="signUpForm hideCont"  enctype="multipart/form-data">
          <h4 class="TableFormTitle">Supprimer une Voiture </h4> 
          <input type="hidden" name="vehicule_id" >
        
          <div class="mb-3 input-group suppQuestion">
            Voulez-vous vraiment supprimer cette Voiture ?
          </div>

          <div class="mb-3 input-group carImageCont" >
            <img id="carImageSupp"  src="" alt="">
          </div>

          <div class="row form-group mb-3">
            <div class="col-sm-6 mb-3 mb-sm-0">
              <button type="button" class="TableFormReset" onclick="hideTableForm()">Annuler</button>
            </div>
            <div class="col-sm-6 mb-3 mb-sm-0">
              <button type="submit" class="TableFormSubmit" onclick="changeInputFileBorder()">Confirmer</button>
            </div>
          </div>
        </form>
        <!-------------------- End Form Suppresion -------------------->  

      </div>
    </div>
  </div><!-------------------- End form  Ajout Modification -------------------->

  <!-------------------- Modal -------------------->
  <div class="blackBlurBackground hideCont main"></div>

  <!-------------------- Modal -------------------->
  <div>
    <?php
    /*
      if($NoticeMsg == 0)
      {
        ?>
          <div class="alert myAlert alert-success alert-dismissible fade show alertVoitures mt-2 animate__animated animate__bounceIn" role="alert">
            <i class="fas fa-check-circle"></i>
            <strong>Felicitaion: </strong> <?php echo $Fct; ?> avec succ??s
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        <?php
      }
      else if($NoticeMsg == 1)
      {
        ?>
          <div class="alert myAlert alert-danger alert-dismissible fade show alertVoitures mt-2 animate__animated animate__bounceIn" role="alert">
          <i class="fas fa-exclamation-circle"></i>
            <strong>Attention: </strong> Erreur Au moment de La<?php echo $Fct;  ?> 
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        <?php
      } */
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