<?php

/*
 * Security headers
 */

// $csp_nonce = base64_encode(random_bytes(20));
// $csp_header = "Content-Security-Policy: default-src 'none'; style-src 'self' 'unsafe-inline'; script-src 'self' 'sha256-sv4jGGVCDUykONZVQdABKFT3hKgodDeF9539pQiKBKw=' 'sha256-/u+mbQULji9rn7iLtF3XVa6QZtm4jP9T1QPL3LvL1Ts=' 'sha256-G/lBpiGseA5auw2pA037Wt+EdWteXxYk4UaloG3BrDw='; img-src 'self' data:; font-src 'self'; connect-src 'self'; base-uri 'none'; form-action 'self'; frame-ancestors 'none';";

// c::set('csp-nonce', $csp_nonce);

// header($csp_header);
header('X-Frame-Options: DENY');
header('X-XSS-Protection: 1; mode=block');
header('X-Content-Type-Options: nosniff');
header('Strict-Transport-Security: max-age=63072000');
