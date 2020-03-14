const alaska = document.getElementById('alaska');
const argentina = document.getElementById('argentina');
let selectedTerritory = "";


document.addEventListener('DOMContentLoaded', () => {
  alaska.addEventListener('click', () => {
    document.getElementById('alaska').classList.toggle("selected");
    console.log('clicked');
  });

  argentina.addEventListener('click', () => {
    argentina.classList.toggle("selected");
    console.log(event.target.id);
    (selectedTerritory !== 'argentina') ? selectedTerritory = 'argentina': selectedTerritory = "";
  });




})

//to add event listeners to clicks, you need the path to be filled (opacity can be set to 0)! In the current versio of map, fill is automatically none.