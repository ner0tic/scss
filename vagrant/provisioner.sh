#!/bin/bash

export DEBIAN_FRONTEND=noninteractive

SYMFONY_DIR="/var/www/vhosts/local.vagrant.scss"

function log() {
  echo "=== $@";
}

function configure_mysql() {
  which mysqld > /dev/null
  if [ 0 -eq $? ]; then
    log "mysql already installed"
  else
    log "Installing mysql packages"

    MYSQL_ROOT_PASSWORD='02a33b65fc21eada51677af874193740'
    echo mysql-server-5.5 mysql-server/root_password password $MYSQL_ROOT_PASSWORD | debconf-set-selections
    echo mysql-server-5.5 mysql-server/root_password_again password $MYSQL_ROOT_PASSWORD | debconf-set-selections

    apt-get -qq install \
      mysql-server \
      php5-mysql
  fi
}

function configure_fontcustom() {
  which fontcustom > /dev/null
  if [ 0 -eq $? ]; then
    log "fontcustom already installed"
  else
    log "Installing fontcustom packages"
    apt-get -qq install fontforge rubygems unzip
    wget http://people.mozilla.com/~jkew/woff/woff-code-latest.zip
    unzip woff-code-latest.zip -d sfnt2woff && \
        cd sfnt2woff && \
        make && \
        mv sfnt2woff /usr/local/bin/ && \
        cd .. && \
        rm -rf woff-code-latest.zip sfnt2woff

    curl -O http://ttf2eot.googlecode.com/files/ttf2eot-0.0.2-2.tar.gz && \
        tar --no-same-owner -zxf ttf2eot-0.0.2-2.tar.gz && \
        cd ttf2eot-0.0.2-2 && \
        curl 'http://f.cl.ly/items/3B3U3Q0Z2e3m3J2I042m/OpenTypeUtilities.diff' > 22.patch && \
        patch -p1 < 22.patch && \
        make && \
        cp ttf2eot /usr/local/bin/ && \
        cd .. && \
        rm -rf ttf2eot-0.0.2-2 ttf2eot-0.0.2-2.tar.gz
    git clone git://github.com/m14t/fontcustom.git && \
        cd fontcustom/ && \
        gem build fontcustom.gemspec && \
        ver=`sed -ne's/.*VERSION[^"]*"\([^"]*\).*/\1/p' lib/fontcustom/version.rb` && \
        sudo gem install --version=${ver} fontcustom-${ver}.gem && \
        cd .. && \
        rm -rf fontcustom
  fi
}

function configure_apache_and_php() {
  if `which php &>/dev/null` && [ "5.4" = "`echo '<?php echo phpversion();' | php | cut -c1-3`" ]; then
      log "PHP 5.4 already installed"
  else
    log "Installing php packages"
    apt-get -qq --force-yes install \
      php-apc \
      php-pear \
      php5 \
      php5-curl \
      php5-dev \
      php5-imagick \
      php5-intl \
      php5-tidy \
      php5-imagick

    log "Disabling php's short_open_tag"
    INI_FILES="`find /etc/php5 -name 'php.ini'`"
    for f in $INI_FILES; do
      mv $f $f.orig
      sed -e's/^short_open_tag = On$/short_open_tag = Off/' $f.orig > $f
    done

    log "Setting php timezone"
    echo 'date.timezone = "UTC"'> /etc/php5/conf.d/10-timezone.ini
  fi

  #-- Install PHPUnit if necessary
  if ! which phpunit>/dev/null ; then
    log "Installing phpunit"
    pear channel-discover pear.phpunit.de
    pear channel-discover components.ez.no
    pear channel-discover pear.symfony-project.com
    pear channel-discover pear.symfony.com
    pear install --alldeps phpunit/PHPUnit
  fi

  if ! which node>/dev/null ; then
    log "Installing nodejs"
    apt-get -qq install nodejs
  fi

  if ! which phpcs>/dev/null ; then
    log "Installing phpcs"
    curl -O https://raw.github.com/UseAllFive/useallfive-coding-standards/master/install.sh
    bash install.sh -a
    rm install.sh
  fi

#  log "Installing APC"
#  printf "\n" | pecl install apc
#
#  if `pecl list | grep -q '^mongo'`; then
#    log "mongo is already installed"
#  else
#    log "Installing php mongo"
#    apt-get -qq install mongodb
#
#    log "Installing php mongo extension"
#    pecl install mongo
#
#    echo "extension=mongo.so" > /etc/php5/mods-available/mongo.ini
#    ln -sf /etc/php5/mods-available/mongo.ini /etc/php5/conf.d/20-mongo.ini
#  fi


  apache_modules="deflate filter headers include rewrite"
  log "Enabling the following Apache modules: $apache_modules"
  need_apache_restart=1
  for m in $apache_modules; do
  a2enmod $m | grep -q '^Module include already enabled'
      if [ 0 -eq $? ]; then
          need_apache_restart=0
      fi
  done

  if [ 0 -eq $need_apache_restart ]; then
    log "Restarting Apache"
    /etc/init.d/apache2 restart
  fi
}

