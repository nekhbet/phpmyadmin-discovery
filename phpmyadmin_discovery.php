<?php

$options = getopt('hv', [
    "domain::",
]);

if ( ! $options OR ($options['h'] ?? TRUE) === FALSE)
{
    die(show_help());
}

$verbose = isset($options['v']) ? TRUE : FALSE;
//print_r($options);
//var_dump($verbose);
//die();

$domain = $options['domain'] ?? FALSE;
if ($domain !== FALSE)
{
    $domain = rtrim($domain, '/');
    if ( ! validate_basepath($domain))
    {
        $domain = FALSE;
    }
}

if ($domain === FALSE)
{
    show_error('Invalid domain. See examples!');
}

$standalones = [
    'pma',
    'php-myadmin',
    'phpmy-admin',
    'webadmin',
    'sqlweb',
    'websql',
    'webdb',
    'mysqladmin',
    'mysql-admin',
];

$base_filenames = [
    'phpMyAdmin-'
];

$versions = [
    '5.1',
    '5.0.0-rc1',
    '5.0.0-alpha1',
    '4.9.2',
    '4.9.1',
    '4.9.0.1',
    '4.9.0',
    '4.8.5',
    '4.8.4',
    '4.8.3',
    '4.8.2',
    '4.8.1',
    '4.8.0.1',
    '4.8.0',
    '4.8.0-rc1',
    '4.8.0-alpha1',
    '4.7.9',
    '4.7.8',
    '4.7.7',
    '4.7.6',
    '4.7.5',
    '4.7.4',
    '4.7.3',
    '4.7.2',
    '4.7.1',
    '4.7.0',
    '4.7.0-rc1',
    '4.7.0-beta1',
    '4.6.6',
    '4.6.5.2',
    '4.6.5.1',
    '4.6.5',
    '4.6.4',
    '4.6.3',
    '4.6.2',
    '4.6.1',
    '4.6.0',
    '4.6.0-rc2',
    '4.6.0-rc1',
    '4.6.0-alpha1',
    '4.5.5.1',
    '4.5.5',
    '4.5.4.1',
    '4.5.4',
    '4.5.3.1',
    '4.5.3',
    '4.5.2',
    '4.5.1',
    '4.5.0.2',
    '4.5.0.1',
    '4.5.0',
    '4.4.15.10',
    '4.4.15.9',
    '4.4.15.8',
    '4.4.15.7',
    '4.4.15.6',
    '4.4.15.5',
    '4.4.15.4',
    '4.4.15.3',
    '4.4.15.2',
    '4.4.15.1',
    '4.4.15',
    '4.4.14.1',
    '4.4.14',
    '4.4.13.1',
    '4.4.13',
    '4.4.12',
    '4.4.11',
    '4.4.10',
    '4.4.9',
    '4.4.8',
    '4.4.7',
    '4.4.6.1',
    '4.4.6',
    '4.4.5',
    '4.4.4',
    '4.4.3',
    '4.4.2',
    '4.4.1.1',
    '4.4.1',
    '4.4.0',
    '4.3.13.3',
    '4.3.13.2',
    '4.3.13.1',
    '4.3.13',
    '4.3.12',
    '4.3.11.1',
    '4.3.11',
    '4.3.10',
    '4.3.9',
    '4.3.8',
    '4.3.7',
    '4.3.6',
    '4.3.5',
    '4.3.4',
    '4.3.3',
    '4.3.2',
    '4.3.1',
    '4.3.0',
    '4.2.13.3',
    '4.2.13.2',
    '4.2.13.1',
    '4.2.13',
    '4.2.12',
    '4.2.11',
    '4.2.10.1',
    '4.2.10',
    '4.2.9.1',
    '4.2.9',
    '4.2.8.1',
    '4.2.8',
    '4.2.7.1',
    '4.2.7',
    '4.2.6',
    '4.2.5',
    '4.2.4',
    '4.2.3',
    '4.2.2',
    '4.2.1',
    '4.2.0',
    '4.1.14.8',
    '4.1.14.7',
    '4.1.14.6',
    '4.1.14.5',
    '4.1.14.4',
    '4.1.14.3',
    '4.1.14.2',
    '4.1.14.1',
    '4.1.14',
    '4.1.13',
    '4.1.12',
    '4.1.11',
    '4.1.10',
    '4.1.9',
    '4.1.8',
    '4.1.7',
    '4.1.6',
    '4.1.5',
    '4.1.4',
    '4.1.3',
    '4.1.2',
    '4.1.1',
    '4.1.0',
    '4.0.10.20',
    '4.0.10.19',
    '4.0.10.18',
    '4.0.10.17',
    '4.0.10.16',
    '4.0.10.15',
    '4.0.10.14',
    '4.0.10.13',
    '4.0.10.12',
    '4.0.10.11',
    '4.0.10.10',
    '4.0.10.9',
    '4.0.10.8',
    '4.0.10.7',
    '4.0.10.6',
    '4.0.10.5',
    '4.0.10.4',
    '4.0.10.3',
    '4.0.10.2',
    '4.0.10.1',
    '4.0.10',
    '4.0.9',
    '4.0.8',
    '4.0.7',
    '4.0.6',
    '4.0.5',
    '4.0.4.2',
    '4.0.4.1',
    '4.0.4',
    '4.0.3',
    '4.0.2',
    '4.0.1',
    '4.0.0',
    '3.5.8.2',
    '3.5.8.1',
    '3.5.8',
    '3.5.7',
    '3.5.6',
    '3.5.5',
    '3.5.4',
    '3.5.3',
    '3.5.2.2',
    '3.5.2.1',
    '3.5.2',
    '3.5.1',
    '3.5.0',
    '3.4.11.1',
    '3.4.11',
    '3.4.10.2',
    '3.4.10.1',
    '3.4.10',
    '3.4.9',
    '3.4.8',
    '3.4.7.1',
    '3.4.7',
    '3.4.6',
    '3.4.5',
    '3.4.4',
    '3.4.3.2',
    '3.4.3.1',
    '3.4.3',
    '3.4.2',
    '3.4.1',
    '3.4.0',
    '3.3.10.5',
    '3.3.10.4',
    '3.3.10.3',
    '3.3.10.2',
    '3.3.10.1',
    '3.3.10',
    '3.3.9.2',
    '3.3.9.1',
    '3.3.9',
    '3.3.8.1',
    '3.3.8',
    '3.3.7',
    '3.3.6',
    '3.3.5.1',
    '3.3.0',
    '3.2.0',
    '3.1.0',
    '3.0.0',
    '2.11.11.3',
    '2.11.11.2',
    '2.11.11.1',
    '2.11.11',
    '2.11.10.1',
    '2.10.3',
    '2.10.2',
    '2.9.0',
    '2.8.0',
    '2.7.0',
    '2.6.0',
    '2.5.0',
    '2.4.0',
    '2.3.0',
    '2.2.0',
    '2.1.0',
    '2.0.5',
    '1.3.1',
    '1.3.0',
    '1.2.0',
    '1.1.0',
    '0.9.0',
    'latest'
];

