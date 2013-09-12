<?php get_header() ?>

	<div class="wrapper-featured-image no-image"></div>

	<div class="row wrapper wrapper-main">

		<div class="container">
			<div class="main main-page" role="main">

				<h1 class="heading-404">
					<?php _e('404', wpgrade::textdomain()) ?>
				</h1>

				<article id="post-0" class="post error404 not-found">

					<h2 class="entry-title">
						<?php _e('Oops! That page can&rsquo;t be found.', wpgrade::textdomain()) ?>
					</h2>

					<p>
						<?php echo strtr
							(
								__
								(
									// [!!] changing the formatting will break translations
									'This may be because of a mistyped URL, faulty referral or out-of-date search engine listing. <br /> '
									. 'You should try the <a href=":home_url">homepage</a> instead or maybe do a search?',
									wpgrade::textdomain()
								),
								array(
									':home_url' => home_url(),
								)
							)
						?>
					</p>

					<div class="search-form">
						<?php get_search_form() ?>
					</div>

				</article>

			</div>
		</div>

		<?php get_sidebar() ?>

	</div>

<?php get_footer() ?>