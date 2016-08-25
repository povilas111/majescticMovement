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
define('DB_NAME', 'koju_protezai');

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
define('AUTH_KEY',         'P/jqQPEu{NM2Db/j.-g?7+_5Z!re9h%}g@}L!:` -l[{J5Y}Bmp>gVyrc9R91eqY');
define('SECURE_AUTH_KEY',  'dqweV&i&g8+|.I,YVx9k{3%S/45G }|1(~Ps5Qr5.K3P{t[U2.?xn 3&F$|6O;7l');
define('LOGGED_IN_KEY',    'B+>r<SQxvhmCl69$;-WLrn09wog|LU^1+U*0 rN94h#2dVgk$ljNgj7-=jgskR)k');
define('NONCE_KEY',        'J:eaP8qT8*&Ef9teBG$<5*Kcc#H4zl,70+ 8gn4k. LNo6&LYkN[N#x/dR6|)[]n');
define('AUTH_SALT',        '(,P-n;[M49t:=~0Q7Drq}/~=BhunDy$_`j;5W3HF` OXbx3LSKApv9abvRphmbk9');
define('SECURE_AUTH_SALT', '7EJeM&j%)CGDH<.% -+Bud^k(bvH%z4|-9SYwEaV)-:d(8aN2Uo+o_dP#DjhM@~-');
define('LOGGED_IN_SALT',   'JKcl+%0IshYK0,-GDEH3~7#9}8lS4 [pTxVdO$_Sa#|dh/;+D#kf+G$@jjy]Zyn@');
define('NONCE_SALT',       '*_/S)Sj%p4(Ng+Sr?7}HIu7PHIjTHH8o+O(a@+3vRegmhEMb.(P|j]WH1[[`)e[h');

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
