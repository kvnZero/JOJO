<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
    wp_head();
    $site_secondary_color = get_theme_mod( 'site_secondary_color', '212529bf' );
    $site_link_color = get_theme_mod( 'site_link_color', '#0d6efd' );
    $site_link_hover_color = get_theme_mod( 'site_link_hover_color', '#0a58ca' );
    echo '<style>body{ --bs-secondary-color:'.$site_secondary_color.'; --bs-link-color:'.$site_link_color.';--bs-link-hover-color:'.$site_link_hover_color.' }</style>';
    ?>
</head>
<body <?php body_class(); ?>>
<?php
    $hidden_header = get_theme_mod( 'hidden_site_header_nav', false );
    $header_footer_background = get_theme_mod( 'header_footer_background_color', '#ffffff' );
?>
<header style="display: <?php echo $hidden_header ? 'none'  : 'block'; ?>;background-color: <?php echo $header_footer_background; ?>">
    <div class="w-100 d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
        <a href="<?php echo home_url(); ?>" class="d-flex align-items-center link-body-emphasis text-decoration-none">
        </a>
        <nav class="navbar navbar-expand-lg w-100 px-md-5">
            <div class="container-fluid">
                <?php
                $custom_logo_id = get_theme_mod( 'custom_logo' );
                $logo = wp_get_attachment_image_src( $custom_logo_id , 'full' );
                if ( has_custom_logo() ) {
                    ?>
                    <a class="navbar-brand" href="#">
                    <?php
                    echo '<img class="header-logo-img" src="' . esc_url( $logo[0] ) . '" alt="' . get_bloginfo( 'name' ) . '">';
                    ?>
                    </a>
                    <?php
                } else {
                    echo '<h1>' . get_bloginfo('name') . '</h1>';
                }
                ?>
                
                <div class="dropdown text-end d-lg-none">
                    <div class="header-feature-wrapper">
                        <?php
                        $enable_header_language = get_theme_mod('enable_header_language', false);

                        if( $enable_header_language) {
                            ?>
                            <div class="btn-group">
                                <button type="button" class="btn dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-translate" viewBox="0 0 16 16">
                                <path d="M4.545 6.714 4.11 8H3l1.862-5h1.284L8 8H6.833l-.435-1.286zm1.634-.736L5.5 3.956h-.049l-.679 2.022z"/>
                                <path d="M0 2a2 2 0 0 1 2-2h7a2 2 0 0 1 2 2v3h3a2 2 0 0 1 2 2v7a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2v-3H2a2 2 0 0 1-2-2zm2-1a1 1 0 0 0-1 1v7a1 1 0 0 0 1 1h7a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1zm7.138 9.995q.289.451.63.846c-.748.575-1.673 1.001-2.768 1.292.178.217.451.635.555.867 1.125-.359 2.08-.844 2.886-1.494.777.665 1.739 1.165 2.93 1.472.133-.254.414-.673.629-.89-1.125-.253-2.057-.694-2.82-1.284.681-.747 1.222-1.651 1.621-2.757H14V8h-3v1.047h.765c-.318.844-.74 1.546-1.272 2.13a6 6 0 0 1-.415-.492 2 2 0 0 1-.94.31"/>
                                </svg>
                                </button>
                                <form action="/" method="POST">
                                    <input type="hidden" name="lang" value="<?php get_user_locale(); ?>">
                                    <ul class="dropdown-menu lang-dropdown-menu">
                                    <?php
                                    $support_languages = get_available_languages(get_template_directory() . '/languages');
                                    foreach ($support_languages as $language) {
                                        echo '<li><a class="dropdown-item"  value="'.$language.'" href="#">' . $language . '</a></li>';
                                    }
                                    ?>
                                </ul>
                                </form>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                </div>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                <?php
                    wp_nav_menu(
                        array(
                            'theme_location' => 'header-menu',
                            'container' => false,
                            'fallback_cb' => false,
                            'menu_class' => 'navbar-nav',
                            'link_class'  => 'nav-item',
                            'list_item_class' => 'nav-link'
                        )
                    );
                ?>
                </div>
                <div class="dropdown text-end d-none d-lg-block">
                    <div class="header-feature-wrapper">
                        <?php
                        if( $enable_header_language) {
                            ?>
                            <div class="btn-group dropstart">
                                <button type="button" class="btn dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-translate" viewBox="0 0 16 16">
                                <path d="M4.545 6.714 4.11 8H3l1.862-5h1.284L8 8H6.833l-.435-1.286zm1.634-.736L5.5 3.956h-.049l-.679 2.022z"/>
                                <path d="M0 2a2 2 0 0 1 2-2h7a2 2 0 0 1 2 2v3h3a2 2 0 0 1 2 2v7a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2v-3H2a2 2 0 0 1-2-2zm2-1a1 1 0 0 0-1 1v7a1 1 0 0 0 1 1h7a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1zm7.138 9.995q.289.451.63.846c-.748.575-1.673 1.001-2.768 1.292.178.217.451.635.555.867 1.125-.359 2.08-.844 2.886-1.494.777.665 1.739 1.165 2.93 1.472.133-.254.414-.673.629-.89-1.125-.253-2.057-.694-2.82-1.284.681-.747 1.222-1.651 1.621-2.757H14V8h-3v1.047h.765c-.318.844-.74 1.546-1.272 2.13a6 6 0 0 1-.415-.492 2 2 0 0 1-.94.31"/>
                                </svg>
                                </button>
                                <form action="/" method="GET" id="lang-form">
                                    <input type="hidden" name="wp_lang" id="wp_lang" value="<?php get_user_locale(); ?>">
                                    <ul class="dropdown-menu lang-dropdown-menu">
                                    <?php
                                    foreach ($support_languages as $language) {
                                        echo '<li><a class="dropdown-item" data-value="'.$language.'" href="#">' . $language . '</a></li>';
                                    }
                                    ?>
                                </ul>
                                </form>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </nav>

    </div>
</header>


  