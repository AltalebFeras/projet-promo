function validateFormAjouterPersonnel() {
  const errorMessages = document.getElementById("errorMessages");
  errorMessages.style.display = "none";
  errorMessages.innerHTML = "";

  const nom = document.getElementById("nom").value.trim();
  const prenom = document.getElementById("prenom").value.trim();
  const dateArrivee = document.getElementById("date_arrive").value;
  const telephone = document.getElementById("telephone").value.trim();
  const email = document.getElementById("email").value.trim();
  const mdp = document.getElementById("mdp").value;
  const statut = document.getElementById("Id_statut").value;
  const dateDebut = document.getElementById("date_debut").value;
  const dateFin = document.getElementById("date_fin").value;

  const nameRegex = /^[A-Za-zÀ-ÖØ-öø-ÿ\s'-]+$/;

  if (!nameRegex.test(nom)) {
    errorMessages.innerHTML +=
      "<p>Le nom ne doit contenir que des lettres, espaces, tirets ou apostrophes.</p>";
  }
  if (!nameRegex.test(prenom)) {
    errorMessages.innerHTML +=
      "<p>Le prénom ne doit contenir que des lettres, espaces, tirets ou apostrophes.</p>";
  }

  const telRegex = /^(?:\+33\s?|0)[1-9](?:[\s.-]?[0-9]{2}){4}$/;

  if (!telRegex.test(telephone)) {
    errorMessages.innerHTML +=
      "<p>Le numéro de téléphone doit être au format français valide.</p>";
  }

  if (!email) {
    errorMessages.innerHTML +=
      "<p>Veuillez entrer une adresse email valide.</p>";
  }

  if (mdp.length < 8) {
    errorMessages.innerHTML +=
      "<p>Le mot de passe doit contenir au moins 8 caractères.</p>";
  }

  // Conditional validation for statut
  if (statut != "1") {
    // Status other than 'present'
    if (!dateDebut) {
      errorMessages.innerHTML +=
        "<p>Veuillez sélectionner une date de début.</p>";
    }
    if (!dateFin) {
      errorMessages.innerHTML +=
        "<p>Veuillez sélectionner une date de fin.</p>";
    }

    // to ensure that the start date is before the end date
    if (dateDebut && dateFin && dateDebut > dateFin) {
      errorMessages.innerHTML +=
        "<p>La date de début ne peut pas être après la date de fin.</p>";
    }
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
  const telRegex = /^(?:\+33\s?|0)[1-9](?:[\s.-]?[0-9]{2}){4}$/;

  if (!telRegex.test(telephone)) {
    errorMessages.innerHTML +=
      "<p>Le numéro de téléphone doit être au format français valide.</p>";
  }

  if (errorMessages.innerHTML !== "") {
    errorMessages.style.display = "block";
    return false;
  }
  return true;
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

  if (statut == 1) {
    // Reset and hide the date fields if the status is 'present' (1)
    document.getElementById("date_debut").value = "";
    document.getElementById("date_fin").value = "";
    document.getElementById("divForStatusDates").style.display = "none";
  } else {
    // Show the date fields and validate them if the status is not 'present' (1)
    document.getElementById("divForStatusDates").style.display = "block";
    if (!dateDebut) {
      errorMessages.innerHTML +=
        "<p>Veuillez sélectionner une date de début.</p>";
    }

    if (!dateFin) {
      errorMessages.innerHTML +=
        "<p>Veuillez sélectionner une date de fin.</p>";
    }

    if (dateDebut && dateFin && dateDebut > dateFin) {
      errorMessages.innerHTML +=
        "<p>La date de début ne peut pas être après la date de fin.</p>";
    }
  }

  if (errorMessages.innerHTML !== "") {
    errorMessages.style.display = "block";
    return false;
  }
  return true;
}

// Toggle Date Fields on Status Change
function toggleDateFields() {
  const statut = document.getElementById("statut").value;

  if (statut == 1) {
    document.getElementById("divForStatusDates").style.display = "none";
    document.getElementById("date_debut").value = "";
    document.getElementById("date_fin").value = "";
  } else {
    document.getElementById("divForStatusDates").style.display = "block";
  }
}
function toggleDateFieldsOnAjouterPersonnel() {
  const statut = document.getElementById("Id_statut").value;

  // i did this using bootstrap class
  if (statut == 1) {
    // 'Présent' status
    document.getElementById("divForStatusDates").classList.add("d-none");
    document.getElementById("date_debut").value = "";
    document.getElementById("date_fin").value = "";
  } else {
    document.getElementById("divForStatusDates").classList.remove("d-none");
  }
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
  if (texte.length > 250) {
    errorMessages.innerHTML +=
      "<p>L'évaluation ne peut dépasser 250 caractères.</p>";
  }

  if (errorMessages.innerHTML !== "") {
    errorMessages.style.display = "block";
    return false;
  }
  return true;
}

// Confirm Delete Personnel
function confirmDeletePersonnel() {
  return confirm(
    "Êtes-vous sûr de vouloir supprimer ce personnel ? Cette action est irréversible."
  );
}

function UpdateCT() {
  return confirm("Êtes-vous sûr de vouloir mettre à jour ?");
}

function validateFormAjouterCommentaire() {
  const texte = document.getElementById("texte").value.trim();

  const errorMessages = document.getElementById("errorMessagesForComments");
  errorMessages.style.display = "none";
  errorMessages.innerHTML = "";

  if (texte.length < 10) {
    errorMessages.innerHTML +=
      "<p>Le commentaire doit contenir au moins 10 caractères.</p>";
  }
  if (texte.length > 250) {
    errorMessages.innerHTML +=
      "<p>Le commentaire ne peut dépasser 250 caractères.</p>";
  }
  if (errorMessages.innerHTML !== "") {
    errorMessages.style.display = "block";
    return false;
  }
  return true;
}

function restrictDateInputs() {
  const today = new Date();

  // Calculate the minimum date (1 month before today)
  const minDate = new Date(today);
  minDate.setMonth(minDate.getMonth() - 1);

  // Calculate the maximum date (2 months after today)
  const maxDate = new Date(today);
  maxDate.setMonth(maxDate.getMonth() + 2);

  const minDateString = minDate.toISOString().split("T")[0];
  const maxDateString = maxDate.toISOString().split("T")[0];

  const dateInputs = document.querySelectorAll('input[type="date"]');

  // Set the min and max  for each date input in the project
  dateInputs.forEach(function (input) {
    input.setAttribute("min", minDateString);
    input.setAttribute("max", maxDateString);
  });
}

window.onload = restrictDateInputs;
