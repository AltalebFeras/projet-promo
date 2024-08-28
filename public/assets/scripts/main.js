function UpdateCT() {
    return confirm("Are you sure you want to update?");
}
function confirmDelete() {
    return confirm("Êtes-vous sûr de vouloir supprimer ce personnel ?");
}
function validateForm() {
    const errorMessages = document.getElementById('errorMessages');
    errorMessages.style.display = 'none';
    errorMessages.innerHTML = '';

    const nom = document.getElementById('nom').value.trim();
    const prenom = document.getElementById('prenom').value.trim();
    const dateArrivee = document.getElementById('date_arrive').value;
    const telephone = document.getElementById('telephone').value;
    const email = document.getElementById('email').value.trim();
    const mdp = document.getElementById('mdp').value;
    const dateDebutStatut = document.getElementById('date_debut').value;
    const dateFinStatut = document.getElementById('date_fin').value;

    // Check that the name and surname contain only letters
    const nameRegex = /^[A-Za-zÀ-ÖØ-öø-ÿ\s'-]+$/;
    if (!nameRegex.test(nom)) {
        errorMessages.innerHTML += "<p>Le nom ne doit contenir que des lettres, espaces, tirets ou apostrophes.</p>";
    }
    if (!nameRegex.test(prenom)) {
        errorMessages.innerHTML += "<p>Le prénom ne doit contenir que des lettres, espaces, tirets ou apostrophes.</p>";
    }


    // Check that the telephone number is 10 digits
    const telRegex = /^[0-9]{10}$/;
    if (!telRegex.test(telephone)) {
        errorMessages.innerHTML += "<p>Le numéro de téléphone doit contenir exactement 10 chiffres.</p>";
    }

    // Ensure the email is in a valid format (HTML5 input type="email" already does this)
    if (!email) {
        errorMessages.innerHTML += "<p>Veuillez entrer une adresse email valide.</p>";
    }

    // Ensure the password is at least 8 characters long
    if (mdp.length < 8) {
        errorMessages.innerHTML += "<p>Le mot de passe doit contenir au moins 6 caractères.</p>";
    }

    // If both date_debut and date_fin are provided, ensure that date_fin is after date_debut
    if (dateDebutStatut && dateFinStatut && dateFinStatut < dateDebutStatut) {
        errorMessages.innerHTML += "<p>La date de fin de statut ne peut pas être avant la date de début.</p>";
    }

    if (errorMessages.innerHTML) {
        errorMessages.style.display = 'block';
        return false; 
    }

    return true; 
}