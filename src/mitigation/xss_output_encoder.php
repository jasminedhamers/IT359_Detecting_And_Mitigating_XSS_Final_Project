<?php
/**
 * Output Encoding for Rendered Data
 * * This function ensures that all user-supplied data is treated as plain text
 * by converting special HTML characters into their HTML entity equivalents.
 * This prevents the browser from interpreting the data as executable code.
 * * @param string $data The user data retrieved from a database or application.
 * @return string The encoded, safe string for HTML display.
 */
function encode_xss_output($data) {
    // Use the ENT_QUOTES flag to encode both double and single quotes.
    // Use UTF-8 encoding for safety.
    return htmlspecialchars($data, ENT_QUQUOTES | ENT_HTML5, 'UTF-8');
}

// Example Usage (for demonstration purposes):
// $comment_from_db = "Check out my link: <a href='malicious.com'>Click me!</a>";
// $safe_comment = encode_xss_output($comment_from_db);
// echo "Original: " . $comment_from_db . "\n";
// echo "Encoded: " . $safe_comment . "\n"; 
// // Output will be: Check out my link: &lt;a href=&#039;malicious.com&#039;&gt;Click me!&lt;/a&gt;
// // The browser will display the literal HTML tags, not execute them.

?>
