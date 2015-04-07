<?php
// Nymph's configuration.

$nymph_config = include file_exists(dirname(dirname(__DIR__)).'/server/conf/defaults.php') ? dirname(dirname(__DIR__)).'/server/conf/defaults.php' : dirname(__DIR__).'/vendor/sciactive/nymph-server/conf/defaults.php';

// Check for Heroku postgres var.
if (getenv('DATABASE_URL')) {
	$dbopts = parse_url(getenv('DATABASE_URL'));
	$nymph_config->driver['value'] = 'PostgreSQL';
	$nymph_config->PostgreSQL->database['value'] = ltrim($dbopts["path"],'/');
	$nymph_config->PostgreSQL->host['value'] = $dbopts["host"];
	$nymph_config->PostgreSQL->port['value'] = $dbopts["port"];
	$nymph_config->PostgreSQL->user['value'] = $dbopts["user"];
	$nymph_config->PostgreSQL->password['value'] = $dbopts["pass"];
} else {
	if (true) {
		$nymph_config->MySQL->host['value'] = '127.0.0.1';
		$nymph_config->MySQL->database['value'] = 'nymph_example';
		$nymph_config->MySQL->user['value'] = 'nymph_example';
		$nymph_config->MySQL->password['value'] = 'omgomg';
	} else {
		$nymph_config->driver['value'] = 'PostgreSQL';
		$nymph_config->PostgreSQL->host['value'] = '127.0.0.1';
		$nymph_config->PostgreSQL->database['value'] = 'nymph_example';
		$nymph_config->PostgreSQL->user['value'] = 'nymph_example';
		$nymph_config->PostgreSQL->password['value'] = 'omgomg';
	}
}

return $nymph_config;