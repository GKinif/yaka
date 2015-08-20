$(document).ready(function() {
    
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    
    // calcul le prix au chargement de la page
    getPrix();

    // recalcul le prix à chaque changement de caractéristique
    $("#choix_caracteristique").on('change', getPrix);
    $("#ajoutpanier").on('click', ajoutPanier);

    function getPrix(){
        var param = new Array();
        var select = $('select');

        for (var index = 0; index < select.length; ++index) {        
            param.push(Number(select[index].value))
        }

        $.ajax({
            url: "/produit/prix",
            type : 'GET',
            data: { id_caract: param },
            success: function(prix){
                console.log(prix);
                $("span#prix").html(prix);
            }
        });
    };
    
    function ajoutPanier(e){
        e.preventDefault();
        
        var param = new Array();
        var select = $('select');

        for (var index = 0; index < select.length; ++index) {        
            param.push(Number(select[index].value))
        }

        $.ajax({
            url: "/panier",
            type : 'POST',
            data: { id_caract: param },
            success: function(idCombi){
                console.log(idCombi);
                $('.taillepanier').html( Number( $('.taillepanier').html() ) + 1 );
            }
        });
    };

}); 