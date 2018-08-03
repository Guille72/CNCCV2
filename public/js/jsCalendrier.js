<script>
function selectDay(elem,list){

  var classListClickedItem = document.getElementsByClassName("clickedItem");


  // si la liste d'elem avec la classe "clickedItem" = 2, on remove les classes
  if (classListClickedItem.length >= 2) {
      classListClickedItem[0].classList.remove("clickedItem");
      classListClickedItem[0].classList.remove("clickedItem");
  }


  // si la liste d'elem est vide on push le premier elem et add la class clickeditem
  if (list.length == 0) {

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

function displayCal(){

var elem = document.getElementById('contentCalId');

  if (elem.offsetHeight <= 0) {
    elem.style.display='flex';
  }
  else{
    elem.style.display='none';
  }

}



function showDay(elem,list){

  var selectedDate = document.getElementById(list[0]).className.substring(17,22);
  var hoverDate = get5LastChar(elem.className);

  var scan = hoverDate - selectedDate;

  for (var i = 0; i = scan; i++) {
    console.log(i);
  }
}



function get5LastChar(i){
  var x = i.substr(i.length - 5);
  return x;
}

</script>
