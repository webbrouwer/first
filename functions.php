<?php
// Start Session
session_start();

/**
 * Escapes HTML for output
 *
 */

 function escape($html) {
    return htmlspecialchars($html, ENT_QUOTES | ENT_SUBSTITUTE, "UTF-8");
 }

/**
 * Check if user is logged in
 *
 */
 function user_logged_in() {
     if(!empty($_SESSION['id'])) {
        return true;
     } else {
         false;
     }
 }

 