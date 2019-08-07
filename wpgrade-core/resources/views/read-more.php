<?php defined( 'ABSPATH' ) or die;
/* @var stdClass $post */
/* @var mixed $more */
?>

<div>
	<a class="btn btn-primary excerpt-read-more"
		href="<?php echo esc_url( get_permalink( wpgrade::lang_post_id( $post->ID ) ) ); ?>"
		title="<?php echo esc_html__( 'Read more about', 'bucket-lite' ) . ' ' . get_the_title( wpgrade::lang_post_id( $post->ID ) ); ?>">

		<?php echo esc_html__( 'Read more', 'bucket-lite' ) ?>

	</a>
</div>
