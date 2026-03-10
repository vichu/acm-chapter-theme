<?php
/**
 * Contact Page Template
 * ACM Chapter Theme — Auto-loaded by WordPress for any page with slug "contact".
 */
get_header();
?>

<!-- PAGE HERO -->
<section class="page-hero">
    <div class="page-hero-inner">
        <span class="eyebrow">Get in Touch</span>
        <h1>Contact Us</h1>
        <p>Have a question, idea, or want to get involved with <?php echo acm_chapter_name(); ?>? Here's how to reach us.</p>
    </div>
</section>

<!-- CONTACT SECTION -->
<section class="section">
    <div class="section-inner contact-cards-layout">

        <div class="contact-card">
            <span class="contact-card-icon">✉️</span>
            <h3>Email Us</h3>
            <p>For general questions, membership inquiries, or anything else — email is the best way to reach the chapter.</p>
            <?php $email = acm_chapter_email(); if ( $email ) : ?>
            <a href="mailto:<?php echo esc_attr( $email ); ?>" class="contact-card-action"><?php echo esc_html( $email ); ?></a>
            <?php else : ?>
            <span class="contact-card-action" style="color: var(--text-muted);">Email coming soon</span>
            <?php endif; ?>
        </div>

        <div class="contact-card">
            <span class="contact-card-icon">🗣️</span>
            <h3>Speak at an Event</h3>
            <p>We're always looking for computing professionals to share their expertise with the <?php echo acm_chapter_city_area(); ?> community. Tell us about your topic.</p>
            <?php $email = acm_chapter_email(); if ( $email ) : ?>
            <a href="mailto:<?php echo esc_attr( $email ); ?>?subject=Speaker%20Proposal" class="contact-card-action">Submit a Speaker Proposal →</a>
            <?php endif; ?>
        </div>

        <div class="contact-card">
            <span class="contact-card-icon">🤝</span>
            <h3>Join the Chapter</h3>
            <p>Become a member of the <?php echo acm_chapter_name(); ?> Professional Chapter. Support the community, gain priority event access, and have a voice in how the chapter grows.</p>
            <a href="<?php echo esc_url( home_url('/membership') ); ?>" class="contact-card-action">Learn About Membership →</a>
        </div>

        <div class="contact-card">
            <span class="contact-card-icon">📍</span>
            <h3>Where We Meet</h3>
            <p>Our events are held in <?php echo acm_chapter_city_area(); ?>. Location details are included with each event.</p>
            <a href="<?php echo esc_url( home_url('/events') ); ?>" class="contact-card-action">View Upcoming Events →</a>
        </div>

    </div>
</section>

<!-- ACM SUPPORT -->
<section class="section section-alt">
    <div class="section-inner section-inner--center">
        <span class="eyebrow">ACM Global</span>
        <h2 class="section-title">Need Help with ACM Membership?</h2>
        <p class="section-sub">For questions about your ACM membership, the Digital Library, or global ACM services — contact ACM directly.</p>
        <a href="https://www.acm.org/about-acm/contact-us" target="_blank" rel="noopener" class="btn btn-blue">ACM Global Support →</a>
    </div>
</section>

<?php get_footer(); ?>
