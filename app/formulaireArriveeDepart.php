<?php
/**
 * Created by PhpStorm.
 * User: guill_n3dyp4y
 * Date: 08/07/2018
 * Time: 18:45
 */

<form>
    <div id="resaForm">


      <!-- Titre -->
      <div id="titleForm">
        <h5>Reservez dès maintenant</h5>
      </div>


      <!-- Selection du lieu -->
      <div id="lieu">
        <div class="input-field col m10">
          <select required>
            <option disabled selected>Choississez une maison</option>
            <option value="1">Chez Rousseau</option>
            <option value="2">Chez Painlevé</option>
            <option value="3">Chez Champion</option>
          </select>
          <label>Lieu</label>
        </div>
      </div>



      <!-- Selection du nb de personnes -->
      <div id="nbPersonne">
        <p class="range-field">
          <label>Nombres de personnes</label>
          <input type="range" id="test5" min="0" max="12"/>
        </p>
      </div>


      <!-- Choix de la date -->
      <div id="dataPickerForm" class="row">

        <div class="col s6">
        <label>Date d'arrivé</label>
        <input type="text" class="datepicker" required>
      </div>

        <div class="col s6">
        <label>Date de départ</label>
        <input type="text" class="datepicker" required>
      </div>

      </div>



      <!-- Button submit -->
      <div id="submitResaForm" class="row">

        <div class="col s12">
        <button class="btn waves-effect waves-light bgBlueForm" type="submit" name="action">Poursuivre ma réservation
          <i class="material-icons right">send</i>
        </button>
        </div>

      </div>



    </div>
  </form>