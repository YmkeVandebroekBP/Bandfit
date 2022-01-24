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
define( 'DB_NAME', 'local' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', 'root' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'UqcrePhMlwHHxQtnoqJZ7zl7tbAxDgnDO6n55n3P8rah+3X6d86D/04Zho1FACNM2TxYxtxFKjJgD9OaOLT1Tg==');
define('SECURE_AUTH_KEY',  'eglNR9EhngzvR+wKorYX2reWH0lm9trHGkksf1fGHksizKJjVwA+1g2bWixPk4n/LxT/gDbmGRWQ1yqgSduhMg==');
define('LOGGED_IN_KEY',    'jIU4gv/HnbSueRXpTu9d7rPkRt4LdrUIbNpkv9htDGEmXMOeF73KZQnv7nm+Em9VJu5OvAkXXlSxXg+d0AXloA==');
define('NONCE_KEY',        'iRa386fMGqySo2zuHyMSXl6MEsvSDEdUR523YnAKEDtt6CoSVmGnsbXAgtQxitgrjeOWISov6C71sQNJnui/IA==');
define('AUTH_SALT',        'e87E/Uu/upot9z9kdpc054lTjcWrIk7F9CZgHmMe9VwkkiEjO8Jjo54NNUmopiOBsl0nV4RQJyQXpsDmRkY+xA==');
define('SECURE_AUTH_SALT', 'W+ERPixdTb8rHxV6EbfU3snFizICyhwPBu0ngm9IhcGYui/7+bVS3MisGRcpx517A4FaiCgzYU1uMvCBcS897g==');
define('LOGGED_IN_SALT',   '6aCyFfRKHgWgClu6uRVLGp+1Hd4te0XgtFJ5Bp6xs9cxAcKHBbGoEdgAkiHfXtFLsMqsPPIAY9jGRK4xA1wtOg==');
define('NONCE_SALT',       'XTGDgXgD1WdIsY7FHG9gKCGw3sUjGkygwexDLGXC4QJuO3+U+uiOY888rn+N/hIJ4zwjk4L8d/2g1wYlA6fHtw==');

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';




/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';

define('WP_CACHE', false);