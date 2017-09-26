<?php
/**
 * The template for displaying Comments.
 */
?>

 <div id="comments">
          <?php if ( post_password_required() ) : ?>
			<p class="nopassword"><?php _e( 'This post is password protected. Enter the password to view any comments.' , 'h-framework' ); ?></p>
			</div><!-- #comments -->
      <?php return; endif; ?>

<?php
	// You can start editing here -- including this comment!
?>


<?php if ( have_comments() ) : ?>
			
            <h6 class='custom-font heading' id="comments-title"><?php
			printf( _n( 'One Comment to %2$s', '%1$s Comments to %2$s', get_comments_number() ),
			number_format_i18n( get_comments_number() ), '<em>' . get_the_title() . '</em>' );
			?></h6>

        <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
			<div class="navigation">
				<div class="nav-previous"><?php previous_comments_link( __( '<span class="meta-nav">&larr;</span> Older Comments' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( __( 'Newer Comments <span class="meta-nav">&rarr;</span>' ) ); ?></div>
			</div> <!-- .navigation -->
            
        <?php endif; // check for comment navigation ?>

		<ol class="commentlist">
				<?php wp_list_comments( array( 'callback' => 'hades_comment' ) ); 				?>
		</ol>

<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
			<div class="navigation">
				<div class="nav-previous"><?php previous_comments_link( __( '<span class="meta-nav">&larr;</span> Older Comments' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( __( 'Newer Comments <span class="meta-nav">&rarr;</span>' ) ); ?></div>
			</div><!-- .navigation -->
<?php endif; // check for comment navigation ?>

<?php else : // or, if we don't have comments:

	/* If there are no comments and comments are closed,
	 * let's leave a little note, shall we?
	 */
	if ( ! comments_open() ) :
?>
	
<?php endif; // end ! comments_open() ?>

<?php endif; // end have_comments() ?>

<?php 

$newfields =  array(
	'author' => '<p class="comment-form-author clearfix">'  .
	            '<input id="author" name="author" type="text" value="' . esc_attr( ($commenter['comment_author']=="") ? 'Name' : $commenter['comment_author'] ) . '" size="40"/> <span> <small>*</small> Required </span></p>',
	'email'  => '<p class="comment-form-email clearfix">'  .
	            '<input id="email" name="email" type="text" value="' . esc_attr(  ($commenter['comment_author_email']=="") ? 'Email' : $commenter['comment_author_email'], 'h-framework' ) . '" size="40" /> <span> <small>*</small> Required </span></p>',
	'url'    => '<p class="comment-form-url clearfix">' .
	            '<input id="url" name="url" type="text" value="' . esc_attr( ($commenter['comment_author_url']=="") ? 'Website' : $commenter['comment_author_url'], 'h-framework' ) . '" size="40" /></p>',
);

 $defaults = array(
	'fields'               => apply_filters( 'comment_form_default_fields', $newfields ),
	'comment_field'        => '<p class="comment-form-comment clearfix"><textarea id="comment" name="comment" cols="51" rows="8" ></textarea></p>',
	'must_log_in'          => '<p class="must-log-in">' .  sprintf( __( 'You must be <a href="%s">logged in</a> to post a comment.' , 'h-framework'), wp_login_url( apply_filters( 'the_permalink', get_permalink(  $post->ID ) ) ) ) . '</p>',
	'logged_in_as'         => '<p class="logged-in-as">' . sprintf( __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>', 'h-framework' ), admin_url( 'profile.php' ), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink(  $post->ID ) ) ) ) . '</p>',
	'comment_notes_before' => '<p class="comment-notes"></p>',
	'comment_notes_after'  => '',
	'id_submit'            => 'submit',
	'title_reply'          => __( '<span class="custom-font heading">Leave A Response </span>' , 'h-framework'),
	'title_reply_to'       => __( '<h6 class="custom-font">Leave a Reply to %s</h6>', 'h-framework' ),
	'cancel_reply_link'    => __( 'Cancel reply', 'h-framework' ),
	'label_submit'         => __( 'Post Comment', 'h-framework' )
);


comment_form( $defaults , $post->ID ); ?>

</div><!-- #comments -->
