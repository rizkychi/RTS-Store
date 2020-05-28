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
define( 'DB_NAME', 'wordpress' );

/** MySQL database username */
define( 'DB_USER', 'rizkychi' );

/** MySQL database password */
define( 'DB_PASSWORD', 'gampang123' );

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
define( 'AUTH_KEY',         'W0(*z4:b];D~9CnpDuz:c]}Qv$~mPBJgHy*&qTq9#$y-~*..v43Cv; X}zeM|6vJ' );
define( 'SECURE_AUTH_KEY',  'rl(J=Zg;Q1%HYvopvXqJmu)yB%eRL+MzcveU:qDb.VSyK^hIbor E9ATuDyi)9V)' );
define( 'LOGGED_IN_KEY',    '5y2NPQz8+/9YEOw=P*es |D~#Qzb}Md$F4:jgSVL#Ht6`CoDkzX{T`Q.n2S7-gCf' );
define( 'NONCE_KEY',        'P73EE#g0TyR;VmvKWr}1Gc4T0A(L7bBItS:e9QP^D98;[s>b_]<UxI}gV@El_tv!' );
define( 'AUTH_SALT',        'G`!vrlFOlTo$(||D__[*l/9?|eiI?pBoIi5KJZW!YDiVTM0@dBw5^go11U$fjQ-_' );
define( 'SECURE_AUTH_SALT', '9)W}J||)us-)E[hPS&5,A:`E$J7RUb|;-nf]4[sJMz1 3Dw[{u^/7C)RFmepb}_}' );
define( 'LOGGED_IN_SALT',   'HTw+kN`+*h=XZrn+e>eE6=#M{C/X3jFRWZqLHroL/|9x_[Oxw<e030a.Y_*~OZTj' );
define( 'NONCE_SALT',       '*iJIOldwS}@;EK$ x#xxr<l:RhawQaw4YBnsvuu1a|rbt<IuR,[|%Pn+m*@?9a(i' );

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
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
@ini_set(‘upload_max_size’ , ‘256M’ );
