<?php
/**
 * List View Single Event template file.
 * Created according to the Themer’s Guide for The Events Calendar plugin (https://theeventscalendar.com/knowledgebase/themers-guide/). 
 * @package HappenStance
 * @since HappenStance 1.0.0
*/
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

// Setup an array of venue details for use later in the template
$venue_details = tribe_get_venue_details();

// Venue
$has_venue_address = ( ! empty( $venue_details['address'] ) ) ? ' location' : '';

// Organizer
$organizer = tribe_get_organizer();

?>

<!-- Event Cost -->
<?php if ( tribe_get_cost() ) : ?>
	<div class="tribe-events-event-cost">
		<span><?php echo tribe_get_cost( null, true ); ?></span>
	</div>
<?php endif; ?>

<!-- Event Title -->
<?php do_action( 'tribe_events_before_the_event_title' ) ?>
<h2 class="tribe-events-list-event-title">
	<a class="tribe-event-url" href="<?php echo esc_url( tribe_get_event_link() ); ?>" title="<?php the_title_attribute() ?>" rel="bookmark">
		<?php the_title() ?>
	</a>
</h2>
<?php do_action( 'tribe_events_after_the_event_title' ) ?>

<!-- Event Meta -->
<?php do_action( 'tribe_events_before_the_meta' ) ?>
<div class="tribe-events-event-meta">
	<div class="author <?php echo esc_attr( $has_venue_address ); ?>">

		<!-- Schedule & Recurrence Details -->
		<div class="tribe-event-schedule-details">
			<?php echo tribe_events_event_schedule_details() ?>
		</div>

		<?php if ( $venue_details ) : ?>
			<!-- Venue Display Info -->
			<div class="tribe-events-venue-details">
				<?php echo implode( ', ', $venue_details ); ?>
			</div> <!-- .tribe-events-venue-details -->
		<?php endif; ?>

	</div>
</div><!-- .tribe-events-event-meta -->
<?php do_action( 'tribe_events_after_the_meta' ) ?>

<!-- Event Image -->
<a href="<?php echo get_permalink(); ?>"><?php the_post_thumbnail(); ?></a>

<!-- Event Content -->
<?php do_action( 'tribe_events_before_the_content' ) ?>
<div class="tribe-events-list-event-description tribe-events-content">
	<?php echo tribe_events_get_the_excerpt( null, wp_kses_allowed_html( 'post' ) ); ?>
	<a href="<?php echo esc_url( tribe_get_event_link() ); ?>" class="tribe-events-read-more" rel="bookmark"><?php esc_html_e( 'Read more', 'happenstance' ); ?></a>
</div><!-- .tribe-events-list-event-description -->
<?php do_action( 'tribe_events_after_the_content' ); ?>