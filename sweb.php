<?php
  include('db.php');
    BaseDatos('localhost','root','','cinestar');
    //BaseDatos('localhost','id21144552_cinestar1','Patrickga2002$','id21144552_cinestar1');
    //BaseDatos('srv1101.hstgr.io','u584908256_cinestar','Senati2023@','u584908256_cinestar');  // oaemdl.es

  $id = '';
  if ( isset( $_GET["id"] ) )  $id  = $_GET["id"];
  if ( isset( $_GET["idd"] ) ) $idd = $_GET["idd"];
  if ( isset( $_GET["idx"] ) ) $idx = $_GET["idx"];
  
  if ( $id == 'cines' ) getCines();
  else if ( $id == 'peliculas' ) getPeliculas();

  function getCines () {
    global $idd;
    global $idx;
    global $_SQL;

    if ( $idx )
      $_SQL = $idx == "peliculas" ? "call sp_getCinePeliculas('$idd')" : "call sp_getCineTarifas('$idd')";
    else $_SQL = $idd ? "call sp_getCine('$idd')" : "call sp_getCines()";

    getRegistros();
  }
  
  function getPeliculas () {
    global $idd;
    global $idx;
    global $_SQL;

    if ( $idx ) {
      $idx = $idx == "cartelera" ? 1 : ( $idx == "estrenos" ? 2 : 3 );
      $_SQL = "call sp_getPeliculas('$idx')"; 
    } else $_SQL = "call sp_getPelicula('$idd')";

    getRegistros();
  }
  
?>