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
define('DB_NAME', 'ass_wp');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

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
define('AUTH_KEY',         'pz:uUF.tM.x/gP6$[^[t,K/y?>++76#(QBgZHY+HBhM!Wr,~!?@|0d=24zL|J&ng');
define('SECURE_AUTH_KEY',  'LF< h+`|8|`(x9+4#W`&5a{m(GWeLpK87^2}M%-lz$LB. ZWbp0JVB<]k-x9@4m1');
define('LOGGED_IN_KEY',    'Ja}5O3a-6}Tf4?w%!7u;Y`N)0_z$7t}dw 0`%2lDoAyn)EhVU:g`3N;l+|KOu>aI');
define('NONCE_KEY',        '8AHfU(K.14c1,?dRc:S@rL.=5-yzeJ0>>b~~@2< @0g2ep->Hz@]|5H%oDh-9t%6');
define('AUTH_SALT',        'Fmb%:m%(*BS/{^>!I3m3HNvV~J&;Qs)2S]bNvj;SP)OZqUsm8-F}`%WVlQ,}:*cs');
define('SECURE_AUTH_SALT', 'cT}_w87%#eg{g5.w-9GrzfHHs[vEO$TQIq4?L~mH`DVZ(e I_Rp+#dd!HL>-QA5C');
define('LOGGED_IN_SALT',   '<3!s`fEYzH;0ow7>7:z|K|4|5o(#tsn,M,S}Ap.c5V<ERazjDu!v)VurE+WgdSbM');
define('NONCE_SALT',       '(-C1G-ie>K`[_!)RlF*CxYEp$=,[K$nA9db_IPYGDZRuQ_&!l#PW/db-nJ&D:Ld<');

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
