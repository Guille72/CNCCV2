
<div style="box-shadow: 0px 0px 20px white;margin-bottom: 15px;padding-bottom: 15px;background-color: #F8F8FF;">
    
  <div style="display:flex;justify-content: flex-end;">
      
            <div class="element_menu">
              <a style="padding-top: 25px;font:ms gothic;" href="index.php"><img src="images/logoSansCNCCV.svg" width="55px" height="55px" /><span style="color:rgb(191,36,20);font-size:25px;vertical-align:top;font-style: normal;"> <b>C</b>hez <b>N</b>ous <b>c</b>omme <b>C</b>hez <b>V</b>ous</span>
              </br>
              <div style="text-align:left;font-size:15px;margin-left:69px;color:rgb(191,36,20);font-weight:normal;margin-top:-25px;margin-bottom:5px;background-color: #F8F8FF;font-style: normal;" >Location de maisons meublées au Mans</div></a>
            </div>
      
           <div id="menu" class="element_menu" >
                  <ul>
                    <li><a href="index.php"></a></li>
                    <li><a href="index.php">Accueil</a></li>
                    <li><a href="QuiSommesNous.html">Qui sommes-nous ?</a></li>
                <?php if (!isset($_SESSION['prenom'])) {
                ?>                    
                    <li><a onclick="xajax_connect_first()" style="cursor:pointer;">Se connecter</a></li>
                 <?php
                     }
                    else
                    {
                  ?>
                    <li ><a>Profil de <?php echo $_SESSION['prenom']; ?></a>
                      <ul>
                        <li><a href="mes_reservation.php">Mes réservations</a></li>
                        <li><a href="mes_parametres.php">Mes paramètres</a></li>
                        <li><a href="mes_documents.php">Mes documents</a></li>
                        <li><a href="end.php" style="color:rgb(191,36,20); font-weight: bold;">Se déconnecter</a></li>
                      </ul>
                    </li>
                    
                    <?php
                    }
                    ?>

                  </ul>
          </div>
      </div>




               


