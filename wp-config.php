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
// mysql://
// b288ada66ff533

// :
// 7b7d0844
// @eu-cdbr-west-03.cleardb.net/
// heroku_cdc0d877ac918a0?reconnect=true
if(strstr($_SERVER['SERVER_NAME'], 'localhost')){
	define( 'DB_NAME', 'local' );
	define( 'DB_USER', 'root' );
	define( 'DB_PASSWORD', 'root' );
	define( 'DB_HOST', 'localhost' );
} else {
	define( 'DB_NAME', 'heroku_cdc0d877ac918a0' );
	define( 'DB_USER', 'b288ada66ff533' );
	define( 'DB_PASSWORD', '7b7d0844' );
	define( 'DB_HOST', 'eu-cdbr-west-03.cleardb.net/' );
}


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
define('AUTH_KEY',         'AzZG8LGnSjOXPcUEB9urvFAAMkee7H5Z5IdfbzfepLniqThccKRgPK654sieiSTHDdXIL/9E/+95XQkZLRCjDQ==');
define('SECURE_AUTH_KEY',  'wHXQVfSNsEnP1bfappkCb34TRXLvqnHOQjvEbG9QArDpQY+wO/1XIbTYDTZ28oc8eKXxlBsIxY9cBLX18KvxDg==');
define('LOGGED_IN_KEY',    'tNythiflDXta3ApYevgg/rPthQaZ+Z01sCKHcr+/t+dZEaqzcUieNHgFexD8TwYNrV7ugqQCDrn1bmjryQWkWQ==');
define('NONCE_KEY',        'dmCF179wWUm+iLGAN/UoEswr+8W+wZrbfXCMIGDlEhVSYYiHMW8RDknGIQanFNbunUpv99CJhRSImx8ibW9jHA==');
define('AUTH_SALT',        '+rkk4onz3jtl9CbXiRCWlvqb4SJVzYm8Ov/3pNNwQRljuKmYmzIAsjwNr2qWbqfpTsE07vCc0J5/LUFlctEjYQ==');
define('SECURE_AUTH_SALT', 'RZ5Aie2T98DkPy1f+IaiTj2VVhIVadrl3dOTR2wpJg3uI/EkSl3E537ykrf93I2TrV8O5x46cRI4vlC7ztPivQ==');
define('LOGGED_IN_SALT',   'RLNcaq5wORXDBOgXhpUW26C4GlOi9zVZRYKvnwxQq5tgLEk9EyYYKITPJhlGRud+7HvVI6pwaYKa+2vAno9fuw==');
define('NONCE_SALT',       '02KbmYgcHgMRmbKb/AzAuC80PZ4PKxKDhnE3Z4hyy5CzCet9j3LZfQicUIgvHM6FV7ehZ78bImLN+cJbIdCgBA==');

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
