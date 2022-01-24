<?php get_header(); ?>

<?php $s_query = get_search_query(); ?>

<?php 

$filterInstrumentMuzikant = $_POST['filter-instrument-muzikant'];
$filterWoonplaatsMuzikant = $_POST['filter-woonplaats-muzikant'];

if ($filterInstrumentMuzikant == 'Alle' && $filterWoonplaatsMuzikant == 'Alle'){
   $args = array(
    'search' => '*' . esc_attr( $s_query ) . '*',
    'meta_query' => array(
        'relation' => 'OR',
            array(
                'key'     => 'first_name',
                'value'   => $search_term,
                'compare' => 'LIKE'
            ),
            array(
                'key'     => 'last_name',
                'value'   => $search_term,
                'compare' => 'LIKE'
            )
        )  
    ); 
} else if ($filterInstrumentMuzikant === 'Alle' && $filterWoonplaatsMuzikant !== 'Alle'){
    $args = array(
    'search' => '*' . esc_attr( $s_query ) . '*',
    'meta_query' => array(
        'relation' => 'OR',
            array(
                'key'     => 'first_name',
                'value'   => $search_term,
                'compare' => 'LIKE'
            ),
            array(
                'key'     => 'last_name',
                'value'   => $search_term,
                'compare' => 'LIKE'
            ),
        'relation' => 'AND',
            array(
                'key' => 'profiel_provincie',
                'value' => $filterWoonplaatsMuzikant,
                'compare' => '==='
            )
        )  
    ); 
} else if ($filterInstrumentMuzikant !== 'Alle' && $filterWoonplaatsMuzikant === 'Alle'){
    $args = array(
    'search' => '*' . esc_attr( $s_query ) . '*',
    'meta_query' => array(
        'relation' => 'OR',
            array(
                'key'     => 'first_name',
                'value'   => $search_term,
                'compare' => 'LIKE'
            ),
            array(
                'key'     => 'last_name',
                'value'   => $search_term,
                'compare' => 'LIKE'
            ),
        'relation' => 'AND',
            array(
                'key' => 'profiel_hoofdinstrument',
                'value' => $filterInstrumentMuzikant,
                'compare' => '==='
            )
        )  
    );
} else {
    $args = array(
    'search' => '*' . esc_attr( $s_query ) . '*',
    'meta_query' => array(
        'relation' => 'OR',
            array(
                'key'     => 'first_name',
                'value'   => $search_term,
                'compare' => 'LIKE'
            ),
            array(
                'key'     => 'last_name',
                'value'   => $search_term,
                'compare' => 'LIKE'
            ),
        'relation' => 'AND',
            array(
                'key' => 'profiel_hoofdinstrument',
                'value' => $filterInstrumentMuzikant,
                'compare' => '==='
            ),
            array(
                'key' => 'profiel_provincie',
                'value' => $filterWoonplaatsMuzikant,
                'compare' => '==='
            )
        )  
    );
}
?>

<?php $user_query = new WP_User_Query( $args ); ?>

<div class="titel-102-container">
    <h1 class="titel-102">Zoekresultaten voor jouw zoekopdracht</h1>
</div>

<div id="profiel-body">
    <div id="profiel-content">
        <div class="zoekresultaten-blok">
            <?php
                if ( ! empty( $user_query->get_results() ) ) {
                    echo '<ul>';
                    foreach ( $user_query->get_results() as $user ) {
                        echo '<li class="zoekresultaten-blok-resultaat">';
                        echo '<h2 class="bandnaam-resultaten">' . $user->first_name . ' ' . $user->last_name . '</h2>';
                        echo '<img class="zoekresultaat-muzikant-foto" src="' . get_field('profiel_profielfoto', $user) . '">';
                            echo '<audio id="muzikant-zoekresultaat-player" src=' . get_field('profiel_performancegeluid', $user) . '></audio>';
                            echo '<div id="profiel-ervaring-controls">';
                                echo '<a class="profiel-ervaring-controls-play"></a>';
                                echo '<a class="profiel-ervaring-controls-pause"></a>';
                                echo '<a class="profiel-ervaring-controls-stop"></a>';
                            echo '</div>';
                            echo '<a id="zoekresultaat-link" href="' . home_url('/') . 'user-' . $user->ID .'">Bezoek gebruiker</a>';
                        echo '</li>';
                    }
                    echo '</ul>';
                } else {
                    echo '<p class="foutmelding">Er zijn geen gebruikers geregistreerd die aan uw zoekterm voldoen</p>';
                }
            ?>
        </div>
    </div>
</div>

<?php wp_reset_query(); ?>

<?php get_footer(); ?>
