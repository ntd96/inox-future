<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'inoxfuture' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'tI!ngE]xOx`.~N)y]A~$$RB$`a8CbML]:-$Xz.+Jo#@k^!P$(/=~t@XG<deMwT-.' );
define( 'SECURE_AUTH_KEY',  'I/}Pth8tvcsYyB6tPl{=(EeY9fB)5Yy>5r%52nJb< aliUh!ZR,=Qi`hsED}Hy//' );
define( 'LOGGED_IN_KEY',    '&XBX!0T>E@Zw!=5*{^rfit~H|x}:$ B1!sKOBRlgzJhw>MZN@:G|L1;)>mH^1) %' );
define( 'NONCE_KEY',        'P!Ax{U{(h.d<Ik)4:o}njTKbC8oJTwqwV_sFkV?H}wg/Y<X{EE/S(Ejy3%$?2.5S' );
define( 'AUTH_SALT',        '0q3R%4B9N9zeh^$~cb0dizkY9+Z%$s}jSdqg=w5|n%X34~oQ%&rKG_Fwk1<x2vf6' );
define( 'SECURE_AUTH_SALT', 'obx|~<51BUhsN)$fWU6noy=p=<8kj2txT<R+kbctkiR[+2ZleyDg]KGcucU<pE3+' );
define( 'LOGGED_IN_SALT',   'V2LK<$G 0uhUuuXQ+7#!JlN<Nl,;!L,8l/8{1UM-Uv6|?W|}:]7$+%w K<}thoj)' );
define( 'NONCE_SALT',       'f!umFa{=3xikX_8pReD >*dXX>f$+Z;~/vjE@vr8986!-Rm2ql!2i*jaTv__.a3h' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 *
 * At the installation time, database tables are created with the specified prefix.
 * Changing this value after WordPress is installed will make your site think
 * it has not been installed.
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/#table-prefix
 */
$table_prefix = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
