<?php

// Global configuration file.
// This is just a sample file. Copy this over to config.php and edit.

// Here is the essential configuration. You only need to modify this
// to get it working.

// This is the subversion checkout directory. include trailing slash.
define('IA_ROOT_DIR', '/infoarena/');

// Database host. Probably localhost.
define('IA_DB_HOST', 'db');

// Database name.
define('IA_DB_NAME', 'infoarena');

// Database user.
define('IA_DB_USER', 'root');

// Database password
define('IA_DB_PASS', '');

// Keep database connection alive when lost
define('IA_DB_KEEP_ALIVE', false);

// Web host. This is probably localhost. no trailing slash here
define('IA_URL_HOST', 'http://localhost:8080');
define('IA_URL_HTTPS_HOST', 'http://localhost:8080');

// URL prefix, without the IA_URL_HOST part
// (only the part relative to the web server).
// Slashes at both ends.
define('IA_URL_PREFIX', '/');

// Define the place the avatars are being stored
define('IA_AVATAR_FOLDER', '/infoarena/www/static/images/avatar/');


// Congratulations! You're done with the essential configuration.
// --------------------------------------------------------------
// There are some more settings to adjust but they are optional.

// Enable this when working on your own local copy. It gives you a few
// debugging & profiling tools. Additionally, it disables Google Analytics
// or other external resources.
define('IA_DEVELOPMENT_MODE', true);

// Determine if script is runing in an HTTP environment. Otherwise it is
// probably running in CLI mode. Don't change it.
// FIXME: move to common/common.php
define('IA_HTTP_ENV', isset($_SERVER['REQUEST_URI']));

// SMF database prefix (required!)
define('IA_SMF_DB_PREFIX', 'ia_smf_');

// "The" url to infoarena home page.
define('IA_URL', IA_URL_HOST . IA_URL_PREFIX);

// URL to SMF. No trailing slash
// Example: http://localhost/infoarena_smf
define('IA_SMF_URL', IA_URL . 'forum');

// Enable support for https connections. If enabled, secure connections are
// enforced for login and register pages.
define('IA_HTTPS_ENABLED', !IA_DEVELOPMENT_MODE);

// cookie domain
// leave null when working on localhost
define('IA_COOKIE_DOMAIN', null);

// infoarena session lifetime
// defaults to 5days
define('IA_SESSION_LIFETIME_SECONDS', 5 * 24 * 3600);

// Fatal error mask.
// These are the errors the scripts halts on.
// E_ALL & ~ (E_USER_NOTICE | E_USER_WARNING)
// FIXME: Why isn't this configurable in php.ini?
define('IA_PHP_FATAL_ERROR_MASK', 0x19FF);

// If this is true then the site is in debug.
// NOTE: set this to false when public.
define('IA_DEBUG_MODE', true);

// This aren't really settings.
// FIXME: Couldn't find a better place to put this in.
//  - NOTE: it can't reside in common/db/*.php files since SMF
//    cannot link db api.
//  - NOTE: it can't reside in www/* since judge needs it too
define('IA_TASK_TEXTBLOCK_PREFIX', 'problema/');
define('IA_USER_TEXTBLOCK_PREFIX', 'utilizator/');
define('IA_NEWSLETTER_TEXTBLOCK_PREFIX', 'newsletter/');
// FIXME: Do we really need this?
define('IA_ROUND_TEXTBLOCK_PREFIX', 'runda/');

// Secret code
// Random string used as salt in various places where hashing is needed.
// For security reasons, this should be changed when uploading to a production
// website.
define('IA_SECRET', 'developersetup');

// Mail setup
define('IA_MAIL_SENDER_NO_REPLY', 'infoarena <no-reply@infoarena.ro>');

// Enable this only if you have a SMTP server around
define('IA_SMTP_ENABLED', false);

if (IA_SMTP_ENABLED) {
    // only if SMTP is enabled, you can configure these
    define('IA_SMTP_HOST', 'localhost');
    define('IA_SMTP_PORT', '25');
}

// Disable mysql_unbuffered_query
define('IA_DB_MYSQL_UNBUFFERED_QUERY', false);

// Enable the DB cache by default.
// If it's broken then you have a bug.
// Disabling it might still be useful for mysql tweaking.
define('IA_ENABLE_DB_CACHE', true);

// Enabled the create_function_cached cached.
// If false then create_function_cached_cached is the same
// as create_function_cached
define('IA_ENABLE_CREATE_FUNCTION_CACHE', true);


// Disable memory cache by default because it requires additional stuff
define('IA_MEM_CACHE_METHOD', 'none');

// Default TTL for cache items.
define('IA_MEM_CACHE_EXPIRATION', 3600);

// TTL for tag caches.
define('IA_MEM_CACHE_TAGS_EXPIRATION', 3600);

// Maximum tags to use in cache
define('IA_MAX_TAGS_TO_CACHE', 2);

if (IA_MEM_CACHE_METHOD === 'memcached') {
    define('IA_MEMCACHED_HOST', '127.0.0.1');
    define('IA_MEMCACHED_PORT', 11211);

    // Round TTL.
    define('IA_MEM_CACHE_ROUND_EXPIRATION', 3600);

    // Task TTL.
    define('IA_MEM_CACHE_TASK_EXPIRATION', 3600);
} else {
    // Smaller TTLs because evaluator doesn't have access to cache to
    // invalidate old data on updates.

    // Round TTL.
    define('IA_MEM_CACHE_ROUND_EXPIRATION', 10);

    // Task TTL.
    define('IA_MEM_CACHE_TASK_EXPIRATION', 10);
}

