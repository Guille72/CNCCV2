<!-- formulaire "Séjour" : arrivée, départ, Nombre de personnes -->
<Form method="post" action="" class="col s12 m12 l12">
  <div class="row" id="resaForm">

    <!-- Titre -->
    <div class="col s3" id="titleForm">
      <h5 class="">Reservez dès maintenant</h5>
    </div>

    <!-- Choix de la date -->
    <div id="dataPickerForm" onclick="displayCal()">


      <div class="col s2" id="dataPicker1">
        <?= $Form->input('text','arrivee','align','arriveInput','placeholder="Arrivée" readonly') ?>
      </div>


      <div class="col s2" id="dataPicker2">
        <?= $Form->input('text','depart','align','departInput','placeholder="Départ" readonly') ?>
      </div>

    </div>

    <!-- Selection du nb de personnes -->
    <div class="col s2" id="nbPersonne">
        <?= $Form->input('number','NombrePersonne','align whiteColor','inputNbPersonne','min="1" max="8" placeholder="Nombre de personnes" ') ?>
        <!-- <input type="range" id="nbPers" name="NombrePersonne" /> -->
    </div>


    <!-- Button submit -->
    <div class="col" id="submitResaForm">

        <?= $Form->submit('action','btn waves-effect waves-red btnSubmit','Poursuivre ma réservation
        <i class="material-icons right">send</i>') ?>

    </div>

  </div>
  <div class="row" id="calRow">



    <div id="contentCalId" class="contentCal col s12 m12 l12 tooltipped" data-position="bottom" data-tooltip="Selectionnez une date d'arrivée et de départ">
      <div id="arrowLeft" onclick="previousM(allCal)" class="">

          <i class="material-icons large arrow">keyboard_arrow_left</i>

      </div>
        <?= $Calendar; ?>
        <div id="arrowRight" onclick="nextM(allCal)" class="">

            <i class="material-icons large arrow">keyboard_arrow_right</i>

        </div>
    </div>



    </div>
</form>

<br>
