<?php
// @codingStandardsIgnoreFile

$settings['trusted_host_patterns'] = [
  '^'.getenv('LANDO_APP_NAME').'\.lndo\.site$',
  '^fe\.'.getenv('LANDO_APP_NAME').'\.lndo\.site$'
];


/** This will ensure these are only loaded on Lando */
if (getenv('LANDO_INFO')) {
  /**  Parse the LANDO INFO  */
  $lando_info = json_decode(getenv('LANDO_INFO'));

  /** Get the database config */
  $database_config = $lando_info->database;

  $databases['default']['default'] = array (
    'database' => $database_config->creds->database,
    'username' => $database_config->creds->user,
    'password' => $database_config->creds->password,
    'prefix' => '',
    'host' => $database_config->internal_connection->host,
    'port' => $database_config->internal_connection->port,
    'namespace' => 'Drupal\\Core\\Database\\Driver\\mysql',
    'driver' => 'mysql',
  );
}

$settings['file_scan_ignore_directories'] = [
  'node_modules',
  'bower_components',
];

$settings['entity_update_batch_size'] = 50;
$settings['entity_update_backup'] = TRUE;
$settings['config_sync_directory'] = '../config/sync';

$settings['container_yamls'][] = DRUPAL_ROOT . '/sites/development.services.yml';
$config['system.logging']['error_level'] = 'verbose';

/**
 * Manage Config split environments
 */
$config['config_split.config_split.dev_config']['status'] = TRUE;
$config['config_split.config_split.test_config']['status'] = FALSE;
$config['config_split.config_split.uat_config']['status'] = FALSE;
$config['config_split.config_split.prod_config']['status'] = FALSE;


/**
 * Disable CSS and JS aggregation.
 */
$config['system.performance']['css']['preprocess'] = FALSE;
$config['system.performance']['js']['preprocess'] = FALSE;

/**
 * Disable the render cache.
 */
$settings['cache']['bins']['render'] = 'cache.backend.null';

/**
 * Disable caching for migrations.
 */
$settings['cache']['bins']['discovery_migration'] = 'cache.backend.memory';

/**
 * Disable Internal Page Cache.
 */
$settings['cache']['bins']['page'] = 'cache.backend.null';

/**
 * Disable Dynamic Page Cache.
 */
$settings['cache']['bins']['dynamic_page_cache'] = 'cache.backend.null';

/**
 * Allow test modules and themes to be installed.
 */
$settings['extension_discovery_scan_tests'] = FALSE;

/**
 * Enable access to rebuild.php.
 */
$settings['rebuild_access'] = TRUE;

/**
 * Skip file system permissions hardening.
 */
$settings['skip_permissions_hardening'] = TRUE;

/**
 * Exclude modules from configuration synchronization.
 */
$settings['config_exclude_modules'] = ['devel', 'stage_file_proxy'];