function configure_s3() {
  local CFG_FILE="/home/vagrant/.s3cfg"

  if `which s3cmd &>/dev/null`; then
      log "s3cmd is already installed"
  else
    log "Installing s3cmd"
    apt-get -qq --force-yes install \
      s3cmd
  fi

  if [ -f "$CFG_FILE" ]; then
      log "s3cmd is already configured"
  else
      log "Installing s3cmd config file"
      cat > "$CFG_FILE" <<EOT
[default]
access_key = AKIAIE5ZIXSFX4HSOQ6Q
bucket_location = US
cloudfront_host = cloudfront.amazonaws.com
cloudfront_resource = /2010-07-15/distribution
default_mime_type = binary/octet-stream
delete_removed = False
dry_run = False
encoding = ISO-8859-1
encrypt = False
follow_symlinks = False
force = False
get_continue = False
gpg_command = /usr/bin/gpg
gpg_decrypt = %(gpg_command)s -d --verbose --no-use-agent --batch --yes --passphrase-fd %(passphrase_fd)s -o %(output_file)s %(input_file)s
gpg_encrypt = %(gpg_command)s -c --verbose --no-use-agent --batch --yes --passphrase-fd %(passphrase_fd)s -o %(output_file)s %(input_file)s
gpg_passphrase = 
guess_mime_type = True
host_base = s3.amazonaws.com
host_bucket = %(bucket)s.s3.amazonaws.com
human_readable_sizes = False
list_md5 = False
log_target_prefix = 
preserve_attrs = True
progress_meter = True
proxy_host = 
proxy_port = 0
recursive = False
recv_chunk = 4096
reduced_redundancy = False
secret_key = qN3tq+GPlFnQRRU1RmBrYw80BtqVNe2Fo9CPCX4l
send_chunk = 4096
simpledb_host = sdb.amazonaws.com
skip_existing = False
socket_timeout = 10
urlencoding_mode = normal
use_https = False
verbosity = WARNING
EOT
  fi
}

#-- check if add-apt-repository is installed
if ! `which add-apt-repository &>/dev/null`; then
  log "Updating our repositories (needed so we can install python-software-properties)"
  apt-get -qq update

  log "Installing package management utilities"
  apt-get -qq install \
    debconf-utils \
    python-software-properties \
    python \
    g++ \
    make
fi

if [ ! -f /etc/apt/sources.list.d/ondrej-php5-oldstable-precise.list ]; then
  log "Adding php5.4 repository"
  add-apt-repository --yes ppa:ondrej/php5-oldstable
fi

if [ ! -f /etc/apt/sources.list.d/chris-lea-node_js-precise.list ]; then
  log "Adding nodejs repository"
  add-apt-repository --yes ppa:chris-lea/node.js
fi

log "Updating our repositories"
apt-get -qq update
apt-get -qq upgrade

log "Installing generic packages"
apt-get -qq install \
  curl \
  git \
  libpcre3-dev \
  make \
  screen \
  vim


