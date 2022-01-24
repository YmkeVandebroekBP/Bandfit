<?php get_header(); ?>

<?php
$users = get_users( $args );
echo '<div id="profiel-head">';
	echo '<img id="profiel-omslagfoto" src="/wp-content/themes/bandfit/img/bandfit-omslag.png">';
	echo '<div id="profiel-profielfoto-container">';
  		echo '<img id="profiel-profielfoto" src=' . the_field('profiel_profielfoto', $users[0]) .'>';
  	echo '</div>';
  	echo '<div id="profiel-info-container">';
  		echo '<h1 id="profiel-naam">' . the_field('bandpagina_bandnaam', $users[0]) . '</h1>';
  		echo '<h4 id="profiel-stad">' . the_field('bandpagina_stad', $users[0]) . '</h4>';
  	echo '</div>';
echo '</div>'; 

echo '<ul>';
function getSubscriberUserData(){
$DBRecord = array();
$args = array(
    'role'    => 'Subscriber',
    'orderby' => 'first_name',
    'order'   => 'ASC'
);
$users = get_users( $args );
$teller = 0;
foreach ( $users as $user )
  {
  $DBRecord[$teller]['role']           = "Subscriber";   
  $DBRecord[$teller]['WPId']           = $user->ID;  
  $DBRecord[$teller]['FirstName']      = $user->first_name;
  $DBRecord[$teller]['LastName']       = $user->last_name;
  $DBRecord[$teller]['Email']          = $user->user_email;

  $UserData    						   = get_user_meta( $user->ID );  
  $DBRecord[$teller]['Profielfoto']    = the_field('profiel_profielfoto', $user);

  echo '<li>'; 
  	echo '<h2>' . $DBRecord[$teller]['FirstName'] . ' ' . $DBRecord[$teller]['LastName'] . '</h2>';
  	echo '<img src="'. $DBRecord[$teller]['Profielfoto'] .'">';
  echo '</li>';

  $teller++; 
  }
}

getSubscriberUserData();

echo '</ul>';

?>
<?php get_footer(); ?>