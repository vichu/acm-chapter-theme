<?php
/**
 * Membership Page Template
 * ACM Chapter Theme — Auto-loaded by WordPress for any page with slug "membership".
 * Covers local chapter membership only — intentionally distinct from ACM global membership.
 */
get_header();
?>

<!-- PAGE HERO -->
<section class="page-hero membership-hero">
    <div class="page-hero-inner">
        <span class="eyebrow"><?php echo acm_chapter_name(); ?> Professional Chapter</span>
        <h1>Become a Chapter Member</h1>
        <p>Join the local computing community in <?php echo acm_chapter_city_area(); ?>. Support the events we organize, connect with fellow professionals, and help shape the future of this chapter.</p>
    </div>
</section>



<!-- WHAT MEMBERSHIP MEANS -->
<section class="section">
    <div class="section-inner">
        <span class="eyebrow">Why Join</span>
        <h2 class="section-title">What Chapter Membership Means</h2>
        <p class="section-sub">We are a local Professional Chapter of the ACM. By becoming a member, you are joining the local computing community and directly supporting the programs we run in <?php echo acm_chapter_city_area(); ?>.</p>

        <div class="membership-benefits-grid">

            <div class="membership-benefit">
                <span class="benefit-icon">📅</span>
                <div>
                    <h3>Priority Event Access</h3>
                    <p>Receive direct invitations to chapter meetups, workshops, networking events, and speaker series before they're announced publicly.</p>
                </div>
            </div>

            <div class="membership-benefit">
                <span class="benefit-icon">🏛️</span>
                <div>
                    <h3>Have a Voice</h3>
                    <p>Members have a say in how the chapter is run and are eligible to take on leadership roles as the chapter grows.</p>
                </div>
            </div>

            <div class="membership-benefit">
                <span class="benefit-icon">🤝</span>
                <div>
                    <h3>Community &amp; Networking</h3>
                    <p>Connect with computing professionals across <?php echo acm_chapter_city_area(); ?>. Build relationships that go beyond the event room.</p>
                </div>
            </div>

            <div class="membership-benefit">
                <span class="benefit-icon">💡</span>
                <div>
                    <h3>Shape What We Build</h3>
                    <p>Members influence the direction of the chapter — the topics we cover, the speakers we invite, and the events we organize.</p>
                </div>
            </div>

            <div class="membership-benefit">
                <span class="benefit-icon">🌱</span>
                <div>
                    <h3>Support the Community</h3>
                    <p>Your membership directly funds chapter operations — venue costs, speaker logistics, and everything that keeps our events running.</p>
                </div>
            </div>

            <div class="membership-benefit">
                <span class="benefit-icon">📰</span>
                <div>
                    <h3>Communications of the ACM</h3>
                    <p>Complimentary three-month electronic subscription to ACM's flagship publication — one of the most respected journals in computing.</p>
                </div>
            </div>

            <div class="membership-benefit">
                <span class="benefit-icon">📧</span>
                <div>
                    <h3>acm.org Email Address</h3>
                    <p>A personal @acm.org email forwarding address with filtering — a recognizable mark of your computing community membership.</p>
                </div>
            </div>

            <div class="membership-benefit">
                <span class="benefit-icon">📬</span>
                <div>
                    <h3>ACM E-Newsletters</h3>
                    <p><strong>TechNews</strong> — computing news 3× weekly. <strong>CareerNews</strong> — career and industry news bi-monthly. <strong>MemberNet</strong> — ACM people and events quarterly.</p>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- TRANSPARENCY SECTION -->
