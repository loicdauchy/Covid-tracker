<h1 style="font-size:4rem;">Covid Tracker</h1>
<p style="width:60%; font-size:1.6rem;">Ce plugin vous permettra d'afficher un tableau qui contiendra tout les chiffres lié au covid
   dans toutes les régions et départements de france. Vous avez la possibilité d'afficher ce 
   tableau ou bon vous semble sur votre site WordPress en placant les <b style="color:red;">ShortCode</b> 
   ci-dessous la page de votre choix.
</p>

<h4 style="font-size:2rem;">Générateur de shortCode :</h4>

<div style="display:flex;justify-content:flex-start;align-items:center;">
<select name='choose' id='generateShortCode' style="margin-right:10px;">
    <option value='departement'>Afficher un département choisi</option>
    <option value='region'>Afficher une région choisie</option>
    <option value='departements'>Afficher tous les départements</option>
    <option value='regions'>Afficher toutes les régions</option>
    <option value='recherche'>Tout afficher avec des outils de recherche pour l'utilisateur</option>         
</select>
<button id="generate">Afficher</button>
</div>
<div style="display:flex;justify-content:flex-start;align-items:center; margin-top:20px;">
    <textarea id="shortcode" style="font-size:1.5rem;margin-right:10px;"></textarea> 
    <button id="copy">Copier</button>
</div>
<p id="congrat" style="padding:10px;background:rgba(0, 128, 0, 0.664);color:white; width:20%; display:flex;justify-content:center;align-items:center;opacity:0;transition:0.1s linear;">Votre ShortCode à bien était copié ! =)</p>
<script>
    var select = document.getElementById("generateShortCode");
    var shortcode = document.getElementById('shortcode');
    document.getElementById('generate').addEventListener('click', function(){
        if(select.value == 'departement'){
            shortcode.innerHTML = '[departement s="Département de votre choix"]';
        }else if(select.value == 'region'){
            shortcode.innerHTML = '[region s="Région de votre choix"]';
        }
        else if(select.value == 'departements'){
            shortcode.innerHTML = '[departements]';
        }
        else if(select.value == 'regions'){
            shortcode.innerHTML = '[regions]';
        }
        else if(select.value == 'recherche'){
            shortcode.innerHTML = '[CoviT]';
        }
    })

    function copy() {
    var copyText = document.querySelector("#shortcode");
    copyText.select();
    document.execCommand("copy");
    document.getElementById('congrat').classList.add('opa');
    setTimeout(function(){
        document.getElementById('congrat').classList.remove('opa');
    }, 1500)
    }
    document.querySelector("#copy").addEventListener("click", copy);
</script>
<style>
    .opa{
        opacity:100% !important;
        transition: 0s linear !important;
    }
</style>