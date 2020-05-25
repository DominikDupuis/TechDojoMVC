//Validation des formulaires de connexion et d'inscription.
const boutton = document.getElementsByName('reg_user')[0];
const userSignUp = document.getElementById('user');
const userSignUpError = document.querySelector('#user + span.error');
const passSignUp = document.getElementById('pass');
const passSignUpError = document.querySelector('#pass + span.error');
const passConfSignUp = document.getElementById('passConf');
const passConfSignUpError = document.querySelector('#passConf + span.error');
const emailSignUp = document.getElementById('email');
const emailSignUpError = document.querySelector('#email + span.error');

//Vérification lorsqu'on quitte les champs
userSignUp.addEventListener('focusout', function(e){
    if (userSignUp.validity.valid){
        userSignUpError.innerHTML = '';
        userSignUpError.className = 'error';
    } else{
        showErrorUser();
    }
});

passSignUp.addEventListener('focusout', function(e){
    if (passSignUp.value.length <= 12 && passSignUp.value.length >= 6){
        passSignUpError.innerHTML = '';
        passSignUpError.className = 'error';
    } else{
        showErrorPass();
    }
});

passConfSignUp.addEventListener('focusout', function(e){
    if (passConfSignUp.value === passSignUp.value && passConfSignUp.validity.valid){
        passConfSignUpError.innerHTML = '';
        passConfSignUpError.className = 'error';
    } else{
        showErrorPassConf();
    }
});

emailSignUp.addEventListener('focusout', function(e){
    if (emailSignUp.validity.valid){
        emailSignUpError.innerHTML = '';
        emailSignUpError.className = 'error';
    } else{
        showErrorEmail();
    }
});

boutton.addEventListener('click', function (e) {
    // Si nous avons pas d'erreur, nous soumettons le formulaire
    if(!userSignUp.validity.valid || !passSignUp.validity.valid || !passConfSignUp.validity.valid || !emailSignUp.validity.valid) {
      // sinon on affiche les erreurs
      showError();
      // et on empêche le formulaire de s'envoyer.
      e.preventDefault()
    }
});

function showError() {
    showErrorUser();
    showErrorPass();
    showErrorPassConf();
    showErrorEmail();
}


//Fonction qui sert à afficher les messages d'erreurs à chaque champs spécifiques.
function showErrorUser(){
    if(userSignUp.validity.valueMissing) {
        // Si le champ est vide
        // on affiche un message d'erreur.
        userSignUpError.textContent = "Vous devez choisir un nom d'utilisateur";
    }
    //On active le css du message d'erreur
    userSignUpError.className = 'error active';
}

function showErrorPass(){
    if(passSignUp.value.length < 6 || passSignUp.value.length > 12) {
        passSignUpError.textContent = "Votre mot de passe doit comporter entre 6 et 12 caractères";
    }
    passSignUpError.className = 'error active';
}

function showErrorPassConf(){
    if(passSignUp != passConfSignUp) {
        passConfSignUpError.textContent = "Les deux mot de passe ne correspondent pas";
    } else if (passConfSignUp.validity.valueMissing){
        passConfSignUpError.textContent = "Veuillez confirmer votre mot de passe";
    }
    passConfSignUpError.className = 'error active';
}
function showErrorEmail(){
    if(emailSignUp.validity.typeMismatch) {
        emailSignUpError.textContent = "Ceci n'est pas une adresse courriel valide";
    }else if(emailSignUp.validity.valueMissing){
        emailSignUpError.textContent = "Veuillez entrez une adresse courriel";
    }
    emailSignUpError.className = 'error active';
}
