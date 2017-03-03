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
define('DB_NAME', 'macsundb1');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root');

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
define('AUTH_KEY',         '3ex~DUEH9Dk{+OozD+b$2%zt*RlXOo#]PRVC69krzBHo+>PXLyeMv#?~+_cskX$j');
define('SECURE_AUTH_KEY',  ')}!v;.1+ozW[_)4G_u8$HEmTC.XYbk+f%rZf)s!X%d6ZA9Z.ef0au93n)S$n`5JO');
define('LOGGED_IN_KEY',    '{<ad|5z3|`C~C@~E9n3@`V?Q=.lG!:)>iiQt8P j4Up}m+_A[.Ay:3b&RTqU(sL(');
define('NONCE_KEY',        'OJ|nF-kKaQ|dRvjl|v=A0)LFJczREDlkq]^!%gXtH=H2gLF&7jEb8Q}tl0Xr>{Y@');
define('AUTH_SALT',        'lM@Q~AJrt`Y=liUW2=kp0JGbjL#f_^Z*mN752ZDtv,8I@O&s^U0`8H7{Y]nCt/N?');
define('SECURE_AUTH_SALT', 'd1X(SV0rZdoMeMk2[;.PsBqr:s,M{%#xNOHS)>*#[URuh7te#wu:!(WvXHP*Ac{E');
define('LOGGED_IN_SALT',   'Ed|N!(TeNpe^ d[TfJ;dOJ~y) Em-(P]jE}TKDZ(sw3%!&Z1TN,j<m!8Pq&dbg.W');
define('NONCE_SALT',       '_b-jlOLYv|MFn%:r8zv%0w:IU9`[<~DONtAs c7RmA-DN|RPVBxmA,X]B<$j%&t*');

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
