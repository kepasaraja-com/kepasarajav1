<?php
define( 'WP_CACHE', true );
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
define( 'DB_NAME', 'db_wordpress' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

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
define( 'AUTH_KEY',         '8m8E8)IWoOQL=T>w2^`0/+0y5z(bSyd=-a[vx#Tej4a;napBPQS@-9JUWB|R),%^' );
define( 'SECURE_AUTH_KEY',  '[kwt2!O~~ ab5U/7<JatBKI<rV1$!!7gY36{hmQ(4 lBK_,L@qt%HR]OBEE27[vr' );
define( 'LOGGED_IN_KEY',    '1=Y|l)O|wxaEMF1k=Uufb]l(98Gr!<;1D4<C{*b-.{KC,u4VkCuLfSc`ME$pS#^V' );
define( 'NONCE_KEY',        '*k;=ET_e:0ufDf;bzpXN3tm}g7}7^U-J uC=(b;_T]V(]{?3()8c!aXx^3{9qc0?' );
define( 'AUTH_SALT',        'i!jGDQt$+;wK/`^M`ecwF4G51:?A$!AA.g7Ci9$t1d3{+BVqhcAmm.ONUf^qV9ig' );
define( 'SECURE_AUTH_SALT', '}{&Ovv|AgazKU4b@ E?NFyFWL/(QfcXEB%:BB1/J,]8/e?RN6i<%adMwRNvn`{*~' );
define( 'LOGGED_IN_SALT',   'H-|y: FR&3W!Anui%>[wtw~@l(}6e9Jgh>XZfmMVFB~Y|Y8m#<8olp/[%Mlj,. A' );
define( 'NONCE_SALT',       '~1Z/G{~fcngMVG5hUQ|&u)dTBe-.LNPASz~-u`NW>+g:f+tl#!$WACalBCWB6@LC' );

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
