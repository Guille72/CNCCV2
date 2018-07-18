

<!-- suite et fin de Navbar renseigné des prix suivants demande de l'utilisateur -->
<div class="hide-on-large-only"><br></div>
<div class="nav-content hide-on-med-and-down displayNScroll" id="cc">
    <ul class="centreETC tabs-transparent align_ul displayNScroll">

        <?php
        require ROOT.'/settings/maisons.php';
        foreach ($maisons as $maison):
        ?>
             <li class="tab li1 li"><a class="active colortext colortext1 waves-green" href="index.php?p=<?= $maison ?>"><h6>Chez <?= ucfirst($maison) ?>
                    <br> <?= $_SESSION[$maison] ?>  </h6></a></li>
        <?php endforeach; ?>
    </ul>
    <br>
    <div class="centreETC colortext colortext1 waves-green"><h6>Pour la période du <?=  date("d/m/Y", strtotime($_SESSION['arrivee'])) ?> au <?= date("d/m/Y", strtotime($_SESSION['depart'])) ?> et pour <?= $_SESSION['NombrePersonne'] ?> personnes</h6></div>
</div>
<div class="nav-content displayNScroll" id="cc">
    <ul class="centreETC tabs-transparent hide-on-large-only displayNScroll align_ul">
        <?php
        require ROOT.'/settings/maisons.php';
        foreach ($maisons as $maison):
            ?>
            <li class="tab li1 li"><a class="active colortext colortext1 waves-green" href="index.php?p=<?= $maison ?>"><h6>Chez <?= ucfirst($maison) ?>
                        <br> <?= $_SESSION[$maison] ?>  </h6></a></li>
        <?php endforeach; ?>
    </ul>
    <br>
</div>




</nav>