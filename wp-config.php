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
define( 'DB_NAME', 'Kuma' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

if ( !defined('WP_CLI') ) {
    define( 'WP_SITEURL', $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] );
    define( 'WP_HOME',    $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] );
}



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
define( 'AUTH_KEY',         'xQqQby9CkbcF50s40LZnN4pa9Jwspouxn7nr3SZAsV6CXdngvdbYRMmCsaY0F7RB' );
define( 'SECURE_AUTH_KEY',  'bKQKIJReEksYnxYkG1hLQidDwG2dwmZhV1zQS2UcYGvIim9FiiFG0ElJuPjGcmMN' );
define( 'LOGGED_IN_KEY',    'yaa3F62XvzcUJYo10zAOAGHpoouLywttKyUB9I7HtdfGTCZZCIk8ff9EjB56x8dl' );
define( 'NONCE_KEY',        'ixB0ochcZGE1l3Ba32xj6ygrgKkf27XoxWIy0FBFZ3evu4nKdlKghdbP5zgY8yiq' );
define( 'AUTH_SALT',        'LsXEwtXyZTyJ28JHRPvugyxMES9wpSsLBWGSBamyvDxbkBSrmjl87U3PCDTLwuTQ' );
define( 'SECURE_AUTH_SALT', 'ov2uE1RXgnrryi1mWEfvaWJoRGQH5EhMKnEL3n6222rIfZKIcxbmtqkApSCum3qp' );
define( 'LOGGED_IN_SALT',   'aINGMLYpO0h9Wzs0hvKmOGThTatLZrrpWeEergM8xcW8gc1BJ1gYqK58pgqaDcT8' );
define( 'NONCE_SALT',       'nxlRuASO77C07UbFV41pvEh0hz2Wg5WbVTvVojbT7oKv77wannqe90rBRIVUvtLD' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
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
