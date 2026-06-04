<?php

/**
 * Redirect Attachments to media URL
 */
add_filter('rank_math/frontend/attachment/redirect_url', function ($redirect, $post) {
    return $post->guid;
}, 10, 2);

?>