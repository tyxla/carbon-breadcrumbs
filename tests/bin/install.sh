#!/usr/bin/env bash
# See https://github.com/wp-cli/wp-cli/blob/master/templates/install-wp-tests.sh

# MySQL settings
if [ $# -lt 3 ]; then
	echo "usage: $0 <db-name> <db-user> <db-pass> [db-host] [wp-version]"
	exit 1
fi

# General variables
DB_NAME=$1
DB_USER=$2
DB_PASS=$3
DB_HOST=${4-localhost}
WP_VERSION=${5-latest}
BASEDIR="${PWD}"

# Handle Windows drive paths
if [ "$(expr substr $(uname -s) 1 5)" == "MINGW" ]; then
	BASEDIR=$(echo $BASEDIR | sed 's/\/([a-zA-Z])\//\1:\//g')
fi

# Setup directory vars
WP_TESTS_DIR="${BASEDIR}/tmp/wordpress-tests-lib"
WP_CORE_DIR="${BASEDIR}/tmp/wordpress/"

set -ex

# Used to download a file to a certain location
download() {
    if [ `which curl` ]; then
        curl -s "$1" > "$2";
    elif [ `which wget` ]; then
        wget -nv -O "$2" "$1"
    fi
}

# Determine WP version to download
wp_version() {
	# Determine which version to download
	if [ $WP_VERSION == 'latest' ]; then
		local url='trunk'
	else
		local url="branches/$WP_VERSION"
	fi

	echo "$url"
}

# Install a certain version (or the latest one) of WordPress 
install_wp() {
	mkdir -p $WP_CORE_DIR

	# Determine which version to download
	local url=$(wp_version)

	# Checkout the WordPress core
	cd $WP_CORE_DIR
	svn co --quiet http://develop.svn.wordpress.org/${url}/src/ .

	# Copy the database settings (wp-content/db.php)
	cp $BASEDIR/tests/misc/db.php $WP_CORE_DIR/wp-content/db.php
}

# Install the WordPress test suite
install_test_suite() {
	# Portable in-place argument for both GNU sed and Mac OSX sed
	if [[ $(uname -s) == 'Darwin' ]]; then
		local ioption='-i .bak'
	else
		local ioption='-i'
	fi

	# Determine which version to download
	local testsurl=$(wp_version)

	# Prepare target directory and checkout WP test suite
	mkdir -p $WP_TESTS_DIR
	cd $WP_TESTS_DIR
	svn co --quiet http://develop.svn.wordpress.org/${testsurl}/tests/phpunit/includes/

	# Download base configuration file
	download http://develop.svn.wordpress.org/${testsurl}/wp-tests-config-sample.php wp-tests-config.php

	if [ $WP_VERSION == '4.7' ]; then
		svn patch "Index: /tmp/includes/testcase.php
===================================================================
--- /tmp/includes/testcase.php	(revision 39625)
+++ /tmp/includes/testcase.php	(revision 39626)
@@ -58,4 +58,11 @@
 
 	public static function setUpBeforeClass() {
+		global $wpdb;
+
+		$wpdb->suppress_errors = false;
+		$wpdb->show_errors = true;
+		$wpdb->db_connect();
+		ini_set('display_errors', 1 );
+
 		parent::setUpBeforeClass();
 
@@ -99,9 +106,6 @@
 		}
 
-		global $wpdb, $wp_rewrite;
-		$wpdb->suppress_errors = false;
-		$wpdb->show_errors = true;
-		$wpdb->db_connect();
-		ini_set('display_errors', 1 );
+		global $wp_rewrite;
+
 		$this->clean_up_global_scope();
 
Index: /tmp/includes/utils.php
===================================================================
--- /tmp/includes/utils.php	(revision 39625)
+++ /tmp/includes/utils.php	(revision 39626)
@@ -390,4 +390,9 @@
 		$this->field_types = $wpdb->field_types;
 		$this->charset = $wpdb->charset;
+
+		$this->dbuser = $wpdb->dbuser;
+		$this->dbpassword = $wpdb->dbpassword;
+		$this->dbname = $wpdb->dbname;
+		$this->dbhost = $wpdb->dbhost;
 	}
"
	fi

	# Make sure colons are escaped (they might exist in Windows environments)
	WP_CORE_DIR=$(echo $WP_CORE_DIR | sed 's/:/\\:/g')

	# Replace variables in the config file
	sed $ioption "s:dirname( __FILE__ ) . '/src/':'$WP_CORE_DIR':" wp-tests-config.php 2> /dev/null
	sed $ioption "s/youremptytestdbnamehere/$DB_NAME/" wp-tests-config.php 2> /dev/null
	sed $ioption "s/yourusernamehere/$DB_USER/" wp-tests-config.php 2> /dev/null
	sed $ioption "s/yourpasswordhere/$DB_PASS/" wp-tests-config.php 2> /dev/null
	sed $ioption "s|localhost|${DB_HOST}|" wp-tests-config.php 2> /dev/null
	sed $ioption "s/Test Blog/Carbon Breadcrumbs Unit Tests/" wp-tests-config.php 2> /dev/null
}

install_wp
install_test_suite