// Logging options. Anything else in normal operation is a bug.
// Filling error_log on a production machine sucks.
define('IA_ERROR_REPORTING', E_ALL & ~E_DEPRECATED & ~E_USER_WARNING & ~E_USER_NOTICE);

// If true then log all security checks.
// Warning: tons of output.
define('IA_LOG_SECURITY', false);

// If true then log disk cache hits/misses
define('IA_LOG_DISK_CACHE', false);

// If true then log mem cache hits/misses
define('IA_LOG_MEM_CACHE', false);

// Log each and every SQL query. Not for the faint of heart.
define('IA_LOG_SQL_QUERY', false);

// Try to EXPLAIN every select query, useful when optimizing.
define('IA_LOG_SQL_QUERY_EXPLAIN', false);

// ------------------------------------------------------------------------
// Token constants. Certain operations cost tokens to perform. If there are
// not enough tokens, the identifier (IP-based) will need to solve a captcha.

// Maximum number of tokens an identifier can have.
define('IA_TOKENS_MAX', 60);

// Tokens regenerate over time, one token every this many seconds.
define('IA_TOKENS_REGEN', 300);

// Tokens earned by solving a captcha.
define('IA_TOKENS_CAPTCHA', 5);

// Token cost of operations. Set to 0 to effectively disable captchas.
define('IA_TOKENS_REGISTER', 61);
define('IA_TOKENS_LOGIN', 20);

// ------------------------------------------------------------------------

// CAPTCHA Keys
define('IA_CAPTCHA_PUBLIC_KEY', '6LesuwQAAAAAAPHgdh9Hem1KJfvd5Ng1yRoIweio');
define('IA_CAPTCHA_PRIVATE_KEY', '6LesuwQAAAAAAF3FUPWFGQD1xPITFagjqWUO9Urs');

// Facebook App-Id
define('IA_FACEBOOK_APP_ID', '159779000715246');

// Twitter Account
define('IA_TWITTER_ACCOUNT', 'infoarena.ro');

// AWS Credentials
define('IA_AWS_FOR_GRADER_FILES', false);
define('AWS_RO_ACCESS_KEY', '');
define('AWS_RO_SECRET_KEY', '');

define('AWS_RW_ACCESS_KEY', '');
define('AWS_RW_SECRET_KEY', '');

// Security setup for certain kinds of textblock actions
define('SEC_TEXTBLOCK_SIMPLE_VIEW_PRIVATE', ['admin']);
define('SEC_TEXTBLOCK_SIMPLE_REV_EDIT_PUBLIC', ['admin', 'helper', 'normal']);
define('SEC_TEXTBLOCK_SIMPLE_REV_EDIT_OTHER', ['admin']);

define('GOOGLE_ANALYTICS_TRACKING_ID', 'UA-113289-8');
define('GOOGLE_SEARCH', true);
// token obtained from Google CSE (ignored if GOOGLE_SEARCH is false)
define('GOOGLE_CSE_TOKEN', '');

// Monitor autorefresh options
define('MONITOR_AUTOREFRESH', true);
define('MONITOR_AUTOREFRESH_INTERVAL', 5000); // milliseconds

// Secure deletion: if true, prevent deleting tasks with attachments. Instead,
// require the user to explicitly delete all attachments first.
define('SECURE_DELETION', false);

// Show or hide newsletter-related checkboxes
define('NEWSLETTER', true);

// Theme selection.
// You can change it to 'custom/' to access the custom folder for css and images.
// Leave '' for default theme
define('CUSTOM_THEME', 'custom/');

// Text of the homepage link in the top navigation menu
define('NAV_HOMEPAGE_TEXT', 'info<em>arena</em>');

define('TOPNAV_ELEMENTS', [
    'blog' => true,
    'forum' => true,
    'calendar' => true,
    'messages' => true,
]);

define('SIDEBAR_ELEMENTS', [
    'about' => true,
    'ad' => true,
    'archives' => true,
    'articles' => true,
    'calendar' => true,
    'docs' => true,
    'downloads' => true,
    'links' => true,
    'task-search' => false,
]);

// True: use the built-in mysql_* functions.
// False: use the wrapper library.
define('MYSQL_NATIVE', true);

define('ENABLED_COMPILERS', array(
    'c-32' => 'GNU C - 32bit',
    'cpp-32' => 'GNU C++ - 32bit',
    'c-64' => 'GNU C - 64bit',
    'cpp-64' => 'GNU C++ - 64bit',
    'fpc' => 'FreePascal',
    'java' => 'Java',
    'rs' => 'Rust',
    'py' => 'Python3 (FOARTE EXPERIMENTAL!)',
));

// Credits
define('COPYRIGHT_FIRST_YEAR', 2004);
define('SITE_NAME', 'infoarena');
define('COPYRIGHT_OWNER', 'Asociatia infoarena');
// If empty, the copyright owner won't have a hyperlink in the footer.
define('COPYRIGHT_OWNER_PAGE', 'Asociatia-infoarena');
define('ABOUT_PAGE', 'despre-infoarena');
