let territories = [
  argentina = {
    id: 1,
    name: "argentina",
    neighbours: ["brazil", "peru"],
    playerOwned: 1,
    units: 3,
  },
  
  brazil = {
    id: 2,
    name: "brazil",
    neighbours: ["argentina", "peru", "venezuela", "north_africa"],
    playerOwned: 1,
    units: 6,
  },

  peru = {
    id: 3,
    name: "peru",
    neighbours: ["brazil", "argentina", "venezuela"],
    playerOwned: 2,
    units: 8,
  },

  venezuela = {
    id: 4,
    name: "venezuela",
    neighbours: ["brazil", "peru", "central_america"],
    playerOwned: 2,
    units: 12,
  }
]

let firstSelectedTerritory = '';
let secondSelectedTerritory = '';
let activePlayer = 1;
let greenPlayer = 1;
let bluePlayer = 2;
const mapElement = document.getElementById('map');

const colorTerritories = () => {
  territories.map(territory => {
    if(territory.playerOwned === greenPlayer) {
      document.getElementById(`${territory.name}`).classList.add("ownedByPlayerGreen")
    } else if (territory.playerOwned === bluePlayer) {
      document.getElementById(`${territory.name}`).classList.add(`ownedByPlayerBlue`)
    }
  })
}

const addNumberOfUnits = () => {
  territories.map(territory => {
    document.getElementById(`${territory.name}-units-text`).textContent = `${territory.units}`
  })
}

const isValidClick = (event) => {
  let validClick = false
  territories.map(territory => {
    if(event.target.id === territory.name) {
      validClick = true
    }
  })
  return validClick;
}

const areNeighbors = (firstSelectedTerritoryObj, secondSelectedTerritoryObj) => {
  for (let i = 0; firstSelectedTerritoryObj.neighbours.length > i; i+= 1) {
    if(firstSelectedTerritoryObj.neighbours[i] == secondSelectedTerritoryObj.name) {
      return true;
    }
  }
  return false;
} 

function isTerritorySelected() {
  if (firstSelectedTerritory === "") {
    return false;
    } else {
      return true;
     }
  }

const canPlayerSelectTerritory = (event) => {
  let canSelect = false
  let territorySelected = event.target.id
  territories.map(territory => {
    if(territory.name === territorySelected) {
      if(territory.playerOwned === activePlayer) {
        canSelect = true
      }
    }
  })
  return canSelect;
}

function selectTerritory(event) {
  event.toElement.classList.toggle("selected");
  firstSelectedTerritory = event.target.id;    
  }


function thisTerritoryAlreadySelected(event) {
  if (firstSelectedTerritory === event.target.id) {
    return true;
    } else {
      return false };
  }

function differentTerritoryAlreadySelected(event) {
  let newTerritoryObject = event.target.id
  let oldTerritoryObject = firstSelectedTerritory
  territories.map(territory => {
    if(event.target.id === territory.name) {
      newTerritoryObject = territory
    } else if (firstSelectedTerritory === territory.name) {
      oldTerritoryObject = territory
    }
  })
  if(oldTerritoryObject.playerOwned === newTerritoryObject.playerOwned) {
    return true;
  } else {
    return false;
  }
  
}

function deselectSameTerritory(event) {
  event.toElement.classList.toggle("selected");
  firstSelectedTerritory = "";
  }


function findFirstSelectedObject() {
    let firstTerritoryObject = "first territory not found"
    territories.map(territory => {
      if(firstSelectedTerritory === territory.name) {
        firstTerritoryObject = territory
        }
      })
    return firstTerritoryObject;
    }


function findSecondSelectedObject(event) {
  let secondTerritoryObject = "second territory not found";
      territories.map(territory => {
        if(event.target.id === territory.name) {
          secondTerritoryObject = territory;
        }
  })
  return secondTerritoryObject;
}

function isEnemyTerritory(attacking, defending) {
  if(attacking.playerOwned === defending.playerOwned) {
    return false
  } else {
    return true
  }
}


document.addEventListener('DOMContentLoaded', () => {

  colorTerritories()
  addNumberOfUnits()

  mapElement.addEventListener('click', () => {
    console.log(this.event.target.id)

    if (isValidClick(this.event) === false) {
      console.log('this is not a territory')
      return;
    }
    if (isTerritorySelected() === false) {
      if (canPlayerSelectTerritory(this.event) === true) {
        selectTerritory(this.event);
        return;
      } else {
        console.log('player doesnt own this territory')
        return;
      }
    } else if (thisTerritoryAlreadySelected(this.event) === true) {
      deselectSameTerritory(this.event);
      return;
    } else if (differentTerritoryAlreadySelected(this.event) === true) {
      console.log('player has chosen a different territory already')
      return;
    }
    const attackingTerritory = findFirstSelectedObject()
    const defendingTerritory = findSecondSelectedObject(this.event)
    if(areNeighbors(attackingTerritory, defendingTerritory) === false) {
      console.log('these territories are not neighbors')
      return;
    }
    if (isEnemyTerritory(attackingTerritory, defendingTerritory) === false) {
      console.log('this is not enemy territory')
      return;
    } else {
      console.log(attackingTerritory, defendingTerritory)
      console.log('attack is valid')
    }
  });





})