<section class="section section-alt">
    <div class="section-inner membership-transparency-layout">

        <div class="transparency-text">
            <span class="eyebrow">Transparency</span>
            <h2>About Our Costs</h2>
            <p>Our meetings are currently <strong>free to attend</strong> — and we want to keep it that way. But running a chapter isn't without cost. Venue arrangements, event logistics, communications, and operational overhead all add up.</p>
            <p>Chapter membership fees help us cover these costs sustainably, without relying on sponsorships or charging for individual events. When you become a member, you're not just joining a community — you're helping keep it running for everyone.</p>
            <p>We believe in being upfront about this. There's no hidden agenda — just a group of computing professionals trying to build something meaningful for <?php echo acm_chapter_city_area(); ?>.</p>
        </div>

        <div class="transparency-card">
            <div class="pricing-label">Chapter Membership</div>
            <div class="pricing-amount">$150</div>
            <div class="pricing-period">per year</div>
            <div class="pricing-note">Same rate for both Professional and Student members</div>
            <hr class="pricing-divider"/>
            <ul class="pricing-includes">
                <li>✓ Priority event invitations</li>
                <li>✓ Voice in chapter governance</li>
                <li>✓ Direct support of chapter programs</li>
            </ul>
            <?php $email = acm_chapter_email(); if ( $email ) : ?>
            <a href="mailto:<?php echo esc_attr( $email ); ?>?subject=Chapter%20Membership" class="btn btn-gold btn-block">
                Join the Chapter →
            </a>
            <p class="pricing-footer">Reach out by email and we'll walk you through the process.</p>
            <?php endif; ?>
        </div>

    </div>
</section>

<!-- PAYMENT PLACEHOLDER -->
<section class="section section-light" id="join">
    <div class="section-inner">
        <span class="eyebrow">Pay for Membership</span>
        <h2 class="section-title">How to Pay</h2>
        <p class="section-sub">Online payment is coming soon. In the meantime, here's how to complete your chapter membership.</p>

        <div class="payment-placeholder">
            <div class="payment-placeholder-icon">💳</div>
            <h3>Online Payment — Coming Soon</h3>
            <p>We are setting up online payment. Once available, you'll be able to pay your $150 annual membership fee directly from this page.</p>
            <?php $email = acm_chapter_email(); if ( $email ) : ?>
            <div class="payment-divider">
                <span>In the meantime</span>
            </div>
            <p>Email us at <a href="mailto:<?php echo esc_attr( $email ); ?>?subject=Chapter%20Membership%20Payment"><?php echo esc_html( $email ); ?></a> with the subject <strong>"Chapter Membership Payment"</strong> and we'll send you payment instructions. We'll confirm your membership as soon as payment is received.</p>
            <?php endif; ?>
            <!-- PAYMENT PLACEHOLDER: Replace this comment with your payment button code once your account is ready -->
        </div>

    </div>
</section>

<!-- FAQ -->
<section class="section" id="faq">
    <div class="section-inner membership-faq-layout">
        <div>
            <span class="eyebrow">Common Questions</span>
            <h2>FAQ</h2>
        </div>
        <div class="faq-list">

            <div class="faq-item">
                <h4>Do I need to be an ACM global member to join?</h4>
                <p>No. The <?php echo acm_chapter_name(); ?> Professional Chapter is a locally organized community. You do not need a global ACM membership to become a chapter member or attend our events.</p>
            </div>

            <div class="faq-item">
                <h4>Can I attend events without being a member?</h4>
                <p>Yes — our events are currently free and open to all computing professionals in <?php echo acm_chapter_city_area(); ?>. Membership gives you priority access and supports the chapter, but it is not required to attend.</p>
            </div>

            <div class="faq-item">
                <h4>How do I pay for membership?</h4>
                <?php $email = acm_chapter_email(); ?>
                <p><?php if ( $email ) : ?>Email us at <a href="mailto:<?php echo esc_attr( $email ); ?>"><?php echo esc_html( $email ); ?></a> and we'll send you payment details.<?php else : ?>Contact us through the <a href="<?php echo esc_url( home_url('/contact') ); ?>">contact page</a> and we'll send you payment details.<?php endif; ?> Online payment options are coming soon.</p>
            </div>

            <div class="faq-item">
                <h4>Is there a student rate?</h4>
                <p>Yes — membership is $150/year for both Professional and Student members while we are in our early stage of operations.</p>
            </div>

        </div>
    </div>
</section>

<?php get_footer(); ?>
