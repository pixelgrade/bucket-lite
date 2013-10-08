<?php global $wpgrade_private_post; ?>
<div id="main" class="content djax-updatable">
	<div class="page-content">
		<div class="page-main">
			<header class="entry__header">
				<h1 class="entry__title">Password <?php the_title(); ?></h1>
				<div class="bleed--left"><hr class="separator separator--dotted grow"></div>
			</header>
			<div class="entry__body">
				<form method="post" action="<?php the_permalink() ?>" class="comment-respond">
					<?php wp_nonce_field('password_protection','submit_password_nonce'); ?>
					<input type="hidden" name="submit_password" value="1" />
					<p>To view it please enter your password below:</p>
					<?php echo $wpgrade_private_post['error']; ?>
					<p>Please enter your password again:</p>
					<div class="row">
						<div class="col-6 hand-span-6">
							<input type="password" required="required" size="20" id="pwbox-531" name="post_password" placeholder="Password.."/></label><br/>
						</div>
						<div class="col-6 hand-span-6">
							<input type="submit" name="Submit" class="btn btn--huge"/>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>