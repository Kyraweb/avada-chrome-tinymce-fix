<?php
/**
 * Plugin Name:       Avada Chrome TinyMCE Fix
 * Plugin URI:        https://github.com/
 * Description:       Fixes the phantom blank line that appears at the top of Avada Builder text/headline elements when editing in Chrome. Caused by Chrome injecting a <br> after TinyMCE's bookmark span on editor initialization.
 * Version:           1.0.0
 * Requires at least: 5.0
 * Requires PHP:      7.4
 * Author:            Kyra Web Studio
 * Author URI:        https://kyraweb.ca 
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       avada-chrome-tinymce-fix
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * FIX: TinyMCE Phantom Line in Chrome (Avada Builder)
 *
 * PROBLEM:
 * When editing text/headline elements in Avada's backend builder,
 * Chrome injects a bookmark span + <br> tag at the start of the
 * content via TinyMCE on initialization. This renders as a blank
 * line above the content. Firefox/Edge are unaffected.
 *
 * CAUSE:
 * TinyMCE inserts a cursor anchor (data-mce-type="bookmark") when
 * a contenteditable element is initialized. Chrome uniquely adds
 * a <br> after it, creating a visible empty line.
 *
 * FIX:
 * On TinyMCE init, find and remove any <br> tags that immediately
 * follow a TinyMCE bookmark span before they render visually.
 *
 * SCOPE: Backend editor only. No effect on frontend display.
 */
add_filter( 'tiny_mce_before_init', 'avada_chrome_tinymce_fix' );

function avada_chrome_tinymce_fix( $init ) {
    $init['setup'] = "function(ed) {
        ed.on('init', function() {
            var body = ed.getBody();
            var brs = body.querySelectorAll('span[data-mce-type=\"bookmark\"] + br');
            brs.forEach(function(br) {
                br.parentNode.removeChild(br);
            });
        });
    }";
    return $init;
}
