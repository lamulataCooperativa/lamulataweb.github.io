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
define('DB_NAME', 'u349530412_exuzy');

/** MySQL database username */
define('DB_USER', 'u349530412_azyba');

/** MySQL database password */
define('DB_PASSWORD', 'aWeteByByQ');

/** MySQL hostname */
define('DB_HOST', 'mysql');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'hxNVBS2l1b1XJvZGGhzRNBZsGVvEd9WujlItbkiV0IoQwDufqhK9wg1ky42Y6cqj');
define('SECURE_AUTH_KEY',  'wlQk0taB6wE6TqxAmNwcDTiFhHTJ6yCrs1o1mQqR9WQSTlw3je5DxemQRYuzzMRc');
define('LOGGED_IN_KEY',    'RlSTmD0u8ZEduDdSH8V8gPjDqBa29svinWvS9RqdT4ryOC0iN4loisxdjPUmEN8R');
define('NONCE_KEY',        'EvgKFTpbVGpRX6MabKsKWjslB5IkBnPWf6MCZNNdUwvv3GUDaMH5zZYwgODSl5yp');
define('AUTH_SALT',        'wYK0RSeEUUwLnAKWaSHfBbMu5IMKU3ephYRx4fvlQZjCOW6EPgDw7ALF7wH2Vi15');
define('SECURE_AUTH_SALT', 'gKlafCFwEynFjHSWEzUnh9xAkUdKHp9noyDMf1xMLvBKL2jRjc4wUzu6enRwdeBd');
define('LOGGED_IN_SALT',   'Md7O10II9Vg4w6mo54NabhUTe9YvUGh6tavenkSmw2W3EzB2jlLr4P1WLlxEq7gO');
define('NONCE_SALT',       'dnap3lKvxmVCkn3t7OUXrBDTYfCEqCvA0vkBYBXrc6xlUytzZIfM6avVpmYwKdY1');

/**
 * Other customizations.
 */
define('FS_METHOD','direct');define('FS_CHMOD_DIR',0755);define('FS_CHMOD_FILE',0644);
define('WP_TEMP_DIR',dirname(__FILE__).'/wp-content/uploads');

/**
 * Turn off automatic updates since these are managed upstream.
 */
define('AUTOMATIC_UPDATER_DISABLED', true);


/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'oyqx_';

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
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
