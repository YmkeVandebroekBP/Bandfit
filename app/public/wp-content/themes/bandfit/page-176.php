<?php get_header(); ?>
<?php  
$user = wp_get_current_user();
?>

<div id="profiel-head">
	<img id="profiel-omslagfoto" src=<?php the_field('bandpagina_omslagfoto', $user); ?>>
	<div id="profiel-profielfoto-container">
		<img id="profiel-profielfoto" src=<?php the_field('bandpagina_profielfoto', $user); ?>>
	</div>
	<div id="profiel-info-container">
		<h1 id="profiel-naam"><?php the_field('bandpagina_bandnaam', $user)?></h1>
		<h4 id="profiel-stad"><?php the_field('bandpagina_stad', $user)?></h4>
	</div>
</div>

<div id="profiel-body">
<div id="profiel-content">
	<p id="profiel-biografie"><?php the_field('bandpagina_biografie', $user); ?></p>
	<div class="blok gecentreerde-blok-container">
		<h2 class="h2-center gecentreerde-titel">Zoektocht</h2>
		<ul class="oplijsting">
			<li><?php the_field('bandpagina_bandsoort', $user); ?></li>	
			<li><?php the_field('bandpagina_genre', $user); ?></li>
			<li><?php the_field('bandpagina_zoektocht', $user); ?></li>	
		</ul>
	</div>

	<div class="blok gecentreerde-blok-container">
		<h2 class="h2-center gecentreerde-titel">Live performance</h2>
		<video id="band-liveperformancevideo" controls>
			<source src=<?php the_field('bandpagina_liveperformancevideo', $user); ?>>
        </video>
	</div>

	<div class="blok gecentreerde-blok-container gekleurd-blok">
		<h2 id="band-auditite-titel" class="h2-center gecentreerde-titel">Auditie</h2>
		<p><?php the_field('bandpagina_auditie_beschrijving', $user); ?></p>
		<p class="tekst-accent">Ons verzoeknummer is: <?php the_field('bandpagina_auditie_keuzenummer', $user);  ?> </p>
		<p>Stuur je eigen interpretatie van dit nummer in en wie weet word je geselecteerd!</p>
		<a href="mailto:<?php the_field('bandpagina_email', $user);  ?>" id="band-auditie-upload">Doe auditie</a>
	</div>
<?php get_footer(); ?>


