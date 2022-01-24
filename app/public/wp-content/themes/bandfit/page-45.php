<?php get_header(); ?>

<div id="profiel-body">
	<div id="profiel-content">
		<div id="dashboard-content">
			<div id="dashboard-info">
				<h1 id="dashboard-header">Jouw dashboard</h1>
				<a href="http://bandfit.local/profiel" class="dashboard-link">Profiel >></a>
				<a href="http://bandfit.local/band" class="dashboard-link">Band >></a>
			</div>
			<div id="dashboard-profielfoto-container">
				<img id="dashboard-profielfoto" src=<?php the_field('profiel_profielfoto', $user); ?>>
			</div>
		</div>
	</div>
</div>

	<script>
	<?php  include('wp-content/themes/bandfit/js/vibrant.js'); ?>
	</script>

<?php get_footer(); ?>