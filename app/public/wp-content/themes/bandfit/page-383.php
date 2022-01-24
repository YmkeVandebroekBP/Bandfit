<?php get_header(); ?>

<div id="profiel-head">
	<img id="profiel-omslagfoto" src=<?php the_field('profiel_omslagfoto', $user); ?>>
	<div id="profiel-profielfoto-container">
		<img id="profiel-profielfoto" src=<?php the_field('profiel_profielfoto', $user); ?>>
	</div>
	<div id="profiel-info-container">
		<h1 id="profiel-naam"><?php the_field('profiel_voornaam', $user) . ' ' . the_field('profiel_achternaam', $user); ?></h1>
		<h4 id="profiel-stad"><?php the_field('profiel_stad', $user)?></h4>
	</div>
</div>

<div id="profiel-body">
<div id="profiel-content">
	<p id="profiel-biografie"><?php the_field('profiel_biografie', $user); ?></p>
	<div class="blok">
		<h2 class="h2-center gecentreerde-titel">Instrumenten</h2>
		<?php 
		echo '<ul class="oplijsting">';
			echo '<li>' . the_field('profiel_hoofdinstrument', $user) . '</li>';
			$rows = get_field('profiel_instrumentenoverige', $user);
			if( $rows ) {
			    foreach( $rows as $row ) {
				        echo '<li>' . $row['profiel_instrument'] . '</li>';
			    }
			}
		echo '</ul>';
		?>
	</div>

	<div class="blok">
		<h2>Vorige ervaringen</h2>
			<?php 
			echo '<div id="slider-profiel-ervaringen">';
			$rows = get_field('profiel_ervaring', $user);
			if( $rows ) {
			    foreach( $rows as $row ) {
			    	echo '<div>';
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
			?>
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
</div>


	<div class="blok">
		<? include('wp-content/themes/bandfit/platenspeler.php'); ?>
	</div>
</div>

<?php get_footer(); ?>


