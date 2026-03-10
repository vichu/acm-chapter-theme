<?php
/**
 * ACM Chapter Theme Functions
 */

// ── Enqueue Styles & Scripts ──────────────────────────────────────
function acm_chapter_enqueue_assets() {

    // Google Fonts
    wp_enqueue_style(
        'acm-google-fonts',
        'https://fonts.googleapis.com/css2?family=Merriweather:ital,wght@0,400;0,700;0,900;1,400&family=Source+Sans+3:wght@300;400;500;600;700&display=swap',
        [],
        null
    );

    // CSS Variables (load first — everything depends on these)
    wp_enqueue_style(
        'acm-variables',
        get_template_directory_uri() . '/css/variables.css',
        ['acm-google-fonts'],
        '1.0.0'
    );

    // Typography
    wp_enqueue_style(
        'acm-typography',
        get_template_directory_uri() . '/css/typography.css',
        ['acm-variables'],
        '1.0.0'
    );

    // Layout
    wp_enqueue_style(
        'acm-layout',
        get_template_directory_uri() . '/css/layout.css',
        ['acm-variables'],
        '1.0.0'
    );

    // Buttons
    wp_enqueue_style(
        'acm-buttons',
        get_template_directory_uri() . '/css/buttons.css',
        ['acm-variables'],
        '1.0.0'
    );

    // Header
    wp_enqueue_style(
        'acm-header',
        get_template_directory_uri() . '/css/header.css',
        ['acm-variables'],
        '1.0.0'
    );

    // Footer
    wp_enqueue_style(
        'acm-footer',
        get_template_directory_uri() . '/css/footer.css',
        ['acm-variables'],
        '1.0.0'
    );

    // Responsive (load last)
    wp_enqueue_style(
        'acm-responsive',
        get_template_directory_uri() . '/css/responsive.css',
        ['acm-variables'],
        '1.0.0'
    );

    // Main JS
    wp_enqueue_script(
        'acm-main',
        get_template_directory_uri() . '/js/main.js',
        [],
        '1.0.0',
        true // load in footer
    );
}
add_action( 'wp_enqueue_scripts', 'acm_chapter_enqueue_assets' );


// ── Theme Supports ────────────────────────────────────────────────
function acm_chapter_setup() {
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'html5', [
        'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
    ]);
    add_theme_support( 'custom-logo', [
        'height'      => 72,
        'width'       => 200,
        'flex-height' => true,
        'flex-width'  => true,
    ]);

    // Register navigation menus
    register_nav_menus([
        'primary' => __( 'Primary Navigation', 'acm-chapter' ),
        'footer'  => __( 'Footer Navigation', 'acm-chapter' ),
    ]);
}
add_action( 'after_setup_theme', 'acm_chapter_setup' );


// ── Events Custom Post Type ───────────────────────────────────────
function acm_chapter_register_events() {
    register_post_type( 'acm_event', [
        'labels' => [
            'name'               => 'Events',
            'singular_name'      => 'Event',
            'add_new'            => 'Add New Event',
            'add_new_item'       => 'Add New Event',
            'edit_item'          => 'Edit Event',
            'new_item'           => 'New Event',
            'view_item'          => 'View Event',
            'search_items'       => 'Search Events',
            'not_found'          => 'No events found',
            'not_found_in_trash' => 'No events found in Trash',
            'menu_name'          => 'Events',
        ],
        'public'        => true,
        'show_in_menu'  => true,
        'menu_icon'     => 'dashicons-calendar-alt',
        'menu_position' => 5,
        'supports'      => [ 'title', 'editor', 'thumbnail' ],
        'has_archive'   => false,
        'rewrite'       => [ 'slug' => 'events' ],
        'show_in_rest'  => true,
    ]);
}
add_action( 'init', 'acm_chapter_register_events' );


// ── Event Custom Meta Fields ──────────────────────────────────────
function acm_chapter_event_meta_box() {
    add_meta_box(
        'acm_event_details',
        'Event Details',
        'acm_chapter_render_event_meta',
        'acm_event',
        'normal',
        'high'
    );
}
add_action( 'add_meta_boxes', 'acm_chapter_event_meta_box' );

