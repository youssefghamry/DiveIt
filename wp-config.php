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
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'DiveIt' );

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
define( 'AUTH_KEY',         'z/<?_KF]8n-a/6LM_SAS_0:-+dNST(!rYkcs+JGcy{zb_heSGX`h7* J@U81z4t#' );
define( 'SECURE_AUTH_KEY',  '`eS#2u!0v&+]TMjN*+9@5Lm~w?mNfPDmJ?6(1lnbdk%/+|kRKMF_Z|dh}E_WQ0V3' );
define( 'LOGGED_IN_KEY',    '7%bvE9!ZLjP~(Q `N31VTiJIso%kK0KjcBc-e+MisM0Mf0MH*_$ 0ShgKNR6<((T' );
define( 'NONCE_KEY',        ':nFYk[4F}qCwLU^1O<dqjf=g?8;5}V)P#9c8SebL;L65ed:j(S;t]lCtEV{=>F5)' );
define( 'AUTH_SALT',        'bJ-Cklc&~6W?2f0l$!Uf!65xJI38=eTUfDJXo/PLDLK90E/4m!@AVecM,|u@YazY' );
define( 'SECURE_AUTH_SALT', 'V<X|W$7e$6[5K1:nr*E)LnfHM:skFsgN:YG$A1>0#lVvdb-9BbJ{( YIB6FIoZ+{' );
define( 'LOGGED_IN_SALT',   'hJG^,R[/uJHVyO90%m0/zoI}^XPy9^6W8f0QEK~s]M7>EujgMBVKMs]-zRm(V[>l' );
define( 'NONCE_SALT',       ']8;BI1cs)D-0Zj@,69-eNj^B@O5hq@|c;B92+-7(1B^q.8~dwe,XOjpV$+~*HkwS' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_DiveIt';

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
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
