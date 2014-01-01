exec { "apt-update":
    command => "/usr/bin/apt-get update",
}
####
#
# Dependencies
#
$dependencies = [
    "php5",
    "php5-cli",
    "php-apc",
    "php5-curl",
    "php5-sqlite",
    "php5-intl",
    "php5-mcrypt",
    "php5-imagick",
    "php5-xdebug",
    "git",
    "vim",
    "sendmail",
]
package { $dependencies:
    ensure  => present,
    require => Exec['apt-update'],
}
#### EOF: Dependencies ####

file { "/var/www/scss.local":
    ensure  => "directory",
    #owner   => "www-data",
    #group   => "www-data",
    #mode    => "0775",
    recurse => true,
}

class { "apache": }
class { "apache::mod::php": }
apache::vhost { "app.local":
    priority   => 000,
    port       => 80,
    docroot    => "/var/www/scss.local/web",
    ssl        => false,
    servername => "scss.dev",
    options    => ["FollowSymlinks MultiViews"],
    override   => ["All"],
    ensure     => present,
    require    => File['/var/www/scss.local']
}

class { "mysql": }
class { "mysql::php": }
class {"mysql::server":
    config_hash => {
        "root_password" => "root"
    }
}
mysql::db { 'symfony':
    user     => 'symfony',
    password => 'symfony',
    host     => 'localhost',
    grant    => ['all'],
}