<?php get_header(); ?>

<?php
$user = wp_get_current_user();
echo '<h1 id="profiel-titel">Hallo, ' . get_field('profiel_voornaam', $user) . '! Maak hier jouw bandpagina aan en kom hier later terug voor aanpassingen.</h1>';
?>
<?php the_content(); ?>

<?php get_footer(); ?>