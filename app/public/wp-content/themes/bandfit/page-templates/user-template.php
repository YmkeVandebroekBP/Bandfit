<?php
/**
* Template Name: User Profile
*
* @package WordPress
*/
?>

<?php get_header(); ?>

<?php 
$paginaLink = get_permalink();
$splitsPaginaLink = parse_url($paginaLink);
$laatsteDeelPaginaLink = $splitsPaginaLink['path'];
$userIdPaginaLink = $laatsteDeelPaginaLink[6] . $laatsteDeelPaginaLink[7]; 
$volledigeUserNamePaginaLink = 'user_' . $userIdPaginaLink;

$user_id = $userIdPaginaLink;
$user = $volledigeUserNamePaginaLink;
$currentUser = get_current_user_id();
?>

<div id="profiel-head">
	<img id="profiel-omslagfoto" src=<?php the_field('profiel_omslagfoto', $user); ?>>
	<div id="profiel-profielfoto-container">
		<img id="profiel-profielfoto" src=<?php the_field('profiel_profielfoto', $user); ?>>
	</div>
	<div id="profiel-info-container">
		<h1 class="fg-lighttext bg-vibrant" id="profiel-naam"><?php the_field('profiel_voornaam', $user) . ' ' . the_field('profiel_achternaam', $user); ?></h1>
		<h4 class="fg-darktext bg-lightvibrant" id="profiel-stad"><?php the_field('profiel_stad', $user)?></h4>
	</div>
</div>

<div class="bg-darkmuted" id="profiel-body">
<div id="profiel-content">
	<form method="post" id="toevoegen-buttons">
		<input class="fg-darktext bg-lightvibrant" type="submit" name="voegtoe-netwerk" value="Toevoegen aan netwerk"/>
		<input class="fg-darktext bg-lightvibrant" type="submit" name="voegtoe-band" value="Toevoegen aan band"/>
	</form>
	<p id="profiel-biografie"><?php the_field('profiel_biografie', $user); ?></p>

	<div class="blok">
		<h2 class="fg-lighttext bg-darkvibrant h2-center gecentreerde-titel">Instrumenten</h2>
		<?php 
		echo '<ul class="oplijsting">';
			echo '<li class="fg-darktext bg-lightvibrant">' . get_field('profiel_hoofdinstrument', $user) . '</li>';
			$rows = get_field('profiel_instrumentenoverige', $user);
			if( $rows ) {
			    foreach( $rows as $row ) {
				        echo '<li class="fg-darktext bg-lightvibrant">' . $row['profiel_instrument'] . '</li>';
			    }
			}
		echo '</ul>';
		?>
	</div>

	<?php
      
        if(isset($_POST['voegtoe-netwerk'])) {
        	wk_save_custom_user_profile_fields_voegtoe_netwerk($currentUser, $user);
        }
        if(isset($_POST['voegtoe-band'])) {
        	wk_save_custom_user_profile_fields_voegtoe_band($currentUser, $user);

        }
    ?>

	<div class="blok">
		<h2 class="fg-lighttext bg-darkvibrant">Vorige ervaringen</h2>
			<?php 
			echo '<div id="slider-profiel-ervaringen">';
			$rows = get_field('profiel_ervaring', $user);
			if( $rows ) {
			    foreach( $rows as $row ) {
			    	echo '<div class="bg-lightvibrant">';
				        echo '<h4>' . 'Van ' .$row['profiel_ervaring_jaartalvan'] . ' tot ' . $row['profiel_ervaring_jaartaltot'] . ' speelde ik:</h4>';
				        echo '<p>' . $row['profiel_ervaring_rol'] . ' bij ' . $row['profiel_ervaring_bandnaam'] . '</p>';
			        	echo '<audio id="profiel-ervaring-player" src=' . $row['profiel_ervaring_performancegeluid'] . '></audio>'; 
			        	echo '<div id="profiel-ervaring-controls">';
			        		echo '<a class="profiel-ervaring-controls-play"></a>';
			        		echo '<a class="profiel-ervaring-controls-pause"></a>';
			        		echo '<a class="profiel-ervaring-controls-stop"></a>';
			        	echo '</div>';
			        	echo '<img id="profiel-ervaring-plaat" src="/wp-content/themes/bandfit/img/bandfit-logo-wit.png"/>';	        	
			       	echo '</div>';
			    }
			}
			echo '</div>';
			?>
	</div>

	<div class="blok">
		<?php include('wp-content/themes/bandfit/platenspeler.php'); ?>
	</div>

	<div class="blok">
		<h2 class="fg-lighttext bg-darkvibrant h2-center gecentreerde-titel">Personen in mijn netwerk</h2>
			<?php 
			echo '<div id="slider-profiel-netwerk">';
			$netwerkPersonen = get_user_meta($user_id, 'personen-netwerk' ); 
				foreach( $netwerkPersonen as $netwerkPersoon ) {
					echo '<div><a href="http://bandfit.local/user-' . $user_id . '/">';
						echo '<img id="profiel-netwerk-omslagfoto" src="' . get_field('profiel_omslagfoto', $user) . '">';
						echo '<img id="profiel-netwerk-profielfoto" src="' . get_field('profiel_profielfoto', $user) . '">';
						echo '<p id="profiel-netwerk-voornaam">' . get_field('profiel_voornaam', $user) . '</p>'; 
						echo '<p id="profiel-netwerk-hoofdinstrument">' . get_field('profiel_hoofdinstrument', $user) . '</p>'; 
					echo '</a></div>';
				}   	
			echo '</div>';
			?>
	</div>

	<div class="blok">
		<h2 class="fg-lighttext bg-darkvibrant h2-center gecentreerde-titel">Personen in mijn band</h2>
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
</div>

	<script>
		let profielErvaringPlayer = document.getElementById("profiel-ervaring-player");
		let profielErvaringButtonPlay = document.getElementsByClassName("profiel-ervaring-controls-play")[0];
		let profielErvaringButtonPause = document.getElementsByClassName("profiel-ervaring-controls-pause")[0];
		let profielErvaringButtonStop = document.getElementsByClassName("profiel-ervaring-controls-stop")[0];

		let profielErvaringPlaat = document.getElementById("profiel-ervaring-plaat");

		profielErvaringButtonPlay.addEventListener("click", speelLied);
		profielErvaringButtonPause.addEventListener("click", pauzeerLied);
		profielErvaringButtonStop.addEventListener("click", stopLied);

		function speelLied (){
			profielErvaringPlayer.play();
			profielErvaringPlaat.classList.remove("draaien-0");
			profielErvaringPlaat.classList.remove("draaien-stop");
			profielErvaringPlaat.classList.add("draaien-actief");
		}

		function pauzeerLied (){
			profielErvaringPlayer.pause();
			profielErvaringPlaat.classList.remove("draaien-0");
			profielErvaringPlaat.classList.remove("draaien-actief");
			profielErvaringPlaat.classList.add("draaien-stop");
		}

		function stopLied (){
			profielErvaringPlayer.pause();
			profielErvaringPlayer.currentTime = 0;
			profielErvaringPlaat.classList.remove("draaien-actief");
			profielErvaringPlaat.classList.remove("draaien-stop");
			profielErvaringPlaat.classList.add("draaien-0");
		}
	</script>

	<script>
			  	jQuery('#slider-profiel-netwerk').slick({
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


<?php get_footer(); ?>


