<?php
/**
 * The default template for a password protected post.
 *
 * @package Bucket Lite
 * @since Bucket Lite 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $wpgrade_private_post; ?>

<div id="main" class="content djax-updatable">
	<div class="page-content">
		<div class="page-main">
			<header class="entry__header">
				<h1 class="entry__title"><?php esc_html_e('Password ', 'bucket-lite');  the_title(); ?></h1>
				<div class="bleed--left"><hr class="separator separator--dotted grow"></div>
			</header>
			<div class="entry__body">
				<form method="post" action="<?php echo esc_url( get_the_permalink() ); ?>" class="comment-respond">
					<?php wp_nonce_field('password_protection','submit_password_nonce'); ?>
					<input type="hidden" name="submit_password" value="1" />
				
					<?php 
						if( $wpgrade_private_post['error'] ) {
							echo $wpgrade_private_post['error'];
							echo '<p>' . esc_html__('Please enter your password again:', 'bucket-lite') . '</p>';
						} else {
							echo '<p>' . esc_html__('To view it please enter your password below:', 'bucket-lite') . '</p>';
						}
					?>
					
					<div class="row">
						<div class="col-6 hand-span-6">
							<input type="password" required="required" size="20" id="pwbox-531" name="post_password" placeholder="<?php esc_html_e('Password..', 'bucket-lite') ?>"/></label><br/>
						</div>
						<div class="col-6 hand-span-6">
							<input type="submit" name="Submit" value="Access" placeholder="Access" class="btn btn--huge post-password-submit"/>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
