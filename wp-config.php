<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('WP_CACHE', false); //Added by WP-Cache Manager
define( 'WPCACHEHOME', '' ); //Added by WP-Cache Manager
define('DB_NAME', 'endovelo');

/** MySQL database username */
define('DB_USER', 'endovelo');

/** MySQL database password */
define('DB_PASSWORD', 'endovelo');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '9x?iAo+<Khv^0L6QmaZDZeM;RdR!u8j2{QA}g|-tjPc]OAu4uJt_Kn-a_rL+w<8c');
define('SECURE_AUTH_KEY',  'd4zr[[Ukny/YR3M;1:hq^=#w]N2|Typ7<9Cmj%E^-(|bt1]mkiq:_~OZl6O28B<]');
define('LOGGED_IN_KEY',    'eP,PKhjQ3F0)sg{H8AHXAo4A0Gwr!d8[c7`9l]RnfYg 6+|d0!hpxo7/WD%g^ KI');
define('NONCE_KEY',        'VzrL2:E:tq?p(b-;QGoUirDC@H}D>O:D$?Qh>5++>1hzV-qy}4+18_1*dquT*GuX');
define('AUTH_SALT',        'gSJ*|`VfOyd{U8?<p)vF46:v-IFZaw/hL/5GRn9|BoiR>?J)Hgc`Jou0xX4N|-v&');
define('SECURE_AUTH_SALT', 'EPv6X~]OV;={~NF_No{QY>2_~RUiWB,_Tl3btXPg|$UjM4*8%ji|HaA9*1$[h~-P');
define('LOGGED_IN_SALT',   'a~`b2:XLB0Dg1 JL;^0O~G{-_oD%,9;pf%|]lMRbXf&_v~6:a}iP3:N#7pu%:b=U');
define('NONCE_SALT',       'Y?JW&`|^-q+#?@fktlUnJ-M<R>l;!@#22fwh4olB0($!VDd@yKo]fqw4]-C7Ywmb');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
