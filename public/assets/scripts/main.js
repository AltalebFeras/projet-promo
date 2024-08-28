function validateFormAjouterPersonnel() {
  const errorMessages = document.getElementById("errorMessages");
  errorMessages.style.display = "none";
  errorMessages.innerHTML = "";

  const nom = document.getElementById("nom").value.trim();
  const prenom = document.getElementById("prenom").value.trim();
  const dateArrivee = document.getElementById("date_arrive").value;
  const telephone = document.getElementById("telephone").value;
  const email = document.getElementById("email").value.trim();
  const mdp = document.getElementById("mdp").value;
  const dateDebutStatut = document.getElementById("date_debut").value;
  const dateFinStatut = document.getElementById("date_fin").value;

  const nameRegex = /^[A-Za-zÀ-ÖØ-öø-ÿ\s'-]+$/;
  if (!nameRegex.test(nom)) {
    errorMessages.innerHTML +=
      "<p>Le nom ne doit contenir que des lettres, espaces, tirets ou apostrophes.</p>";
  }
  if (!nameRegex.test(prenom)) {
    errorMessages.innerHTML +=
      "<p>Le prénom ne doit contenir que des lettres, espaces, tirets ou apostrophes.</p>";
  }

  const telRegex = /^[0-9]{10}$/;
  if (!telRegex.test(telephone)) {
    errorMessages.innerHTML +=
      "<p>Le numéro de téléphone doit contenir exactement 10 chiffres.</p>";
  }

  if (!email) {
    errorMessages.innerHTML +=
      "<p>Veuillez entrer une adresse email valide.</p>";
  }

  if (mdp.length < 8) {
    errorMessages.innerHTML +=
      "<p>Le mot de passe doit contenir au moins 6 caractères.</p>";
  }

  if (dateDebutStatut && dateFinStatut && dateFinStatut < dateDebutStatut) {
    errorMessages.innerHTML +=
      "<p>La date de fin de statut ne peut pas être avant la date de début.</p>";
  }

  if (errorMessages.innerHTML) {
    errorMessages.style.display = "block";
    return false;
  }

  return true;
}

// Validate Personnel Details Forms
function validatePersonnelDetailsForm() {
  const errorMessages = document.getElementById("errorMessages");
  errorMessages.style.display = "none";
  errorMessages.innerHTML = "";

  const nom = document.getElementById("nom").value.trim();
  const prenom = document.getElementById("prenom").value.trim();
  const dateArrivee = document.getElementById("date_arrive").value;
  const telephone = document.getElementById("telephone").value;

  const nameRegex = /^[A-Za-zÀ-ÖØ-öø-ÿ\s'-]+$/;
  if (!nameRegex.test(nom)) {
    errorMessages.innerHTML +=
      "<p>Le nom ne doit contenir que des lettres, espaces, tirets ou apostrophes.</p>";
  }
  if (!nameRegex.test(prenom)) {
    errorMessages.innerHTML +=
      "<p>Le prénom ne doit contenir que des lettres, espaces, tirets ou apostrophes.</p>";
  }

  if (!/^\d{10}$/.test(telephone)) {
    errorMessages.innerHTML +=
      "<p>Le numéro de téléphone doit contenir exactement 10 chiffres.</p>";
  }

  if (errorMessages.innerHTML !== "") {
    errorMessages.style.display = "block";
    return false; // Prevent form submission
  }
  return true; // Allow form submission
}

// Validate Change Status Form
function validateChangeStatusForm() {
  const statut = document.getElementById("statut").value;
  const dateDebut = document.getElementById("date_debut").value;
  const dateFin = document.getElementById("date_fin").value;

  const errorMessages = document.getElementById("errorMessages");
  errorMessages.style.display = "none";
  errorMessages.innerHTML = "";

  if (!statut) {
    errorMessages.innerHTML += "<p>Veuillez sélectionner un statut.</p>";
  }
  if (!dateDebut) {
    errorMessages.innerHTML +=
      "<p>Veuillez sélectionner une date de début.</p>";
  }
  if (dateDebut && dateFin && dateDebut > dateFin) {
    errorMessages.innerHTML +=
      "<p>La date de début ne peut pas être après la date de fin.</p>";
  }

  if (errorMessages.innerHTML !== "") {
    errorMessages.style.display = "block";
    return false; // Prevent form submission
  }
  return true; // Allow form submission
}

// Validate Evaluation Form
function validateEvaluationForm() {
  const texte = document.getElementById("texte").value.trim();

  const errorMessages = document.getElementById("errorMessages");
  errorMessages.style.display = "none";
  errorMessages.innerHTML = "";

  if (texte.length < 10) {
    errorMessages.innerHTML +=
      "<p>L'évaluation doit contenir au moins 10 caractères.</p>";
  }

  if (errorMessages.innerHTML !== "") {
    errorMessages.style.display = "block";
    return false; // Prevent form submission
  }
  return true; // Allow form submission
}

// Confirm Delete Personnel
function confirmDeletePersonnel() {
  return confirm(
    "Êtes-vous sûr de vouloir supprimer ce personnel ? Cette action est irréversible."
  );
}

function UpdateCT() {
  return confirm("Are you sure you want to update?");
}

function validateFormAjouterPersonnel() {
  const texte = document.getElementById("texte").value.trim();

  const errorMessages = document.getElementById("errorMessages");
  errorMessages.style.display = "none";
  errorMessages.innerHTML = "";

  if (texte.length < 10) {
    errorMessages.innerHTML +=
      "<p>L'évaluation doit contenir au moins 10 caractères.</p>";
  }
  if (texte.length > 250) {
    errorMessages.innerHTML +=
      "<p>L'évaluation ne peut dépasser 250 caractères.</p>";
  }
  if (errorMessages.innerHTML !== "") {
    errorMessages.style.display = "block";
    return false; // Prevent form submission
  }
  return true; // Allow form submission
}
