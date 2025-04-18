// script.js - Fonctions pour l'application de Gestion des Événements

document.addEventListener('DOMContentLoaded', function() {
    // Navigation responsive
    const navbarToggler = document.querySelector('.navbar-toggler');
    const navbarCollapse = document.querySelector('.navbar-collapse');
    
    if (navbarToggler) {
        navbarToggler.addEventListener('click', function() {
            navbarCollapse.classList.toggle('show');
        });
    }
    
    // Disparition automatique des alertes
    const alerts = document.querySelectorAll('.alert');
    alerts.forEach(alert => {
        setTimeout(() => {
            if (alert) {
                fadeOut(alert);
            }
        }, 5000);
    });
    
    // Animation des cartes
    animateCards();
    
    // Validation de formulaire d'événement
    const eventForm = document.querySelector('form[action*="entity=event"]');
    if (eventForm) {
        eventForm.addEventListener('submit', validateEventForm);
    }
    
    // Validation de formulaire d'inscription
    const registerForm = document.querySelector('form[action*="entity=inscription"]');
    if (registerForm) {
        registerForm.addEventListener('submit', validateRegisterForm);
    }
    
    // Datepicker amélioré si présent
    enhanceDatePickers();
    
    // Confirmation pour suppression
    const deleteButtons = document.querySelectorAll('a[href*="action=delete"]');
    deleteButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            if (!confirm('Êtes-vous sûr de vouloir supprimer cet élément ?')) {
                e.preventDefault();
            }
        });
    });
});

// Animation pour faire apparaître les cartes
function animateCards() {
    const cards = document.querySelectorAll('.card');
    cards.forEach((card, index) => {
        setTimeout(() => {
            card.style.opacity = '1';
            card.style.transform = 'translateY(0)';
        }, 100 * index);
    });
}

// Fonction pour faire disparaître un élément en fondu
function fadeOut(element) {
    let opacity = 1;
    const timer = setInterval(function() {
        if (opacity <= 0.1) {
            clearInterval(timer);
            element.style.display = 'none';
        }
        element.style.opacity = opacity;
        opacity -= 0.1;
    }, 50);
}

// Validation du formulaire d'événement
function validateEventForm(e) {
    const titre = document.getElementById('titre');
    const dateEvenement = document.getElementById('date_evenement');
    
    let valid = true;
    
    // Reset previous error messages
    resetErrors();
    
    if (!titre.value.trim()) {
        showError(titre, 'Le titre est obligatoire');
        valid = false;
    }
    
    if (!dateEvenement.value) {
        showError(dateEvenement, 'La date est obligatoire');
        valid = false;
    } else {
        const selectedDate = new Date(dateEvenement.value);
        const now = new Date();
        
        if (selectedDate < now) {
            showError(dateEvenement, 'La date ne peut pas être dans le passé');
            valid = false;
        }
    }
    
    if (!valid) {
        e.preventDefault();
    }
}

// Validation du formulaire d'inscription
function validateRegisterForm(e) {
    const eventId = document.getElementById('event_id');
    const nom = document.getElementById('nom');
    const email = document.getElementById('email');
    
    let valid = true;
    
    // Reset previous error messages
    resetErrors();
    
    if (eventId.value === '') {
        showError(eventId, 'Veuillez sélectionner un événement');
        valid = false;
    }
    
    if (!nom.value.trim()) {
        showError(nom, 'Le nom est obligatoire');
        valid = false;
    }
    
    if (!email.value.trim()) {
        showError(email, 'L\'email est obligatoire');
        valid = false;
    } else if (!isValidEmail(email.value)) {
        showError(email, 'Veuillez entrer un email valide');
        valid = false;
    }
    
    if (!valid) {
        e.preventDefault();
    }
}

// Afficher un message d'erreur pour un champ
function showError(input, message) {
    const formGroup = input.parentElement;
    const errorDiv = document.createElement('div');
    errorDiv.className = 'invalid-feedback';
    errorDiv.innerText = message;
    
    input.classList.add('is-invalid');
    input.style.borderColor = '#dc3545';
    formGroup.appendChild(errorDiv);
}

// Réinitialiser les messages d'erreur
function resetErrors() {
    const invalidInputs = document.querySelectorAll('.is-invalid');
    const errorMessages = document.querySelectorAll('.invalid-feedback');
    
    invalidInputs.forEach(input => {
        input.classList.remove('is-invalid');
        input.style.borderColor = '';
    });
    
    errorMessages.forEach(msg => msg.remove());
}

// Validation d'email
function isValidEmail(email) {
    const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return re.test(email);
}

// Amélioration des champs de date
function enhanceDatePickers() {
    const datePickers = document.querySelectorAll('input[type="date"]');
    
    datePickers.forEach(picker => {
        // Ajouter des attributs et styles pour améliorer l'apparence
        picker.setAttribute('placeholder', 'JJ/MM/AAAA');
        
        // Définir la date minimale (aujourd'hui)
        const today = new Date().toISOString().split('T')[0];
        picker.setAttribute('min', today);
    });
}

// Effet de défilement fluide pour les ancres
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        
        const targetId = this.getAttribute('href');
        if (targetId === '#') return;
        
        const targetElement = document.querySelector(targetId);
        if (targetElement) {
            window.scrollTo({
                top: targetElement.offsetTop - 100,
                behavior: 'smooth'
            });
        }
    });
});

// Effet de fluidité pour les tableaux responsifs
window.addEventListener('resize', function() {
    const tables = document.querySelectorAll('.table');
    tables.forEach(table => {
        if (window.innerWidth < 768 && !table.parentElement.classList.contains('table-responsive')) {
            const wrapper = document.createElement('div');
            wrapper.className = 'table-responsive';
            table.parentNode.insertBefore(wrapper, table);
            wrapper.appendChild(table);
        }
    });
});

// Initialiser les tableaux responsifs au chargement
document.addEventListener('DOMContentLoaded', function() {
    if (window.innerWidth < 768) {
        const tables = document.querySelectorAll('.table');
        tables.forEach(table => {
            if (!table.parentElement.classList.contains('table-responsive')) {
                const wrapper = document.createElement('div');
                wrapper.className = 'table-responsive';
                table.parentNode.insertBefore(wrapper, table);
                wrapper.appendChild(table);
            }
        });
    }
});