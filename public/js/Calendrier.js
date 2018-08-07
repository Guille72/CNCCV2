<script>

var dayList = [];
var liRed = [];
var allCal = document.getElementsByClassName('calDiv');

// modifier howMuchCal afin d'afficher le nombre de calendrier voulu,
// il est maintenant inutile de modifier la variable php $pas
var howMuchCal = 2;

initCal(allCal,howMuchCal);


//affiche le nombre de calendrier voulu à la fois
function initCal(allCal,howMuchCal){
  for (var i = 0; i < howMuchCal; i++) {
    addDisplayM(allCal[i]);
  }
}


// ajoute la class displayM pour afficher le calendrier
function addDisplayM(e){
e.classList.add('displayM');
}


// retire la class displayM pour cacher le calendrier
function removeDisplayM(e){
e.classList.remove('displayM');
}



//permet de choisir deux dates
function selectDay(elem,list){

  var classListClickedItem = document.getElementsByClassName("clickedItem");


  // si la liste d'elem avec la classe "clickedItem" = 2, on remove les classes
  if (classListClickedItem.length >= 2) {
      classListClickedItem[0].classList.remove("clickedItem");
      classListClickedItem[0].classList.remove("clickedItem");
  }


  // si la liste d'elem est vide on push le premier elem et add la class clickeditem
  if (list.length == 0) {

    for (var i = 0; i < liRed.length; i++) {
      liRed[i].classList.remove('hoverItem');
    }


    list.push(elem.id);
    elem.classList.add('clickedItem');

    document.getElementById('arriveInput').value = "";
    document.getElementById('departInput').value = "";


    document.getElementById('arriveInput').value = list[0];


  }

  // si la liste d'elem = 1, on verifie que l'elem en cours correspond a une date superieur a l'elem de la list
  if (list.length == 1) {

    var elemYear = elem.id.substring(0, 4);
    var list1Year = list[0].substring(0, 4);

    var elemMonth = elem.id.substring(5, 7);
    var list1Month = list[0].substring(5, 7);

    var elemDay = elem.id.substring(8, 10);
    var list1Day = list[0].substring(8, 10);

    var listDate = elemYear+elemMonth+elemDay;
    var elemDate = list1Year+list1Month+list1Day;


      if (listDate > elemDate) {

        list.push(elem.id);
        elem.classList.add('clickedItem');

      }
    }

  // si la liste d'elem = 2, on envoie les values au formulaire, et on supprime les deux elem
  if (list.length == 2) {
    document.getElementById('departInput').value = list[1];

    // document.getElementById('arriveInput').placeholder = listDate;
    // document.getElementById('departInput').placeholder = elemDate;
    list.length = 0;
  }

}



//display cal input->onclick
function displayCal(){

var elem = document.getElementById('calRow');

  if (elem.offsetHeight <= 0) {
    elem.style.display='block';
  }
  else{
    elem.style.display='none';
  }

}


// change le css des dates compris entre les deux dates
function showDay(elem,list){

  if (list.length == 1) {

    for (var i = 0; i < liRed.length; i++) {
      liRed[i].classList.remove('hoverItem');
    }

  var selectVerif = document.getElementById(list[0]).className.substring(0,16);
  var selectedDate = document.getElementById(list[0]).className.substring(17,22);
  var hoverDate = get5LastChar(elem.className);
  var count = hoverDate - selectedDate + 1;
  var scan = selectedDate;

    for (var i = 0; i < count; i++) {
      var e = document.getElementsByClassName('itemPickableItem '+scan);
      e[0].classList.add('hoverItem');
      liRed.push(e[0]);

      scan++;
    }
  }
}


// return les 5 dernier char d'une variable str (pour showDay)
function get5LastChar(i){
  var x = i.substr(i.length - 5);
  return x;
}



// btn pour affiché les mois suivant
function nextM(allCal){

  var allDisplayM = [];
  var allDisplayM = document.getElementsByClassName('displayM');

  var current = parseInt(allDisplayM[0].id);

// si il y a 1 calendrier
  if (allDisplayM.length == 1 && current != allCal[allCal.length - 1].id) {

    var current1 = parseInt(allDisplayM[0].id);

      if (current1 == 12) {
        var current1 = 0;
      }

      for (var i = 0; i < allDisplayM.length; i++) {
        removeDisplayM(allDisplayM[0]);
      }

    addDisplayM(document.getElementById(current1+1));

  }

  // si il y a 2 calendrier
  if (allDisplayM.length == 2 && current != allCal[allCal.length - 2].id) {

    var current2a = parseInt(allDisplayM[0].id);
    if (current2a == 12) {
      var current2a = 0;
    }
    var current2b = parseInt(allDisplayM[1].id);
    if (current2b == 12) {
      var current2b = 0;
    }

    for (var i = 0; i < allDisplayM.length; i++) {
      removeDisplayM(allDisplayM[0]);
    }

    addDisplayM(document.getElementById(current2a+1));
    addDisplayM(document.getElementById(current2b+1));

  }

  // si il y a 3 calendrier
  if (allDisplayM.length == 3 && current != allCal[allCal.length - 3].id) {

    var current3a = parseInt(allDisplayM[0].id);
    if (current3a == 12) {
      var current3a = 0;
    }
    var current3b = parseInt(allDisplayM[1].id);
    if (current3b == 12) {
      var current3b = 0;
    }
    var current3c = parseInt(allDisplayM[2].id);
    if (current3c == 12) {
      var current3c = 0;
    }

    for (var i = 0; i < allDisplayM.length; i++) {
      removeDisplayM(allDisplayM[0]);
    }

    addDisplayM(document.getElementById(current3a+1));
    addDisplayM(document.getElementById(current3b+1));
    addDisplayM(document.getElementById(current3c+1));

}
}




// btn pour affiché les mois precedent
function previousM(allCal){

  var allDisplayM = [];
  var allDisplayM = document.getElementsByClassName('displayM');
  var current = parseInt(allDisplayM[0].id);

  // si il y a 1 calendrier
  if (allDisplayM.length == 1 && current != allCal[0].id) {

    var current1 = parseInt(allDisplayM[0].id);

    if (current1 == 1) {
      var current1 = 13;
    }

    removeDisplayM(allDisplayM[0]);

    addDisplayM(document.getElementById(current1-1));
  }


  // si il y a 2 calendrier
  if (allDisplayM.length == 2 && current != allCal[0].id) {

    var current2a = parseInt(allDisplayM[0].id);
    if (current2a == 1) {
      var current2a = 13;
    }
    var current2b = parseInt(allDisplayM[1].id);
    if (current2b == 1) {
      var current2b = 13;
    }

      removeDisplayM(allDisplayM[0]);
      removeDisplayM(allDisplayM[0]);

    addDisplayM(document.getElementById(current2a-1));
    addDisplayM(document.getElementById(current2b-1));

  }


  // si il y a 3 calendrier
  if (allDisplayM.length == 3 && current != allCal[0].id) {

    var current3a = parseInt(allDisplayM[0].id);
    if (current3a == 1) {
      var current3a = 13;
    }
    var current3b = parseInt(allDisplayM[1].id);
    if (current3b == 1) {
      var current3b = 13;
    }
    var current3c = parseInt(allDisplayM[2].id);
    if (current3c == 1) {
      var current3c = 13;
    }

    removeDisplayM(allDisplayM[0]);
    removeDisplayM(allDisplayM[0]);
    removeDisplayM(allDisplayM[0]);


    addDisplayM(document.getElementById(current3a-1));
    addDisplayM(document.getElementById(current3b-1));
    addDisplayM(document.getElementById(current3c-1));

}

}
</script>
