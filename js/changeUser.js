const boutonMail = document.getElementsByName("btnChangeEmail")[0];
const boutonUser = document.getElementsByName("btnChangeUser")[0];
const boutonMdp = document.getElementsByName("btnChangeMdp")[0];
const vieuxMdp = document.getElementsByName("vMdp")[0];
const boutonCancelMdp = document.getElementsByName("cancelBtnMdp")[0];
const boutonCancelUser = document.getElementsByName("cancelBtnUser")[0];
const boutonCancelEmail = document.getElementsByName("cancelBtnEmail")[0];
const boutonModifier = document.getElementsByName("bouton_modifier");

//Si on clique sur le bouton on affiche le formulaire.

boutonMail.addEventListener("click", function(e){
    document.getElementById('emailChange').style.display='block'
});

boutonUser.addEventListener("click", function(e){
    document.getElementById('userChange').style.display='block'
});

boutonMdp.addEventListener("click", function(e){
    document.getElementById('mdpChange').style.display='block'
});

//Si on clique sur le bouton on cache le formulaire

boutonCancelUser.addEventListener("click", function(e){
    document.getElementById('userChange').style.display='none'
});

boutonCancelMdp.addEventListener("click", function(e){
    document.getElementById('mdpChange').style.display='none'
});

boutonCancelEmail.addEventListener("click", function(e){
    document.getElementById('emailChange').style.display='none'
});

$(function() {
    if (localStorage.getItem('form-select')) {
        $("#form-select option").eq(localStorage.getItem('form_select')).prop('selected', true);
    }

    $("#form_select").on('change', function() {
        localStorage.setItem('form_select', $('option:selected', this).index());
    });
})
