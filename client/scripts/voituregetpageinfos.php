
<?php
    require_once "../../scripts/connection.php";

    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        if (isset($_POST['id'])) 
        {
            $id = $_POST['id'];
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
                        <?php
                        if ($row['civilite'] == 'M') 
                            echo '<img src="./assets/img/LocatairePhoto/MaleProfile.jpg" alt="">';
                        else 
                            echo '<img src="./assets/img/LocatairePhoto/FemaleProfile.jpg" alt="">';
                        ?>                   
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
                    <span><i class="fas fa-play animate__pulse animate__animated animate__infinite" onclick="getCarPrice()"></i></span>
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
                    <button class="Reserver animate__pulse animate__animated animate__infinite" onclick="window.location.href='../erreur/404.php'" >
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
            header('Location: profile.php');       
        } 
        else
            header('Location: ../../erreur/404.php');
        }
        else
        header('Location: ../../erreur/404.php');
    }
    else
        header('Location: ../../erreur/403.php');
?>