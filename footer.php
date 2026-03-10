<footer class="site-footer">
    <div class="footer-inner">
        <div class="footer-grid">

            <!-- Brand Column -->
            <div class="footer-brand">
                <a href="<?php echo esc_url(home_url('/')); ?>">
                    <img
                        src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/logo_footer_acm.png' ); ?>"
                        alt="<?php bloginfo('name'); ?>"
                        class="footer-logo"
                    />
                </a>
                <p class="footer-desc">
                    A professional chapter of the Association for Computing Machinery
                    serving the <?php echo acm_chapter_city(); ?> technology community.
                </p>
                <div class="social-row">
                    <?php
                    $img_base = get_template_directory_uri() . '/assets/images/';
                    $socials = [
                        'linkedin'  => ['url' => get_theme_mod( 'acm_chapter_linkedin',  '' ), 'label' => 'LinkedIn',    'img' => $img_base . 'linkedin.svg'],
                        'twitter'   => ['url' => get_theme_mod( 'acm_chapter_twitter',   '' ), 'label' => 'Twitter / X', 'img' => $img_base . 'twitter.svg'],
                        'facebook'  => ['url' => get_theme_mod( 'acm_chapter_facebook',  '' ), 'label' => 'Facebook',    'img' => $img_base . 'facebook.svg'],
                        'youtube'   => ['url' => get_theme_mod( 'acm_chapter_youtube',   '' ), 'label' => 'YouTube',     'img' => $img_base . 'youtube.svg'],
                        'instagram' => ['url' => get_theme_mod( 'acm_chapter_instagram', '' ), 'label' => 'Instagram',   'img' => $img_base . 'instagram.svg'],
                    ];
                    foreach ( $socials as $name => $data ) :
                        if ( empty( $data['url'] ) ) continue; // Only render if URL is configured
                    ?>
                        <a href="<?php echo esc_url( $data['url'] ); ?>"
                           class="social-btn"
                           title="<?php echo esc_attr( $data['label'] ); ?>"
                           target="_blank" rel="noopener">
                            <img src="<?php echo esc_url( $data['img'] ); ?>" alt="<?php echo esc_attr( $data['label'] ); ?>"/>
                        </a>
                    <?php endforeach; ?>

                    <?php $contact_email = acm_chapter_email(); if ( $contact_email ) : ?>
                        <a href="mailto:<?php echo esc_attr( $contact_email ); ?>"
                           class="social-btn"
                           title="Email">
                            <img src="<?php echo esc_url( $img_base . 'mail.svg' ); ?>" alt="Email"/>
                        </a>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Chapter Links -->
            <div class="footer-col">
                <h4>Chapter</h4>
                <ul>
                    <li><a href="<?php echo esc_url(home_url('/')); ?>">Home</a></li>
                    <li><a href="<?php echo esc_url(home_url('/about')); ?>">About Us</a></li>
                    <li><a href="<?php echo esc_url(home_url('/officers')); ?>">Officers</a></li>
                    <li><a href="<?php echo esc_url(home_url('/events')); ?>">Events</a></li>
                    <li><a href="<?php echo esc_url(home_url('/contact')); ?>">Contact</a></li>
                </ul>
            </div>

            <!-- Membership Links -->
            <div class="footer-col">
                <h4>Chapter Membership</h4>
                <ul>
                    <li><a href="<?php echo esc_url(home_url('/membership')); ?>">Join the Chapter</a></li>
                    <li><a href="<?php echo esc_url(home_url('/membership')); ?>#faq">Membership FAQ</a></li>
                    <li><a href="<?php echo esc_url(home_url('/officers')); ?>">Chapter Officers</a></li>
                    <li><a href="<?php echo esc_url(home_url('/contact')); ?>">Contact Us</a></li>
                </ul>
            </div>

            <!-- ACM Global Links -->
            <div class="footer-col">
                <h4>ACM Global</h4>
                <ul>
                    <li><a href="https://www.acm.org" target="_blank" rel="noopener">ACM.org</a></li>
                    <li><a href="https://dl.acm.org" target="_blank" rel="noopener">Digital Library</a></li>
                    <li><a href="https://www.acm.org/chapters" target="_blank" rel="noopener">All Chapters</a></li>
                    <li><a href="mailto:technicalsupport@acm.org">ACM Support</a></li>
                </ul>
            </div>

        </div><!-- .footer-grid -->

        <!-- Bottom Bar -->
        <div class="footer-bottom">
            <span>
                &copy; <?php echo date('Y'); ?>
                <?php bloginfo('name'); ?>.
                All rights reserved.
            </span>
            <span>
                Part of the
                <a href="https://www.acm.org" target="_blank" rel="noopener">
                    Association for Computing Machinery
                </a>
            </span>
        </div>

    </div><!-- .footer-inner -->
</footer>

<?php wp_footer(); ?>
</body>
</html>
