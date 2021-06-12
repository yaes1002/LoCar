<?php

    require_once "../../scripts/connection.php";

    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
       
        $GetVoituresQueery =  " select v.vehicule_id,v.marque,v.modele,v.prix_j,v.nbr_portes,v.nbr_places,v.climat,v.boite_vitesse,v.vehicule_image,l.ville
                                from vehicule v JOIN locataire l
                                using (locataire_id)
                                where v.visibilite='Oui'"; 

        if ($VoituresRes = $conn->query($GetVoituresQueery)) 
        {
            while($voiture = $VoituresRes->fetch_assoc())
            {
                ?>
                    <tr>
                      <td>
                        <div>
                          <div class="row">
                            <div class="col-md-4 carImageContCont">
                              <div class="row carImageCont">
                                <img src="../<?php echo $voiture['vehicule_image'] ?>" class="carImage" alt="">
                              </div>
                            </div>
                            <div class="col-md-5 nameVilleSpecs">
                              <div class="carNameVille">
                                <h4 class="carTitle col-8"> <?php echo ucfirst($voiture['marque']) . " " . ucfirst($voiture['modele'])." ".$voiture['annee']; ?> <br>
                                  <span class="carVille">
                                    <i class="fas fa-map-marker-alt"></i>  <?php echo ucfirst($voiture['ville']); ?>
                                  </span>
                                </h4>
                              </div>
                              <div class="carSpecs">
                                <ul class="row carSpecsList justify-content-center mb-0">
                                  <!----------------------------------------------->
                                  <li class="col-auto  m-1" title="Nombre de Portes">
                                    <i class="fas fa-car-side"></i>
                                  </li>
                                  <li class="col-auto ">x <?php echo $voiture['nbr_portes']; ?></li>
                                  <!----------------------------------------------->
                                  <li class="col-auto m-1" title="Nombre de Places">
                                    <i class="fa fa-male"></i>
                                  </li>
                                  <li class="col-auto">x <?php echo $voiture['nbr_places']; ?></li>
                                  <!----------------------------------------------->
                                  <li class="col-auto  m-1" title="Climatisation">
                                    <i class="fas fa-fan"></i>
                                  </li>
                                  <li class="col-auto"><?php echo $voiture['climat']; ?></li>
                                  <!----------------------------------------------->
                                  <li class="col-auto  m-1" title="Boite de Vitesse">
                                    <i class="fas fa-cog"></i>
                                  </li>
                                  <li class="col-auto">
                                      <?php
                                        if($voiture['boite_vitesse']=="Manuelle")
                                        echo 'M';
                                        else
                                        echo 'A'; 
                                        ?>
                                  </li>
                                </ul>
                              </div>
                            </div>
                            <div class="col-md-3 carPriceCont">
                              <div class=" ">
                                <h4 class="carPrice offset-0 col-4 order-last"> <?php echo $voiture['prix_j']; ?> <p>MAD/Jour</p>
                                </h4>
                              </div>
                              <div class="carAfficheCarBtnCont ">
                                <button class="Reserver " onclick="window.location.href='voitureinfos.php?id=<?php echo $voiture['vehicule_id']; ?>'">
                                  Reserver
                                </button>
                              </div>
                            </div>
                          </div>
                        </div>
                      </td>
                    </tr>
                <?php
            }
        }
    }
    else
        header('Location: ../../erreur/403.php');
?>

