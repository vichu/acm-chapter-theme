<?php
/**
 * Single Event Template
 * Renders an individual event page at /events/event-slug/
 * WordPress routes here automatically for any acm_event post.
 */
get_header();

while ( have_posts() ) : the_post();
    $date     = get_post_meta( get_the_ID(), '_event_date', true );
    $time     = get_post_meta( get_the_ID(), '_event_time', true );
    $location = get_post_meta( get_the_ID(), '_event_location', true );
    $rsvp_url = get_post_meta( get_the_ID(), '_event_rsvp_url', true );
    $ticket   = get_post_meta( get_the_ID(), '_event_ticket', true );
    $ts       = $date ? strtotime( $date ) : false;
    $is_past  = $ts && $ts < strtotime('today');
?>

<!-- EVENT HERO -->
<section class="page-hero event-single-hero">
    <div class="page-hero-inner">
        <span class="eyebrow">
            <?php echo $is_past ? 'Past Event' : 'Upcoming Event'; ?>
        </span>
        <h1><?php the_title(); ?></h1>
        <?php if ( $ts ) : ?>
        <p class="event-single-date">
            <?php echo date( 'l, F j, Y', $ts ); ?>
            <?php if ( $time ) : ?>· <?php echo esc_html( $time ); ?><?php endif; ?>
        </p>
        <?php endif; ?>
    </div>
</section>

<!-- EVENT BODY -->
<section class="section">
    <div class="section-inner event-single-layout">

        <!-- Main content -->
        <article class="event-single-content">
            <?php the_content(); ?>
        </article>

        <!-- Details sidebar -->
        <aside class="event-single-sidebar">
            <div class="event-sidebar-card">
                <h3>Event Details</h3>

                <?php if ( $ts ) : ?>
                <div class="sidebar-detail">
                    <span class="detail-icon">📅</span>
                    <div>
                        <strong>Date</strong>
                        <span><?php echo date( 'F j, Y', $ts ); ?></span>
                    </div>
                </div>
                <?php endif; ?>

                <?php if ( $time ) : ?>
                <div class="sidebar-detail">
                    <span class="detail-icon">🕕</span>
                    <div>
                        <strong>Time</strong>
                        <span><?php echo esc_html( $time ); ?></span>
                    </div>
                </div>
                <?php endif; ?>

                <?php if ( $location ) : ?>
                <div class="sidebar-detail">
                    <span class="detail-icon">📍</span>
                    <div>
                        <strong>Location</strong>
                        <span><?php echo esc_html( $location ); ?></span>
                    </div>
                </div>
                <?php endif; ?>

                <?php if ( $ticket ) : ?>
                <div class="sidebar-detail">
                    <span class="detail-icon">🎟</span>
                    <div>
                        <strong>Admission</strong>
                        <span><?php echo esc_html( $ticket ); ?></span>
                    </div>
                </div>
                <?php endif; ?>

                <?php if ( $rsvp_url && ! $is_past ) : ?>
                    <a href="<?php echo esc_url( $rsvp_url ); ?>" class="btn btn-gold btn-block" target="_blank" rel="noopener">
                        RSVP Now →
                    </a>
                <?php elseif ( $is_past ) : ?>
                    <p class="sidebar-past-note">This event has already taken place.</p>
                <?php endif; ?>
            </div>

            <a href="<?php echo esc_url( home_url('/events') ); ?>" class="event-back-link">
                ← Back to All Events
            </a>
        </aside>

    </div>
</section>

<?php endwhile; ?>

<?php get_footer(); ?>
