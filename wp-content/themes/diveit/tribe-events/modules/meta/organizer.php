<?php
/**
 * Single Event Meta (Organizer) Template
 *
 * Override this template in your own theme by creating a file at:
 * [your-theme]/tribe-events/modules/meta/organizer.php
 *
 * @package TribeEventsCalendar
 * @version 4.6.19
 */

$organizer_ids = tribe_get_organizer_ids();
$multiple = count( $organizer_ids ) > 1;

$phone = tribe_get_organizer_phone();
$email = tribe_get_organizer_email();
$website = tribe_get_organizer_website_link();
?>

<div class="tribe-events-meta-group tribe-events-meta-group-organizer">
    <h2 class="tribe-events-single-section-title"><?php echo tribe_get_organizer_label( ! $multiple ); ?></h2>
    <dl>
        <?php
        do_action( 'tribe_events_single_meta_organizer_section_start' );

        foreach ( $organizer_ids as $organizer ) {
            if ( ! $organizer ) {
                continue;
            }

            ?>
            <dt style="display:none;"><?php // This element is just to make sure we have a valid HTML ?></dt>
            <dd class="tribe-organizer">
                <?php echo tribe_get_organizer_link( $organizer ) ?>
            </dd>
            <?php
        }

        if ( ! $multiple ) { // only show organizer details if there is one
            if ( ! empty( $phone ) ) {
                ?>
                <dt class="tribe-organizer-tel-label">
                    <?php esc_html_e( 'Phone:', 'diveit' ) ?>
                </dt>
                <dd class="tribe-organizer-tel">
                    <a href="tel:<?php echo esc_attr( $phone ) ?>"><?php echo esc_html( $phone ); ?></a>
                </dd>
                <?php
            }

            if ( ! empty( $email ) ) {
                ?>
                <dt class="tribe-organizer-email-label">
                    <?php esc_html_e( 'Email:', 'diveit' ) ?>
                </dt>
                <dd class="tribe-organizer-email">
                    <?php diveit_show_layout ('<a href="mailto:'. antispambot($email) .'">' . ' ' . esc_html($email) . '</a>'); ?>

                </dd>
                <?php
            }

            if ( ! empty( $website ) ) {
                ?>
                <dt class="tribe-organizer-url-label">
                    <?php esc_html_e( 'Website:', 'diveit' ) ?>
                </dt>
                <dd class="tribe-organizer-url">
                    <?php diveit_show_layout($website); ?>
                </dd>
                <?php
            }
        }

        do_action( 'tribe_events_single_meta_organizer_section_end' );
        ?>
    </dl>
</div>
