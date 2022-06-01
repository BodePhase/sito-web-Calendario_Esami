// Query Selectors
const recipeForm = document.querySelector('#recipe-form');
const corsoStudiForm = document.getElementById("corsostudi-form");
//const urlcorso = document.getElementById("urlcorso");
//const urltype = document.getElementById("urltype");
const recipeContainer = document.querySelector('#recipe-container');
const qmark = document.getElementById("#qmark");;
let listItems = [];
//dep
//const reader = require("g-sheets-api");

// FUNCTIONS
function handleFormSubmit(e){
  e.preventDefault();
  const esame = DOMPurify.sanitize(recipeForm.querySelector('#esame').value);
  const data = DOMPurify.sanitize(recipeForm.querySelector('#data').value);
  const posizione = DOMPurify.sanitize(recipeForm.querySelector('#posizione').value);
  const professore = DOMPurify.sanitize(recipeForm.querySelector('#professore').value);
  const canale = DOMPurify.sanitize(recipeForm.querySelector('#canale').value);
  const note = DOMPurify.sanitize(recipeForm.querySelector('#note').value);
  const newRecipe = {
    esame,
    data,
    posizione,
    professore,
    canale,
    note,
    id: Date.now(),
  }
  listItems.push(newRecipe);
  e.target.reset();
  recipeContainer.dispatchEvent(new CustomEvent('refreshRecipes'));
}

function displayRecipes(){
  const tempString = listItems.map(item => `
    <div class="col">
      <div class="card mb-4 rounded-3 shadow-sm border-sottile">
        <div class="card-header py-3 text-white bg-primary border-sapienza">
          <h4 class="my-0">${item.esame}</h4>
        </div>
        <div class="card-body">
          <ul class="text-start">
            <li><strong>Data: </strong>${item.data}</li>
            <li><strong>Posizione: </strong>${item.posizione}</li>
            <li><strong>Professore: </strong>${item.professore}</li>
            <li><strong>Canale: </strong>${item.canale}</li>
            ${!item.note.length ? "" : `<li><strong>Note: </strong>${item.note}</li>`}
          </ul>
          <button class="btn btn-lg btn-outline-danger" aria-label="Delete ${item.esame}" value="${item.id}">Cancella Esame</button>
        </div>
      </div>
    </div>
    `).join('');
  recipeContainer.innerHTML = tempString;
}

function mirrorStateToLocalStorage(){
  localStorage.setItem('recipeContainer.list', JSON.stringify(listItems));
}

function loadinitialUI(){
  const tempLocalStorage = localStorage.getItem('recipeContainer.list');
  if(tempLocalStorage === null || tempLocalStorage === []) return;
  const tempRecipes = JSON.parse(tempLocalStorage);
  listItems.push(...tempRecipes);
  recipeContainer.dispatchEvent(new CustomEvent('refreshRecipes'));
}

function deleteRecipeFromList(id){
  listItems = listItems.filter(item => item.id !== id);
  recipeContainer.dispatchEvent(new CustomEvent('refreshRecipes'));
}


function validaFormUrl(e){
  e.preventDefault();
  if(document.getElementById("urltype").value=="vuoto"){
    alert("inserire tipo file non vuoto");
    return false;
  }
  e.target.reset();
  return true;
}

// EVENT LISTENERS
recipeForm.addEventListener('submit', handleFormSubmit);
recipeContainer.addEventListener('refreshRecipes', displayRecipes);
recipeContainer.addEventListener('refreshRecipes', mirrorStateToLocalStorage);
window.addEventListener('DOMContentLoaded', loadinitialUI);
recipeContainer.addEventListener('click', (e) => {
  if(e.target.matches('.btn-outline-danger')){
    deleteRecipeFromList(Number(e.target.value));
  };
});





