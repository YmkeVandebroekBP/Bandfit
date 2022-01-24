<?php get_header(); ?>

<?php $s_query = get_search_query(); ?>

<?php 
$filterGenreBand = $_POST['filter-genre-band'];
$filterTypeBand = $_POST['filter-type-band'];
$filterInstrumentBand = $_POST['filter-instrument-band'];

if ($filterGenreBand === 'Alle' && $filterTypeBand === 'Alle' && $filterInstrumentBand === 'Alle'){
    $args = array(
    'search' => '*' . esc_attr( $s_query ) . '*',
    'meta_query' => array(
        'relation' => 'OR',
            array(
                'key'     => 'bandpagina_bandnaam',
                'value'   => $search_term,
                'compare' => 'LIKE'
            )
        )  
    );
} else if ($filterGenreBand !== 'Alle' && $filterTypeBand === 'Alle' && $filterInstrumentBand === 'Alle'){
    $args = array(
    'search' => '*' . esc_attr( $s_query ) . '*',
    'meta_query' => array(
        'relation' => 'OR',
            array(
                'key'     => 'bandpagina_bandnaam',
                'value'   => $search_term,
                'compare' => 'LIKE'
            ),
        'relation' => 'AND',
           array(
                'key' => 'bandpagina_genre',
                'value' => $filterGenreBand,
                'compare' => '==='
            )
        )  
    );
} else if ($filterGenreBand === 'Alle' && $filterTypeBand !== 'Alle' && $filterInstrumentBand === 'Alle'){
    $args = array(
    'search' => '*' . esc_attr( $s_query ) . '*',
    'meta_query' => array(
        'relation' => 'OR',
            array(
                'key'     => 'bandpagina_bandnaam',
                'value'   => $search_term,
                'compare' => 'LIKE'
            ),
        'relation' => 'AND',
            array(
                'key' => 'bandpagina_bandsoort',
                'value' => $filterTypeBand,
                'compare' => '==='
            )
        )  
    );
} else if ($filterGenreBand === 'Alle' && $filterTypeBand === 'Alle' && $filterInstrumentBand !== 'Alle'){
    $args = array(
    'search' => '*' . esc_attr( $s_query ) . '*',
    'meta_query' => array(
        'relation' => 'OR',
            array(
                'key'     => 'bandpagina_bandnaam',
                'value'   => $search_term,
                'compare' => 'LIKE'
            ),
        'relation' => 'AND',
            array(
                'key' => 'bandpagina_zoektocht',
                'value' => $filterInstrumentBand,
                'compare' => '==='
            )
        )  
    );
} else if ($filterGenreBand !== 'Alle' && $filterTypeBand !== 'Alle' && $filterInstrumentBand === 'Alle'){
    $args = array(
    'search' => '*' . esc_attr( $s_query ) . '*',
    'meta_query' => array(
        'relation' => 'OR',
            array(
                'key'     => 'bandpagina_bandnaam',
                'value'   => $search_term,
                'compare' => 'LIKE'
            ),
        'relation' => 'AND',
            array(
                'key' => 'bandpagina_genre',
                'value' => $filterGenreBand,
                'compare' => '==='
            ),
            array(
                'key' => 'bandpagina_bandsoort',
                'value' => $filterTypeBand,
                'compare' => '==='
            )
        )  
    );
} else if ($filterGenreBand === 'Alle' && $filterTypeBand !== 'Alle' && $filterInstrumentBand !== 'Alle'){
    $args = array(
    'search' => '*' . esc_attr( $s_query ) . '*',
    'meta_query' => array(
        'relation' => 'OR',
            array(
                'key'     => 'bandpagina_bandnaam',
                'value'   => $search_term,
                'compare' => 'LIKE'
            ),
        'relation' => 'AND',
            array(
                'key' => 'bandpagina_bandsoort',
                'value' => $filterTypeBand,
                'compare' => '==='
            ),
            array(
                'key' => 'bandpagina_zoektocht',
                'value' => $filterInstrumentBand,
                'compare' => '==='
            )
        )  
    );
} else if ($filterGenreBand !== 'Alle' && $filterTypeBand === 'Alle' && $filterInstrumentBand !== 'Alle'){
    $args = array(
    'search' => '*' . esc_attr( $s_query ) . '*',
    'meta_query' => array(
        'relation' => 'OR',
            array(
                'key'     => 'bandpagina_bandnaam',
                'value'   => $search_term,
                'compare' => 'LIKE'
            ),
        'relation' => 'AND',
            array(
                'key' => 'bandpagina_genre',
                'value' => $filterGenreBand,
                'compare' => '==='
            ),
            array(
                'key' => 'bandpagina_zoektocht',
                'value' => $filterInstrumentBand,
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
                'key'     => 'bandpagina_bandnaam',
                'value'   => $search_term,
                'compare' => 'LIKE'
            ),
        'relation' => 'AND',
            array(
                'key' => 'bandpagina_genre',
                'value' => $filterGenreBand,
                'compare' => '==='
            ),
            array(
                'key' => 'bandpagina_bandsoort',
                'value' => $filterTypeBand,
                'compare' => '==='
            ),
            array(
                'key' => 'bandpagina_zoektocht',
                'value' => $filterInstrumentBand,
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
                        echo '<h2 class="bandnaam-resultaten">' . get_field('bandpagina_bandnaam', $user) . '</h2>';
                        echo '<div id="zoekresultaten-bands-grid">';
                            echo '<div>';
                                echo '<img src="' . get_field('bandpagina_profielfoto', $user) . '">';
                                echo '<div id="profiel-ervaring-controls">';
                                echo '<audio id="muzikant-zoekresultaat-player" src=' . get_field('bandpagina_performancegeluid', $user) . '></audio>';                        
                                    echo '<a class="profiel-ervaring-controls-play"></a>';
                                    echo '<a class="profiel-ervaring-controls-pause"></a>';
                                    echo '<a class="profiel-ervaring-controls-stop"></a>';
                                echo '</div>'; 
                            echo '</div>'; 
                                echo '<div>';
                                    echo '<ul id="band-kenmerken">';
                                        echo '<p>Dit zijn wij:</p>';
                                        echo '<li>' . get_field('bandpagina_genre', $user) .'</li>';
                                        echo '<li>' . get_field('bandpagina_bandsoort', $user) .'</li>';
                                        echo '<p>Wij zoeken:</p>';
                                        echo '<li>' . get_field('bandpagina_zoektocht', $user) .'</li>';
                                    echo '</ul>';
                                echo '</div>'; 
                            echo '</div>'; 
                            echo '<a id="zoekresultaat-link" href="' . home_url('/') . 'band-user-' . $user->ID .'">Bezoek band</a>'; 
                        echo '</li>';
                    }
                    echo '</ul>';
                } else {
                    echo '<p class="foutmelding">Er zijn geen bands geregistreerd die aan uw zoekterm voldoen</p>';
                }
            ?>
        </div>
    </div>
</div>

<?php wp_reset_query(); ?>

<?php get_footer(); ?>