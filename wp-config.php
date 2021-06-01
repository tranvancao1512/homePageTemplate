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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'project1' );

/** MySQL database username */
define( 'DB_USER', 'project1' );

/** MySQL database password */
define( 'DB_PASSWORD', '123' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '{6I<PMjIot3rB:=<lq/0-0V$7IxJ/SD},GWCXIAjJYK^7[$3u=?P0c_&vZ2}q@w0' );
define( 'SECURE_AUTH_KEY',  'm9#>3Qg }PKunD*lK.{A?9LDO4PrxVp~*,#:Q/I/Y{W+{+qCEQ*cv:WdG|lS>`<S' );
define( 'LOGGED_IN_KEY',    '+z@}FC^; !?/4F~&0N~)r$@*zbgMFrZ3,j,u1Vv^9IQ.,qdxpcjtgdD:{5qq# RR' );
define( 'NONCE_KEY',        'U40;U/EWtwN2){mL[Ar>Nu9]tOzp`ieRTPqZ&{U)sP:/=NLQeIfz*,%>E7w+-D5(' );
define( 'AUTH_SALT',        't*rE`h)V!}?0KR2SKM`09LB(KwHsv`S1^ZA$ez}hu/V-/Y@w0^x[Go(tmLMFx~d0' );
define( 'SECURE_AUTH_SALT', 'VC&fekQ*$H#(:@F@L )Q}N0GXWmlZcppFB ep#=SD{~/PCdWl^+W:rR>,%fvhj!r' );
define( 'LOGGED_IN_SALT',   'nWDkOVbs%uk%w{29`Uq9*PqA&H:~% ^=g50YQ?a,xg9J,]&Rx:q7}-hDN1YF.qwk' );
define( 'NONCE_SALT',       'Mdwp3Fsk}/L#`$eCx7fGTUd9=m1W]lLhAV|NsP!QBfCPI {SRfW  /;7!>({,rN]' );

/**#@-*/

/**
 * WordPress Database Table prefix.
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
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