function acm_chapter_render_event_meta( $post ) {
    wp_nonce_field( 'acm_event_meta', 'acm_event_nonce' );
    $date     = get_post_meta( $post->ID, '_event_date', true );
    $time     = get_post_meta( $post->ID, '_event_time', true );
    $location = get_post_meta( $post->ID, '_event_location', true );
    $rsvp_url = get_post_meta( $post->ID, '_event_rsvp_url', true );
    $ticket   = get_post_meta( $post->ID, '_event_ticket', true );
    ?>
    <style>
        .acm-meta-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; padding: 8px 0; }
        .acm-meta-field { display: flex; flex-direction: column; gap: 6px; }
        .acm-meta-field label { font-weight: 600; font-size: 13px; }
        .acm-meta-field input { padding: 6px 10px; border: 1px solid #ddd; border-radius: 4px; font-size: 14px; }
        .acm-meta-full { grid-column: 1 / -1; }
    </style>
    <div class="acm-meta-grid">
        <div class="acm-meta-field">
            <label for="event_date">📅 Event Date <span style="color:red">*</span></label>
            <input type="date" id="event_date" name="event_date" value="<?php echo esc_attr($date); ?>" required/>
        </div>
        <div class="acm-meta-field">
            <label for="event_time">🕕 Time (e.g. 6:00 – 8:30 PM)</label>
            <input type="text" id="event_time" name="event_time" value="<?php echo esc_attr($time); ?>" placeholder="6:00 – 8:30 PM"/>
        </div>
        <div class="acm-meta-field">
            <label for="event_location">📍 Location</label>
            <input type="text" id="event_location" name="event_location" value="<?php echo esc_attr($location); ?>" placeholder="Event Venue"/>
        </div>
        <div class="acm-meta-field">
            <label for="event_ticket">🎟 Ticket / Entry Info</label>
            <input type="text" id="event_ticket" name="event_ticket" value="<?php echo esc_attr($ticket); ?>" placeholder="Free for Members"/>
        </div>
        <div class="acm-meta-field acm-meta-full">
            <label for="event_rsvp_url">🔗 RSVP / Registration URL</label>
            <input type="url" id="event_rsvp_url" name="event_rsvp_url" value="<?php echo esc_attr($rsvp_url); ?>" placeholder="https://..."/>
        </div>
    </div>
    <?php
}

function acm_chapter_save_event_meta( $post_id ) {
    if ( ! isset( $_POST['acm_event_nonce'] ) ) return;
    if ( ! wp_verify_nonce( $_POST['acm_event_nonce'], 'acm_event_meta' ) ) return;
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
    if ( ! current_user_can( 'edit_post', $post_id ) ) return;

    $fields = [
        '_event_date'     => 'event_date',
        '_event_time'     => 'event_time',
        '_event_location' => 'event_location',
        '_event_rsvp_url' => 'event_rsvp_url',
        '_event_ticket'   => 'event_ticket',
    ];

    foreach ( $fields as $meta_key => $field_name ) {
        if ( isset( $_POST[$field_name] ) ) {
            update_post_meta( $post_id, $meta_key, sanitize_text_field( $_POST[$field_name] ) );
        }
    }
}
add_action( 'save_post_acm_event', 'acm_chapter_save_event_meta' );


// ── Officers Custom Post Type ─────────────────────────────────────
function acm_chapter_register_officers() {
    register_post_type( 'acm_officer', [
        'labels' => [
            'name'               => 'Officers',
            'singular_name'      => 'Officer',
            'add_new'            => 'Add New Officer',
            'add_new_item'       => 'Add New Officer',
            'edit_item'          => 'Edit Officer',
            'new_item'           => 'New Officer',
            'view_item'          => 'View Officer',
            'search_items'       => 'Search Officers',
            'not_found'          => 'No officers found',
            'not_found_in_trash' => 'No officers found in Trash',
            'menu_name'          => 'Officers',
        ],
        'public'        => false,   // no individual officer URL pages needed
        'show_ui'       => true,    // still shows in WP Admin
        'show_in_menu'  => true,
        'menu_icon'     => 'dashicons-groups',
        'menu_position' => 6,
        'supports'      => [ 'title', 'editor', 'thumbnail' ],
        'show_in_rest'  => true,
    ]);
}
add_action( 'init', 'acm_chapter_register_officers' );


