<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * Localized language
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
 if(strstr($_SERVER['SERVER_NAME'], 'fictional-university.local')) {
    /** The name of the database for WordPress */
define( 'DB_NAME', 'local' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'root' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );
} else {
    /** The name of the database for WordPress */
define( 'DB_NAME', 'if0_36339403_university_db' );

/** Database username */
define( 'DB_USER', 'if0_36339403' );

/** Database password */
define( 'DB_PASSWORD', 'Po7ubnJ6gc2AH' );

/** Database hostname */
define( 'DB_HOST', 'sql301.infinityfree.com' );
}


/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

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


/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';


/* Add any custom values between this line and the "stop editing" line. */



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
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
if ( ! defined( 'WP_DEBUG' ) ) {
	define( 'WP_DEBUG', false );
}



define('AUTH_KEY',         'vZTHNGTJEMUUpgLYOuOenrh4kuWEnON02L1QbXPA9lPwMgT87U/4pF3OztVavVVsXctXGg0ocK0TQEn4aKTLMA==');
define('SECURE_AUTH_KEY',  'Td9h0OdN82kZsdFSny3yjsffrmhES+IaH4Eo4KPxmVNbS9tisygSbSJbMzr5y34USW+TE6+ZUOfirYx0RNDcIA==');
define('LOGGED_IN_KEY',    'N4nerrbXOGZrwzdmC+Mv1wvvcVyIvZ+b/DZMqCzjZC8B02975oTLlqSqURxNZGNQRDaHY4+ojhv4TVQGeBMLCQ==');
define('NONCE_KEY',        '6xp8lhWLZna2eVhFk/cdSVaf1+/8CQpaxEkoxS8VJlLMcIqfbtZhC/k05V+tDMM5qgISnP5D8YGHpoS0nVL+lg==');
define('AUTH_SALT',        'X4eyB9Rhu9RA50RAbxU7FauWDrgaBEaSU9NQGYI9t5KqbiutcBNcinaYp0CPKRtBwBWu3f2IphhTr+cX5judJw==');
define('SECURE_AUTH_SALT', 'DIz4mzJHsTBcpCQhPaQTohebpYZbxy9qeXazcjCMHrZ0eiVI5uSDUhcWWGFVqo1y8px1SpGDkiFTJym6aTF7Vw==');
define('LOGGED_IN_SALT',   'eWoHsQ95AYvBRlEn98n9G7Z24Zjoaj3uH/lnrjQIxZN1eqj3LYpGVqdMqxn0q9UGK7BWt1P8RCG5ONkIZtd9kg==');
define('NONCE_SALT',       'Lyrmgdoy/R1DpvF7sUmomf9vXSKPZQ/KXP6CqXV7hBlsHDymOzfcG1o4L/bO91BCgUFOHhHs5kJtUBU0bj0mUw==');
define( 'WP_ENVIRONMENT_TYPE', 'local' );
define('GOOGLE_MAPS_API', 'AIzaSyC4ezRI0c1L26K6NqL7QNUxxF23IUy0hfI');

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}



/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
