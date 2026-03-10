<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta name="description" content="<?php bloginfo('description'); ?>"/>
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header class="site-header">
    <div class="header-inner">

        <!-- Logo — uses <picture> so browser picks the right size natively, no CSS needed -->
        <a href="<?php echo esc_url(home_url('/')); ?>" class="site-logo" aria-label="<?php bloginfo('name'); ?> Home">
            <picture>
                <source media="(max-width: 480px)" srcset="<?php echo esc_url( get_template_directory_uri() . '/assets/images/acm_logo_mobile.svg' ); ?>"/>
                <source media="(max-width: 960px)" srcset="<?php echo esc_url( get_template_directory_uri() . '/assets/images/acm_logo_tablet.svg' ); ?>"/>
                <img
                    src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/acm_logo.gif' ); ?>"
                    alt="<?php echo esc_attr( acm_chapter_name() ); ?> – Association for Computing Machinery"
                    height="48"
                />
            </picture>
        </a>

        <!-- Primary Navigation -->
        <nav class="site-nav" aria-label="Primary Navigation">
            <?php
            wp_nav_menu([
                'theme_location' => 'primary',
                'menu_class'     => '',
                'container'      => false,
                'fallback_cb'    => 'acm_chapter_fallback_menu',
            ]);
            ?>
        </nav>

        <!-- Mobile Hamburger -->
        <button class="nav-toggle" aria-label="Toggle navigation" aria-expanded="false">
            <span></span>
            <span></span>
            <span></span>
        </button>

    </div>
</header>

<?php
/**
 * Fallback menu if no menu is assigned in WP Admin.
 * Shows basic links so the site isn't broken during setup.
 */
function acm_chapter_fallback_menu() {
    echo '<ul>';
    echo '<li><a href="' . esc_url(home_url('/')) . '">Home</a></li>';
    echo '<li><a href="' . esc_url(home_url('/about')) . '">About</a></li>';
    echo '<li><a href="' . esc_url(home_url('/events')) . '">Events</a></li>';
    echo '<li><a href="' . esc_url(home_url('/officers')) . '">Officers</a></li>';
    echo '<li><a href="' . esc_url(home_url('/membership')) . '">Membership</a></li>';
    echo '<li><a href="' . esc_url(home_url('/contact')) . '">Contact</a></li>';
    echo '</ul>';
}
?>