// ── Officer Meta Fields ───────────────────────────────────────────
function acm_chapter_officer_meta_box() {
    add_meta_box(
        'acm_officer_details',
        'Officer Details',
        'acm_chapter_render_officer_meta',
        'acm_officer',
        'normal',
        'high'
    );
}
add_action( 'add_meta_boxes', 'acm_chapter_officer_meta_box' );

function acm_chapter_render_officer_meta( $post ) {
    wp_nonce_field( 'acm_officer_meta', 'acm_officer_nonce' );
    $title    = get_post_meta( $post->ID, '_officer_title',    true );
    $duties   = get_post_meta( $post->ID, '_officer_duties',   true );
    $email    = get_post_meta( $post->ID, '_officer_email',    true );
    $linkedin = get_post_meta( $post->ID, '_officer_linkedin', true );
    $order    = get_post_meta( $post->ID, '_officer_order',    true );
    ?>
    <style>
        .acm-meta-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; padding: 8px 0; }
        .acm-meta-field { display: flex; flex-direction: column; gap: 6px; }
        .acm-meta-field label { font-weight: 600; font-size: 13px; }
        .acm-meta-field input, .acm-meta-field textarea { padding: 6px 10px; border: 1px solid #ddd; border-radius: 4px; font-size: 14px; }
        .acm-meta-full { grid-column: 1 / -1; }
    </style>
    <div class="acm-meta-grid">
        <div class="acm-meta-field">
            <label for="officer_title">🏷 Role / Title <span style="color:red">*</span></label>
            <input type="text" id="officer_title" name="officer_title" value="<?php echo esc_attr($title); ?>" placeholder="Chapter President"/>
        </div>
        <div class="acm-meta-field">
            <label for="officer_order">↕ Display Order</label>
            <input type="number" id="officer_order" name="officer_order" value="<?php echo esc_attr($order); ?>" placeholder="1" min="1"/>
        </div>
        <div class="acm-meta-field acm-meta-full">
            <label for="officer_duties">📋 Duties &amp; Responsibilities</label>
            <textarea id="officer_duties" name="officer_duties" rows="3" placeholder="Leads the chapter, chairs meetings, represents the ACM chapter at regional events..."><?php echo esc_textarea($duties); ?></textarea>
        </div>
        <div class="acm-meta-field">
            <label for="officer_email">✉️ Email Address</label>
            <input type="email" id="officer_email" name="officer_email" value="<?php echo esc_attr($email); ?>" placeholder="president@chapter.acm.org"/>
        </div>
        <div class="acm-meta-field">
            <label for="officer_linkedin">🔗 LinkedIn URL</label>
            <input type="url" id="officer_linkedin" name="officer_linkedin" value="<?php echo esc_attr($linkedin); ?>" placeholder="https://linkedin.com/in/..."/>
        </div>
    </div>
    <p style="margin-top:12px; color:#666; font-size:13px;">💡 Use the <strong>Featured Image</strong> panel on the right to set the officer's photo.</p>
    <p style="color:#666; font-size:13px;">✏️ Write the officer's bio in the block editor above.</p>
    <?php
}

function acm_chapter_save_officer_meta( $post_id ) {
    if ( ! isset( $_POST['acm_officer_nonce'] ) ) return;
    if ( ! wp_verify_nonce( $_POST['acm_officer_nonce'], 'acm_officer_meta' ) ) return;
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
    if ( ! current_user_can( 'edit_post', $post_id ) ) return;

    $fields = [
        '_officer_title'    => 'officer_title',
        '_officer_duties'   => 'officer_duties',
        '_officer_email'    => 'officer_email',
        '_officer_linkedin' => 'officer_linkedin',
        '_officer_order'    => 'officer_order',
    ];

    foreach ( $fields as $meta_key => $field_name ) {
        if ( isset( $_POST[$field_name] ) ) {
            update_post_meta( $post_id, $meta_key, sanitize_text_field( $_POST[$field_name] ) );
        }
    }
    // Sanitize duties as textarea
    if ( isset( $_POST['officer_duties'] ) ) {
        update_post_meta( $post_id, '_officer_duties', sanitize_textarea_field( $_POST['officer_duties'] ) );
    }
}
add_action( 'save_post_acm_officer', 'acm_chapter_save_officer_meta' );