configure_apache_and_php
configure_s3
configure_mysql
configure_fontcustom

#-- get config settings
curl http://mattfarmer.net/.screenrc > ~/.screenrc
alias prudential-platformf &> /dev/null
if [ 0 -ne $? ]; then
  echo "alias prudential-platform=\"cd $SYMFONY_DIR\"" >> ~/.bash_aliases
fi

#-- link up the symfony executable
#ln -s $SYMFONY_DIR/lib/vendor/symfony/data/bin/symfony $SYMFONY_DIR/symfony
#mkdir $SYMFONY_DIR/cache
#mkdir $SYMFONY_DIR/log
#chown www-data:www-data $SYMFONY_DIR/cache $SYMFONY_DIR/log
#chmod 777 $SYMFONY_DIR/cache $SYMFONY_DIR/log

cd $SYMFONY_DIR

#-- Create a parameters.yml file if there isn't one already.
if [ ! -f "app/config/parameters.yml" ]; then
  log "Creating the app/config/parameters.yml"
  cp app/config/deploy/env_files/vagrant/app/config/parameters.yml app/config/parameters.yml
fi

#-- Configure SSH to not warn for unknown finger prints
if [ ! -d "$HOME/.ssh" ]; then
  mkdir "$HOME/.ssh"
  chmod 644 "$HOME/.ssh"
fi
grep -q github.com ~/.ssh/config 2> /dev/null
ret=$?
if [ ! -f "$HOME/.composer/config.json" -o 0 -ne $ret ]; then
  echo -e "Host github.com\nStrictHostKeyChecking no" >> "$HOME/.ssh/config"
fi

#-- Setup symlink for capifony
if [ ! -L "${SYMFONY_DIR}/releases" ]; then
    ln -s . ${SYMFONY_DIR}/releases
fi

#-- Authorize dev environment to be able to pull from github.com as the 'prudential-platform-dev' user
if [ ! -d "$HOME/.composer" ]; then
  mkdir "$HOME/.composer"
fi
if [ ! -f "$HOME/.composer/config.json" ]; then
  echo '{"config":{"github-oauth":{"github.com":"3b32b00451edb0c4ec20c2ebd60f224b3058a7f5"}}}' > "$HOME/.composer/config.json"
fi

#-- Set this environment to use relative symlinks for deploys
SYMFONY_ASSETS_INSTALL_STRING='SYMFONY_ASSETS_INSTALL=relative'
grep -q "$SYMFONY_ASSETS_INSTALL_STRING" $HOME/.bashrc 2> /dev/null
ret=$?
if [ 0 -ne $ret ]; then
    echo "export $SYMFONY_ASSETS_INSTALL_STRING" >> $HOME/.bashrc
    export $SYMFONY_ASSETS_INSTALL_STRING
fi

#-- Update php dependencies
if [ ! -f composer.phar ]; then
  #-- Untested
  curl -s http://getcomposer.org/installer | php
fi
$SYMFONY_ASSETS_INSTALL_STRING php composer.phar install

#-- Let root connect remotely
#-- Comment out bind-address in /etc/mysql/my.cnf
# TODO: ^
#-- Create remote root user
# echo 'GRANT ALL ON * TO "root"@"192.168.200.1" IDENTIFIED BY "${MYSQL_ROOT_PASSWORD}";' | mysql -u root -p${MYSQL_ROOT_PASSWORD} prudential-platform

#-- Initialize the ACL system
php app/console init:acl

#-- Create the database
grep '^doctrine:$' app/config/config.yml -q
if [ 0 -eq $? ]; then
  php app/console doctrine:database:drop --force
  php app/console doctrine:database:create
  php app/console doctrine:schema:update --force
  php app/console doctrine:fixtures:load
fi
#grep '^doctrine_mongodb:$' app/config/config.yml -q
#if [ 0 -eq $? ]; then
#  php app/console doctrine:mongodb:fixtures:load
#fi
php app/console cache:clear &> /dev/null

true