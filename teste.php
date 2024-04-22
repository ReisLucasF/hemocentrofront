<?

function curso_shortcode() {
    ob_start();

    $args = array(
        'post_type' => 'catalogo',
        'posts_per_page' => 4
    );

    $catalogo_query = new WP_Query($args);

    if ($catalogo_query->have_posts()) :
        echo '<div class="">'; // Container flexível com a classe personalizada

        while ($catalogo_query->have_posts()) : $catalogo_query->the_post();

            $foto = get_field('foto');
            $link = get_field('link_para_o_catalogo_pdf');


            echo '<div class="curso-column">'; // Coluna com classe personalizada
            echo '<a href="' . esc_url($url_do_curso) . '" class="curso-link" style="text-decoration: none; color: inherit;">';

            ?>
            <div class="curso-widget-wrap">
                <?php if ($foto) : ?>
                    <div class="curso-image">
                        <div class="curso-widget-container">
                            <img loading="lazy" decoding="async" src="<?php echo esc_url($foto); ?>" alt="<?php the_title_attribute(); ?>">
                        </div>
                    </div>
                <?php endif; ?>
            </div>

            <?php
            echo '</a>';
            echo '</div>';

        endwhile;

        echo '</div>';

        wp_reset_postdata();
    endif;

    return ob_get_clean();
}
add_shortcode('catalogo', 'catalogo_shortcode');