// ── ACM Chapter Customizer Settings ──────────────────────────────
function acm_chapter_customizer( $wp_customize ) {

    // Add a dedicated panel to keep settings grouped
    $wp_customize->add_panel( 'acm_chapter_panel', [
        'title'       => __( 'ACM Chapter Settings', 'acm-chapter' ),
        'description' => __( 'Configure your chapter\'s location, contact info, and social links.', 'acm-chapter' ),
        'priority'    => 30,
    ]);

    // ── Section: Chapter Identity ─────────────────────────────────
    $wp_customize->add_section( 'acm_chapter_identity', [
        'title'    => __( 'Chapter Identity', 'acm-chapter' ),
        'panel'    => 'acm_chapter_panel',
        'priority' => 10,
    ]);

    // Setting: Chapter City
    $wp_customize->add_setting( 'acm_chapter_city', [
        'default'           => 'Your City',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ]);
    $wp_customize->add_control( 'acm_chapter_city', [
        'label'       => __( 'Chapter City', 'acm-chapter' ),
        'description' => __( 'Used throughout the site wherever the city name appears (e.g. "Austin", "Chicago").', 'acm-chapter' ),
        'section'     => 'acm_chapter_identity',
        'type'        => 'text',
    ]);

    // Setting: State Abbreviation
    $wp_customize->add_setting( 'acm_chapter_state', [
        'default'           => 'XX',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ]);
    $wp_customize->add_control( 'acm_chapter_state', [
        'label'       => __( 'State Abbreviation', 'acm-chapter' ),
        'description' => __( 'Two-letter state code shown in location badges (e.g. "TX", "IL").', 'acm-chapter' ),
        'section'     => 'acm_chapter_identity',
        'type'        => 'text',
    ]);

    // ── Section: Contact & Social ─────────────────────────────────
    $wp_customize->add_section( 'acm_chapter_social', [
        'title'    => __( 'Contact & Social Links', 'acm-chapter' ),
        'panel'    => 'acm_chapter_panel',
        'priority' => 20,
    ]);

    // Setting: Contact Email
    $wp_customize->add_setting( 'acm_chapter_email', [
        'default'           => '',
        'sanitize_callback' => 'sanitize_email',
        'transport'         => 'refresh',
    ]);
    $wp_customize->add_control( 'acm_chapter_email', [
        'label'       => __( 'Contact Email', 'acm-chapter' ),
        'description' => __( 'Chapter contact email shown as a mail icon in the footer. Leave blank to hide.', 'acm-chapter' ),
        'section'     => 'acm_chapter_social',
        'type'        => 'email',
    ]);

    // Setting: LinkedIn URL
    $wp_customize->add_setting( 'acm_chapter_linkedin', [
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
        'transport'         => 'refresh',
    ]);
    $wp_customize->add_control( 'acm_chapter_linkedin', [
        'label'       => __( 'LinkedIn URL', 'acm-chapter' ),
        'description' => __( 'Leave blank to hide the LinkedIn icon in the footer.', 'acm-chapter' ),
        'section'     => 'acm_chapter_social',
        'type'        => 'url',
    ]);

    // Setting: Twitter/X URL
    $wp_customize->add_setting( 'acm_chapter_twitter', [
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
        'transport'         => 'refresh',
    ]);
    $wp_customize->add_control( 'acm_chapter_twitter', [
        'label'       => __( 'Twitter / X URL', 'acm-chapter' ),
        'description' => __( 'Leave blank to hide the Twitter/X icon in the footer.', 'acm-chapter' ),
        'section'     => 'acm_chapter_social',
        'type'        => 'url',
    ]);

    // Setting: Facebook URL
    $wp_customize->add_setting( 'acm_chapter_facebook', [
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
        'transport'         => 'refresh',
    ]);
    $wp_customize->add_control( 'acm_chapter_facebook', [
        'label'       => __( 'Facebook URL', 'acm-chapter' ),
        'description' => __( 'Leave blank to hide the Facebook icon in the footer.', 'acm-chapter' ),
        'section'     => 'acm_chapter_social',
        'type'        => 'url',
    ]);

    // Setting: YouTube URL
    $wp_customize->add_setting( 'acm_chapter_youtube', [
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
        'transport'         => 'refresh',
    ]);
    $wp_customize->add_control( 'acm_chapter_youtube', [
        'label'       => __( 'YouTube URL', 'acm-chapter' ),
        'description' => __( 'Leave blank to hide the YouTube icon in the footer.', 'acm-chapter' ),
        'section'     => 'acm_chapter_social',
        'type'        => 'url',
    ]);

    // Setting: Instagram URL
    $wp_customize->add_setting( 'acm_chapter_instagram', [
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
        'transport'         => 'refresh',
    ]);
    $wp_customize->add_control( 'acm_chapter_instagram', [
        'label'       => __( 'Instagram URL', 'acm-chapter' ),
        'description' => __( 'Leave blank to hide the Instagram icon in the footer.', 'acm-chapter' ),
        'section'     => 'acm_chapter_social',
        'type'        => 'url',
    ]);
}
add_action( 'customize_register', 'acm_chapter_customizer' );


