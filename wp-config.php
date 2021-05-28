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
define( 'DB_NAME', 'hungnd1' );

/** MySQL database username */
define( 'DB_USER', 'hungnd1' );

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
define( 'AUTH_KEY',         'q{Tu63V]/9`DL-z3>v?0lX%$Vu;rQ7EB=iEV.Lyt%tkMTwxJyJI6Bt_ig=s.|B[4' );
define( 'SECURE_AUTH_KEY',  '#APd3,U|DKV!}UK1!Qp4]B7XH3z`h,4:q6mc0s(&L^D3VKoA(;%2-%Zfx7cBh.aK' );
define( 'LOGGED_IN_KEY',    '5Pw+%#rC^tXqeUTH-?L(D]~qKJ-o;_|SF 2UG=0Q:0pA2Enh$!;&^}(&T!*t`Y{e' );
define( 'NONCE_KEY',        'u_u)*0://?Ir%Q<S.Z;JuVf/[LJtjWn*j4}!j<JKE+&/P/hn8q2hGBmf]-t0;zN^' );
define( 'AUTH_SALT',        '(0!$/2)}/g8ta_j;aJt}2$iD}gZ>%|_=7FtU0_}>u`UPb~ZfF.9rM)1U6NDZ~!Lf' );
define( 'SECURE_AUTH_SALT', 'jiIKfPq:-<?)w.?w0[iOyGb<sihjLE[u>~vP=Pm2[Fp.?)]HKF>+At)?)v/nw#i$' );
define( 'LOGGED_IN_SALT',   '@A!d{dzE_wbL]M(WMxk35uT9|f]|I>35_H,9-8W6H*+UR=MCzpwrnnlKZzx(pRw%' );
define( 'NONCE_SALT',       '(0CiM#+UeT-1.LaQ|V,fdFo=m3pZ{aN:z#%sz}T#AZbK,{-w0&$aD6v an30=8j{' );

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