$post_versions = [
    '+snapshot',
    ''
];

$suffixed = [
    'all-languages',
    'english',
    'source',
    '', // count for simple renames
];


show_status('Starting scan');
foreach ($standalones as $standalone)
{
    $full_url = $domain.'/'.$standalone.'/';
    check_url($full_url, $verbose);
}
foreach ($base_filenames as $base_filename)
{
    foreach ($versions as $version)
    {
        foreach ($post_versions as $post_version)
        {
            foreach ($suffixed as $suffix)
            {
                $full_url = $domain.'/'.$base_filename.$version.$post_version.($suffix ? '-'.$suffix : '').'/';
                check_url($full_url, $verbose);
            }
        }
    }
}
show_status('Scan finished');

function show_status($success_msg)
{
    echo str_repeat('-', 40)."\n";
    echo "[$success_msg]\n";
    echo str_repeat('-', 40)."\n";
}

function show_error($error_msg)
{
    show_help();
    echo "[Error]\n";
    echo "\t$error_msg\n";
    echo str_repeat('-', 40)."\n";
    die();
}

function check_url($url, $verbose = FALSE)
{
    $code = 'N/A';
    $curlHandle = curl_init();
    curl_setopt($curlHandle, CURLOPT_URL, $url);
    curl_setopt($curlHandle, CURLOPT_NOBODY, TRUE);
    curl_setopt($curlHandle, CURLOPT_HEADER, TRUE);
    curl_setopt($curlHandle, CURLOPT_FOLLOWLOCATION, TRUE);
    curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($curlHandle, CURLOPT_USERAGENT, 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36');
    $response = curl_exec($curlHandle);

//    print_r($response);die();

    $httpcode = curl_getinfo($curlHandle, CURLINFO_HTTP_CODE);

    if (intval($httpcode) < 100)
    {
        show_error('Invalid HTTP status code. Are you sure the domain is valid or that a webserver is running?');
    }
    if ($verbose)
    {
        echo "[$httpcode] $url\n";
    }
    else
    {
        $status_class = ceil($httpcode / 100);
        if ($status_class == '2' OR $status_class == '3')
        {
            echo "[$httpcode] $url\n";
        }
    }
}

function validate_basepath($base_path)
{
    $ok = TRUE;
    $tmp = parse_url($base_path);
    if ($tmp === FALSE)
    {
        $ok = FALSE;
    }
    else
    {
        // Not that malformed
        if ((($tmp['scheme'] ?? FALSE) === FALSE) OR (($tmp['host'] ?? FALSE) === FALSE))
        {
            $ok = FALSE;
        }
        elseif ( ! in_array($tmp['scheme'], ['http', 'https']))
        {
            $ok = FALSE;
        }
//        var_dump($ok);
//        print_r($tmp);
//        die();
    }
    return $ok;
}

function show_help()
{
    echo str_repeat('-', 40)."\n";
    echo "phpMyAdmin Discovery Script - https://github.com/nekhbet/phpmyadmin-discovery\n";
    echo str_repeat('-', 40)."\n";
    echo "[Parameters]\n";
    echo "\t'-h' shows this help\n";
    echo "\t'-v' verbose, if missing will show just the folders that will return HTTP code 20X/30X\n";
    echo "\t'--domain=DOMAIN_WITH_PROTOCOL' sets the base path (domain, eventually a path)\n";
    echo "[Examples]\n";
    echo "\tphp phpmyadmin_discovery.php --domain=https://domain.com -v\n";
    echo "\tphp phpmyadmin_discovery.php --domain=http://42.42.42.42\n";
    echo str_repeat('-', 40)."\n";
}