// ── Auto-create Pages on Theme Activation ─────────────────────────
function acm_chapter_create_pages() {

    $pages = [
        'home'       => 'Home',
        'about'      => 'About',
        'events'     => 'Events',
        'officers'   => 'Officers',
        'membership' => 'Membership',
        'contact'    => 'Contact',
    ];

    $front_page_id = 0;

    foreach ( $pages as $slug => $title ) {
        // Skip if a page with this slug already exists
        $existing = get_page_by_path( $slug );
        if ( $existing ) {
            if ( $slug === 'home' ) {
                $front_page_id = $existing->ID;
            }
            continue;
        }

        $id = wp_insert_post([
            'post_title'  => $title,
            'post_name'   => $slug,
            'post_status' => 'publish',
            'post_type'   => 'page',
            'post_author' => 1,
        ]);

        if ( $slug === 'home' && ! is_wp_error( $id ) ) {
            $front_page_id = $id;
        }
    }

    // Set static front page
    if ( $front_page_id ) {
        update_option( 'show_on_front', 'page' );
        update_option( 'page_on_front', $front_page_id );
    }
}
add_action( 'after_switch_theme', 'acm_chapter_create_pages' );


// ── ACM Chapter Location Helpers ─────────────────────────────────

/**
 * Returns the chapter city name from Customizer.
 * Use for: "Irving", "Austin", "Chicago"
 */
function acm_chapter_city() {
    return esc_html( get_theme_mod( 'acm_chapter_city', 'Your City' ) );
}

/**
 * Returns the state abbreviation from Customizer.
 * Use for: "TX", "IL", "NC"
 */
function acm_chapter_state() {
    return esc_html( get_theme_mod( 'acm_chapter_state', 'XX' ) );
}

/**
 * Returns "City, ST" — used in hero eyebrow and location badges.
 * Example: "Irving, TX"
 */
function acm_chapter_city_state() {
    return acm_chapter_city() . ', ' . acm_chapter_state();
}

/**
 * Returns "the City area" — used in contextual body copy.
 * Example: "the Irving area"
 */
function acm_chapter_city_area() {
    return 'the ' . acm_chapter_city() . ' area';
}

/**
 * Returns the contact email from Customizer, or empty string.
 */
function acm_chapter_email() {
    return sanitize_email( get_theme_mod( 'acm_chapter_email', '' ) );
}

/**
 * Returns the full chapter name: "ACM [City]"
 * Example: "ACM Irving"
 */
function acm_chapter_name() {
    return 'ACM ' . acm_chapter_city();
}
