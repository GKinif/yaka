$(document).ready(function() {
    // Selection d'une catégorie
    $('#categorie').on('change', changeOnCat);
    // Selection d'une sous-catégorie
    $('#souscategorie').on('change', changeOnSsCat);
    // Selection d'une image
    $("input[type=file]").on('change', readURL);
    // Ajout propriété
    $('.propselect').on('change', changeOnPropriete);
    
    // remove reload from button #btnaddprop and call function createFieldPropriete
    $('#btnaddprop').on('click', function(e){
        e.preventDefault();
        createFieldPropriete();
    });
    
    // remove reload from button .btnremoveprop and call function removeFieldPropriete
    $('.btnremoveprop').on('click', function(e){
        e.preventDefault();
        removeFieldPropriete(this);
    });
    
    // remove reload from button #btnaddcombi and call function createCombi
    $('#btnaddcombi').on('click', function(e){
        e.preventDefault();
        createCombi(this);
    });
    
    // remove reload from button #btnaddcombi and call function removeCombi
    $('.btnremovecombi').on('click', function(e){
        e.preventDefault();
        console.log('event remove combi');
        removeCombi(this);
    });
    
    // remove reload from button #btnaddcombi and call function removeCombi
    $('tbody').on('click', '.btnremovecombi', function(e){
        e.preventDefault();
        console.log('test');
        removeCombi(e.target);
    });
    
    function changeOnCat(e){
        if (this.value == 'new_cat'){
            $('#new_cat').show();
        } else {
            $('#new_cat').hide();
            
            $.ajax({
                url: '/categorie/'+this.value+'/souscategorie?format=json',
                type : 'GET',
                //data: { id_caract: param },
                success: function(sscats){
                    $('#souscategorie option').remove();
                    $('<option>', {'value': 'new_sscat'}).html('Nouvelle Sous-catégorie').appendTo('#souscategorie');
                    for( var i = 0; i < sscats.length; i++){
                        $('<option>', {'value': sscats[i].slug}).html(sscats[i].nom).appendTo('#souscategorie');
                    }
                    
                }
            });
        }
    }
    
    function changeOnSsCat(e){
        if (this.value == 'new_sscat'){
            $('#new_sscat').show();
        } else {
            $('#new_sscat').hide();
        }
    }
    
    function readURL(event) {
        var input = event.target;
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $(input).closest('p').find('img').remove();
                var img = $('<img>', {'src': e.target.result, 'class': 'thumbnail'});

                $(input).parent().after(img);
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }
    
    function changeOnPropriete(e){
        if (Number(this.value) <= 0){
            $(this).closest('div.propid').next('div.propnom').show();
            // nombre de select avec une valeur negative ( egal nouvel caracteristique)
            var cpt = 0 - $('select.propselect').filter( function() {
                return Number(this.value) <= 0;
            }).length +1;
            $(this).children('option').first().val(cpt);
            console.log(cpt);
        } else {
            $(this).closest('div.propid').next('div.propnom').hide();
        }
    }
    
    function createFieldPropriete(){
        var divprop = $('#baseprop').clone(true);
        $(divprop).removeAttr('id');
        $(divprop).removeAttr('style');
        $(divprop).addClass('caracteristique');
        
        var nom = 'prop_' + $('.caracteristique').length;
        // nombre de select avec une valeur negative ( egal nouvel caracteristique)
        var cpt = $('select.propselect').filter( function() {
                return Number(this.value) < 0;
            }).length;
            
        // label, name and if for input carprop
        var propselect = $(divprop).find('.propselect')
        $(propselect).attr('id', nom + '_id').attr('name', nom + '_id');
        $(propselect).children().first().val(-1 - cpt) // -1 car il n'est pas encore inséré dans le dom
        // input text nouveau nom
        $(divprop).find('.propnom').attr('name', nom + '_name').attr('id', nom + '_name');
        
        $('#btnaddprop').before(divprop);
        //$(divprop).show();
    }
    
    function removeFieldPropriete(bouton){
        console.log(bouton);
        console.log($(bouton).closest('div.caracteristique'));
        $(bouton).closest('div.caracteristique').remove();
    }
    
    function createCombi(btn) {
        var combi = $('.combibase').clone();
        var prop = $('.combipropbase').clone();
        
        $(combi).removeAttr('style');
        $(combi).removeClass('combibase');
        $(combi).addClass('combinaison');
        
        var nbrCombi = $('.combinaison').length;
        var nom = 'combi_' + nbrCombi;
        var currentprop = 0;
        $('select.propselect').each( function() {
            if (Number(this.value) != 0) {
                if ( Number(this.value) > 0 ) {
                    // Si c'est une propriété existante on récupere le texte du select
                    var texte = $( "#" + this.id + " option:selected" ).html();
                } else {
                    // Si c'est une nouvelle propriété on récupère le texte de l'input suivant le select
                    var texte = $(this).closest('.caracteristique').find('input').val();
                }
                var prop = $('.combipropbase').clone();
                $(prop).removeAttr('style');
                $(prop).addClass('propriete');
                $(prop).removeClass('combipropbase');
                
                var re = new RegExp("prop_([0-9]+)_id");
                var propNbr = this.id.match(re);
                $(prop).find('label').html(texte).attr('for', nom + '_idprop_' + propNbr[1] + '_val');
                $(prop).find('input').attr('id', nom + '_idprop_' + propNbr[1] + '_val').attr('name', nom + '_idprop_' + propNbr[1] + '_val');
                
                $(combi).find('.combiprix').before(prop);
            } else {
                console.log('Erreur id select');
            }
            
           currentprop = currentprop + 1;
        });
        
        // id and name for input combiprix, combipoids et combivol
        // prix
        $(combi).find('.combiprix').find('label').attr('for', nom + '_prix');
        $(combi).find('.combiprix').find('input').attr('id', nom + '_prix').attr('name', nom + '_prix');
        // poids
        $(combi).find('.combipoids').find('label').attr('for', nom + '_poids');
        $(combi).find('.combipoids').find('input').attr('id', nom + '_poids').attr('name', nom + '_poids');
        // prix
        $(combi).find('.combivolume').find('label').attr('for', nom + '_vol');
        $(combi).find('.combivolume').find('input').attr('id', nom + '_vol').attr('name', nom + '_vol');
        $(btn).closest('tr').before(combi);
    }
    
    function removeCombi(btn) {
        console.log('function remove combi');
        console.log($(btn).closest('.combinaison'));
        $(btn).closest('.combinaison').remove();
    }
}); 