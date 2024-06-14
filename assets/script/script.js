

const email = document.getElementById('email');
let p = document.createElement('p');
p.textContent = "incorrect email address"
p.style.color = 'red';


email.addEventListener('blur', function (event) {
  const saisie = event.target.value;
  if (saisie.includes('@')) {
    p.remove();
  } else {
    email.parentNode.insertBefore(p, email.nextSibling);
    console.log("error.");
  }
});

const zipCode = document.getElementById('zipcode');
let pCode = document.createElement('p');
pCode.textContent = "incorrect Zip Code"
pCode.style.color = 'red';

zipCode.addEventListener('blur', function (event) {
  const saisie = event.target.value;
  if (/^\d+$/.test(saisie)) { // Vérifie si la saisie contient uniquement des chiffres
    if (zipCode.nextSibling === pCode) {
      pCode.remove();
    }
  } else {
    if (zipCode.nextSibling !== pCode) {
      zipCode.parentNode.insertBefore(pCode, zipCode.nextSibling);
    }
  }
});

const main = document.querySelector('main');
const button = document.getElementById('button');
const form = document.getElementById('form');
const message = document.createElement('h2');
message.textContent = "Thank you for your order";

button.addEventListener('click', function(event) {
    event.preventDefault();

    // Collecte les données du formulaire
    const formData = new FormData(form);

    // Envoie les données du formulaire au serveur en utilisant AJAX
    fetch('Checkout.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        // Affiche la réponse du serveur dans la console
        console.log('Response from server:', data);

        // Affiche un message de confirmation sur la page
        form.style.display = 'none';
        main.appendChild(message);
    })
    .catch(error => {
        console.error('Error:', error);
    });
});

