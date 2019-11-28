phpMyAdmin discovery

Sometimes (quite a lot, sadly) people install phpMyAdmin by just downloading it from https://www.phpmyadmin.net/downloads/ and unarchive it in root (for easy access probably).

This, combined with a google dork/logs/app in debug mode, that can show you a mysql username can prove fatal.

Scan your own domains and if you find such a folder .. just rename it to a more hard-to-guess name. Example ... pma123411234342

Enjoy!


------

----------------------------------------
phpMyAdmin Discovery Script - https://github.com/nekhbet/phpmyadmin-discovery
----------------------------------------
[Parameters]
	'-h' shows this help
	'-v' verbose, if missing will show just the folders that will return HTTP code 20X/30X
	'--domain=DOMAIN_WITH_PROTOCOL' sets the base path (domain, eventually a path)
[Examples]
	php phpmyadmin_discovery.php --domain=https://domain.com -v
	php phpmyadmin_discovery.php --domain=http://42.42.42.42
----------------------------------------

