<?php
/**
 * Title: Comments
 * slug: blockbase/comments
 * inserter: no
 */

?>
<!-- wp:comments-query-loop -->
<div class="wp-block-comments-query-loop">
	<!-- wp:comment-template -->

	<div class="Comment mb-30">
		<div class="CommentProfile">
			<div class="CommentProfile-avatarRow">
				<!-- wp:avatar {"size":40, "className": "CommentProfile-avatar"} /-->
				<!-- wp:comment-author-name {"className": "CommentProfile-username"} /-->
			</div>
		</div>

		<!-- wp:comment-content /-->

		<!-- wp:comment-reply-link /-->
	</div>
	<!-- /wp:columns -->
	<!-- /wp:comment-template -->

	<!-- wp:comments-pagination -->
	<!-- wp:comments-pagination-previous /-->

	<!-- wp:comments-pagination-numbers /-->

	<!-- wp:comments-pagination-next /-->
	<!-- /wp:comments-pagination -->

	<!-- wp:post-comments-form /-->
</div>
<!-- /wp:comments-query-loop --> 
