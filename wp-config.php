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
define( 'DB_NAME', 'Financity' );

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
define( 'AUTH_KEY',         '2~[d9##~jQoL l-3)SllP?$Es,}KA@(:sEO?g*,8m^Hu(~>KF7/*voy69F,d%0$R' );
define( 'SECURE_AUTH_KEY',  'D2)^&=z%%.Y_}LK*)Nl5)axi{V!S!K)K+dJE]raUg4.d$<d>Yz53Vi^M4g>e*r6R' );
define( 'LOGGED_IN_KEY',    's#| K@kAJE0;Zg`ePN|)sMexbdt*vzZ7n,kAC8|r { F/?K#c1ww @$@-.Hds)Y@' );
define( 'NONCE_KEY',        'ujX=Az`t(6-~/pe0R%qe|ylF[m1.A1Ec}oTBwn,xY[AWD<fBP ueC{D3rSVP6QCZ' );
define( 'AUTH_SALT',        'r)Y{SB;9gO~-h^JPE8,9b?`Tin=s~7;a #IIa?J>8!QI/*34A)8EfR;?}}ZwKa=k' );
define( 'SECURE_AUTH_SALT', 'C/gs{.+pzfaP6V/~(shdA: L|+G/qD9%`*lLEIw_7w~BHo<ID!R>5YvkeEBhlD-F' );
define( 'LOGGED_IN_SALT',   ',/7eshX2<^=vFlD-q)`q6m.v=~$!Um?A{QKk #8^htV>~J,WXY(&;W6}Y>UFRM>*' );
define( 'NONCE_SALT',       'u! 070K%Oo_[h2o+OU6[Li;hB2ev8V+4gY_7,^r6ZVnEDzmulx[ehfSFzH)r4CgF' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_Financity';

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
