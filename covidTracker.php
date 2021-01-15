<?php 
/**
* Plugin Name: Covid Tracker
**/
session_start();

// DEFINED ABSPATH
if(!defined('ABSPATH')){
    define('ABSPATH', dirname(__FILE__) . '/');
}
// CREATE TABLE
include_once("assets/public/db_CT.php");
register_activation_hook(__FILE__,"DBP_tb_create");
// INSERT VALUE INTO TABLE
include_once("assets/public/dataAdd.php");
register_activation_hook(__FILE__,"addDB");
// CALL SHORTCODE
add_shortcode('CoviT', 'CT');
add_shortcode('regions', 'regionShowSC');
add_shortcode('region', 'selectRegion');
add_shortcode('departements', 'departementShowSC');
add_shortcode('departement', 'selectDep');

// MAIN SHORTCODE FUNCTION
function CT(){
    
    echo ("
        <div id='CT'>
        <input type='hidden' id='dir' value='".plugin_dir_url(__FILE__).'vue/filterCT.php'."'>
        <input type='hidden' id='reg' value='".plugin_dir_url(__FILE__).'vue/region.php'."'>
        <input type='hidden' id='dep' value='".plugin_dir_url(__FILE__).'vue/departement.php'."'>
        <input type='hidden' id='all' value='".plugin_dir_url(__FILE__).'vue/all.php'."'>
        <input type='hidden' id='direction' value='".plugin_dir_url(__FILE__).'vue/regionQty.php'."'>
        <input type='hidden' id='direction2' value='".plugin_dir_url(__FILE__).'vue/departementQty.php'."'>
        <input type='hidden' id='direction3' value='".plugin_dir_url(__FILE__).'vue/allQty.php'."'>
        <input type='hidden' id='adminAjaxDir' value='".site_url().'/wp-admin/admin-ajax.php'."'>
        <div class='flex'>
        <input  type='text' value='' id='search' placeholder='Search department'>
        <button id='submit' class='btn btn-primary'>Search</button>
        </div>
        <div class='flex'>
            <select name='choose' id='chooseOption'>
                <option value='all'>Tout</option>
                <option value='Regions'>Régions</option>
                <option value='Departements'>Départements</option>      
            </select>
        </div>

        <div class='flex'>
            <select name='choose' id='chooseOptionNb'>
                <option value='hospitalises'>Hospitalisés</option>
                <option value='reanimation'>Réanimations</option>
                <option value='nouvellesHospitalisations'>Nouvelles Hospitalisations</option>
                <option value='nouvellesReanimations'>Nouvelles Réanimations</option>
                <option value='gueris'>Guéris</option>  
                <option value='deces'>décédé</option>        
            </select>

            <select name='choose' id='infsup'>
                <option value='<'><</option>
                <option value='>'>></option>        
            </select>

            <input type='number' id='nbChoice'>

            <button id='submit2' class='btn btn-primary'>Search</button>
            <button id='submit3' class='btn btn-primary'>Search</button>
        </div>

            <table class='blueTable'>
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>hospitalises</th>
                        <th>gueris</th>
                        <th>deces</th>
                        <th>nouvelles Hospitalisations</th>
                        <th>nouvelles Reanimations</th>
                        <th>reanimation</th>
                    </tr>
                </thead>
                
                <tbody id='tbody'>
                    
                </tbody>
            </table>
        </div>
    ");
    wp_enqueue_script('appCT', plugin_dir_url(__FILE__) . 'assets/JS/appCT.js');
    wp_enqueue_style('styleCT', plugin_dir_url(__FILE__) . 'assets/CSS/styleCT.css');

    // function pw_loading_scripts_wrong() {
    //     echo '<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>';
    //     echo '<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">';
    // }
    // add_action('admin_head', 'pw_loading_scripts_wrong');
    
	wp_enqueue_script( 'ajax', plugin_dir_url(__FILE__) . 'assets/JS/ajax.js');
    wp_localize_script( 'ajax', 'adminAjax', admin_url( 'admin-ajax.php' ) );
    
}

// REGIONS SHORTCODE FUNCTION
function regionShowSC(){

    include('assets/public/connect.php');

    echo ("
        <div id='CT'>
            <table class='blueTable'>
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>hospitalises</th>
                        <th>gueris</th>
                        <th>deces</th>
                        <th>nouvelles Hospitalisations</th>
                        <th>nouvelles Reanimations</th>
                        <th>reanimation</th>
                    </tr>
                </thead>
                
                <tbody id='tbody'>");
                $s = $db->prepare("SELECT * FROM wp_dbp_tb_ct WHERE code LIKE '%REG%'");
                $s->execute();
                $s = $s->fetchALL(PDO::FETCH_ASSOC);
                for($i = 0; $i < count($s); $i++){
                    echo "<tr id='tr".($i+1)."'>";
                    echo "<td>".$s[$i]['nom']."</td>";
                    echo "<td>".$s[$i]['hospitalises']."</td>";
                    echo "<td>".$s[$i]['gueris']."</td>";
                    echo "<td>".$s[$i]['deces']."</td>";
                    echo "<td>".$s[$i]['nouvellesHospitalisations']."</td>";
                    echo "<td>".$s[$i]['nouvellesReanimations']."</td>";
                    echo "<td>".$s[$i]['reanimation']."</td>";
                    echo "</tr>";
                }                 
           echo ("</tbody>
            </table>
        </div>
    ");

    wp_enqueue_script('appCT', plugin_dir_url(__FILE__) . 'assets/JS/appCT.js');
    wp_enqueue_style('styleCT', plugin_dir_url(__FILE__) . 'assets/CSS/styleCT.css');
}

// DEPARTEMENTS SHORTCODE FUNCTION
function departementShowSC(){

    include('assets/public/connect.php');

    echo ("
        <div id='CT'>
            <table class='blueTable'>
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>hospitalises</th>
                        <th>gueris</th>
                        <th>deces</th>
                        <th>nouvelles Hospitalisations</th>
                        <th>nouvelles Reanimations</th>
                        <th>reanimation</th>
                    </tr>
                </thead>
                
                <tbody id='tbody'>");
                $s = $db->prepare("SELECT * FROM wp_dbp_tb_ct WHERE code LIKE '%DEP%'");
                $s->execute();
                $s = $s->fetchALL(PDO::FETCH_ASSOC);
                for($i = 0; $i < count($s); $i++){
                    echo "<tr id='tr".($i+1)."'>";
                    echo "<td>".$s[$i]['nom']."</td>";
                    echo "<td>".$s[$i]['hospitalises']."</td>";
                    echo "<td>".$s[$i]['gueris']."</td>";
                    echo "<td>".$s[$i]['deces']."</td>";
                    echo "<td>".$s[$i]['nouvellesHospitalisations']."</td>";
                    echo "<td>".$s[$i]['nouvellesReanimations']."</td>";
                    echo "<td>".$s[$i]['reanimation']."</td>";
                    echo "</tr>";
                }                 
           echo ("</tbody>
            </table>
        </div>
    ");

    wp_enqueue_script('appCT', plugin_dir_url(__FILE__) . 'assets/JS/appCT.js');
    wp_enqueue_style('styleCT', plugin_dir_url(__FILE__) . 'assets/CSS/styleCT.css');
}

// REGION SHORTCODE FUNCTION
function selectRegion($atts){

    include('assets/public/connect.php');
    $s = isset($atts['s']) ? $atts['s'] : '';

    echo ("
        <div id='CT'>
            <table class='blueTable'>
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>hospitalises</th>
                        <th>gueris</th>
                        <th>deces</th>
                        <th>nouvelles Hospitalisations</th>
                        <th>nouvelles Reanimations</th>
                        <th>reanimation</th>
                    </tr>
                </thead>
                
                <tbody id='tbody'>");
                $search = $db->prepare("SELECT * FROM wp_dbp_tb_ct WHERE code LIKE '%REG%' AND nom LIKE '%$s%' LIMIT 1");
                $search->execute();
                $search = $search->fetch(PDO::FETCH_ASSOC);
            
                    echo "<tr id='tr1'>";
                    echo "<td>".$search['nom']."</td>";
                    echo "<td>".$search['hospitalises']."</td>";
                    echo "<td>".$search['gueris']."</td>";
                    echo "<td>".$search['deces']."</td>";
                    echo "<td>".$search['nouvellesHospitalisations']."</td>";
                    echo "<td>".$search['nouvellesReanimations']."</td>";
                    echo "<td>".$search['reanimation']."</td>";
                    echo "</tr>";
                               
           echo ("</tbody>
            </table>
        </div>
    ");

    wp_enqueue_script('appCT', plugin_dir_url(__FILE__) . 'assets/JS/appCT.js');
    wp_enqueue_style('styleCT', plugin_dir_url(__FILE__) . 'assets/CSS/styleCT.css');
}

// REGION SHORTCODE FUNCTION
function selectDep($atts){

    include('assets/public/connect.php');
    $s = isset($atts['s']) ? $atts['s'] : '';

    echo ("
        <div id='CT'>
            <table class='blueTable'>
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>hospitalises</th>
                        <th>gueris</th>
                        <th>deces</th>
                        <th>nouvelles Hospitalisations</th>
                        <th>nouvelles Reanimations</th>
                        <th>reanimation</th>
                    </tr>
                </thead>
                
                <tbody id='tbody'>");
                $search = $db->prepare("SELECT * FROM wp_dbp_tb_ct WHERE code LIKE '%DEP%' AND nom LIKE '%$s%' LIMIT 1");
                $search->execute();
                $search = $search->fetch(PDO::FETCH_ASSOC);
            
                    echo "<tr id='tr1'>";
                    echo "<td>".$search['nom']."</td>";
                    echo "<td>".$search['hospitalises']."</td>";
                    echo "<td>".$search['gueris']."</td>";
                    echo "<td>".$search['deces']."</td>";
                    echo "<td>".$search['nouvellesHospitalisations']."</td>";
                    echo "<td>".$search['nouvellesReanimations']."</td>";
                    echo "<td>".$search['reanimation']."</td>";
                    echo "</tr>";
                               
           echo ("</tbody>
            </table>
        </div>
    ");

    wp_enqueue_script('appCT', plugin_dir_url(__FILE__) . 'assets/JS/appCT.js');
    wp_enqueue_style('styleCT', plugin_dir_url(__FILE__) . 'assets/CSS/styleCT.css');
}

// ADD ACTION WHO CALL AJAX VALUE
add_action('wp_ajax_nopriv_doAjax', 'get_data');
add_action('wp_ajax_doAjax', 'get_data');
   
function get_data(){ 
   $result = json_encode($_POST['value']);  
   echo $result;
   $_SESSION['search'] = $result;
   die();
}


add_action('wp_ajax_nopriv_doAjax2', 'get_choice');
add_action('wp_ajax_doAjax2', 'get_choice');
   
function get_choice(){ 
   $result = json_encode($_POST['value2']);  
   echo $result;
   $_SESSION['choice'] = $result;
   die();
}

add_action('wp_ajax_nopriv_doAjax3', 'get_infSup');
add_action('wp_ajax_doAjax3', 'get_infSup');
   
function get_infSup(){ 
   $result = json_encode($_POST['value3']);  
   echo $result;
   $_SESSION['infSup'] = $result;
   die();
}

add_action('wp_ajax_nopriv_doAjax4', 'get_nbrChoice');
add_action('wp_ajax_doAjax4', 'get_nbrChoice');
   
function get_nbrChoice(){ 
   $result = json_encode($_POST['value4']);  
   echo $result;
   $_SESSION['nbrChoice'] = $result;
   die();
}


// View of plugin for client
add_action( 'admin_menu', 'pluginLink' );

function pluginLink()
{
add_menu_page(
'Covid Tracker - Admin',
'Covid Tracker',
'manage_options',
'covid_tracker_admin',
'covid_tracker_admin_page'
);
}

function covid_tracker_admin_page(){
require_once("vue/Covid_Tracker.php");
}


// CRON TASK
include_once('assets/public/update.php');
register_activation_hook(__FILE__, 'mon_activation');
 
function mon_activation() {
 if (! wp_next_scheduled ( 'mon_evenement' )) {
 wp_schedule_event(strtotime('20:30:00'), 'daily', 'mon_evenement');
 }
}
 
add_action('mon_evenement', 'updateDB');
?>