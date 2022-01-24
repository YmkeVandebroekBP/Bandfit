<?php
/**
* Template Name: Band Page
*
* @package WordPress
*/
?>

<?php get_header(); ?>
<?php 
$paginaLink = get_permalink();
$splitsPaginaLink = parse_url($paginaLink);
$laatsteDeelPaginaLink = $splitsPaginaLink['path'];
$userIdPaginaLink = $laatsteDeelPaginaLink[11] . $laatsteDeelPaginaLink[12]; 
$volledigeUserNamePaginaLink = 'user_' . $userIdPaginaLink;

/* $user_id = $userIdPaginaLink;
$user = $volledigeUserNamePaginaLink; */

$user_id = $userIdPaginaLink;
$user = $volledigeUserNamePaginaLink; 
?>

<div id="profiel-head">
	<img id="profiel-omslagfoto" src=<?php the_field('bandpagina_omslagfoto', $user); ?>>
	<div id="profiel-profielfoto-container">
		<img id="profiel-profielfoto" src=<?php the_field('bandpagina_profielfoto', $user); ?>>
	</div>
	<div id="profiel-info-container">
		<h1 class="fg-lighttext bg-vibrant" id="profiel-naam"><?php the_field('bandpagina_bandnaam', $user)?></h1>
		<h4 class="fg-darktext bg-lightvibrant" id="profiel-stad"><?php the_field('bandpagina_stad', $user)?></h4>
	</div>
</div>

<div id="profiel-body" class="bg-darkmuted">
<div id="profiel-content">
	<p id="profiel-biografie"><?php the_field('bandpagina_biografie', $user); ?></p>
	<div class="blok gecentreerde-blok-container">
		<h2 class="fg-lighttext bg-darkvibrant h2-center gecentreerde-titel">Zoektocht</h2>
		<ul class="oplijsting">
			<li class="fg-darktext bg-lightvibrant"><?php the_field('bandpagina_bandsoort', $user); ?></li>	
			<li class="fg-darktext bg-lightvibrant"><?php the_field('bandpagina_genre', $user); ?></li>
			<li class="fg-lighttext bg-vibrant"><?php the_field('bandpagina_zoektocht', $user); ?></li>	
		</ul>
	</div>

	<div class="blok">
		<h2 class="fg-lighttext bg-darkvibrant h2-center gecentreerde-titel">Band</h2>
			<?php 
			echo '<div id="slider-profiel-band">';
			$bandPersonen = get_user_meta($user_id, 'personen-band' ); 
				foreach( $bandPersonen as $bandPersoon ) {
					echo '<div><a href="http://bandfit.local/user-' . $user_id . '/">';
						echo '<img id="profiel-band-omslagfoto" src="' . get_field('profiel_omslagfoto', $user) . '">';
						echo '<img id="profiel-band-profielfoto" src="' . get_field('profiel_profielfoto', $user) . '">';
						echo '<p id="profiel-band-voornaam">' . get_field('profiel_voornaam', $user) . '</p>'; 
						echo '<p id="profiel-band-hoofdinstrument">' . get_field('profiel_hoofdinstrument', $user) . '</p>'; 
					echo '</a></div>';
				}   	
			echo '</div>';
			?>
	</div>

	<div class="blok gecentreerde-blok-container">
		<h2 class="fg-lighttext bg-darkvibrant h2-center gecentreerde-titel">Live performance</h2>
		<video id="band-liveperformancevideo" controls>
			<source src=<?php the_field('bandpagina_liveperformancevideo', $user); ?>>
        </video>
	</div>

	<div class="blok gecentreerde-blok-container gekleurd-blok bg-lightvibrant">
		<h2 id="band-auditite-titel" class="fg-lighttext bg-darkvibrant h2-center gecentreerde-titel">Auditie</h2>
		<p class="fg-darktext"><?php the_field('bandpagina_auditie_beschrijving', $user); ?></p>
		<p class="tekst-accent">Ons verzoeknummer is: <?php the_field('bandpagina_auditie_keuzenummer', $user);  ?> </p>
		<p class="fg-darktext">Stuur je eigen interpretatie van dit nummer in en wie weet word je geselecteerd!</p>
		<a class="fg-lighttext bg-vibrant" href="mailto:<?php the_field('bandpagina_email', $user);  ?>" id="band-auditie-upload">Doe auditie</a>
	</div>
		<script>
	<?php  include('wp-content/themes/bandfit/js/vibrant.js'); ?>
	</script>

    <script>
    	var img = document.getElementById("profiel-omslagfoto");
		img.getAttribute("src");
		img.crossOrigin = "Anonymous";

		img.addEventListener('load', function() {
		    var vibrant = new Vibrant(img, 256, 5);
		    var swatches = vibrant.swatches()
		    for (var swatch in swatches)
		        if (swatches.hasOwnProperty(swatch) && swatches[swatch])
		            console.log(swatch, swatches[swatch].getHex());
		let bgVibrant = document.getElementsByClassName("bg-vibrant");
		let bgLightVibrant = document.getElementsByClassName("bg-lightvibrant");
		let bgDarkVibrant = document.getElementsByClassName("bg-darkvibrant");
		let bgMuted = document.getElementsByClassName("bg-muted");
		let bgDarkMuted = document.getElementsByClassName("bg-darkmuted");
		let fgLightText = document.getElementsByClassName("fg-lighttext");
		let fgDarkText = document.getElementsByClassName("fg-darktext");

		let fillVibrant = document.getElementsByClassName("fill-vibrant");

		let teller = 0;
		while (teller < bgVibrant.length){
			bgVibrant[teller].style.backgroundColor = swatches['Vibrant'].getHex();
			teller++;
		}

		teller = 0;
		while (teller < bgLightVibrant.length){
			bgLightVibrant[teller].style.backgroundColor = swatches['LightVibrant'].getHex();
			teller++;
		}	

		teller = 0;
		while (teller < bgDarkVibrant.length){
			bgDarkVibrant[teller].style.backgroundColor = swatches['DarkVibrant'].getHex();
			teller++;
		}

		teller = 0;
		while (teller < bgMuted.length){
			bgMuted[teller].style.backgroundColor = swatches['Muted'].getHex();
			teller++;
		}

		teller = 0;
		while (teller < bgDarkMuted.length){
			bgDarkMuted[teller].style.backgroundColor = swatches['DarkMuted'].getHex();
			teller++;
		}

		teller = 0;
		while (teller < fgLightText.length){
			fgLightText[teller].style.color = 'white';
			teller++;
		}

		teller = 0;
		while (teller < fgDarkText.length){
			fgDarkText[teller].style.color = 'black';
			teller++;
		}
		});
    </script>

    	<script>	
			  	jQuery('#slider-profiel-band').slick({
			   		slidesToShow: 2,
			      	slidesToScroll: 1,
			  		dots: false,
			  		arrows: true,
			      	autoplay: false,
			      	infinite: false,
			      	responsive: [
				    {
				      breakpoint: 1200,
				      settings: {
				      	slidesToShow: 1,
				        slidesToScroll: 1
				      }
				    }
				    ]
				  });	
	</script>


<?php get_footer(); ?>


