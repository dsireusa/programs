AtlanticBT README
=================


Project Specifications
----------------------
This section describes the project goals, requirements, limitations, etc


Setting Up
-------------

**Vagrant**
For development use the Vagrant virtual box configuration.

1. Install [Virtual Box](https://www.virtualbox.org/wiki/Downloads)
2. Install [Vagrant](http://www.vagrantup.com/downloads.html)
3. Run the vagrant virtual host
        * Open a terminal
        * navigate to the project directory **eg** ```cd /project/root/directory```
        * start vagrant by typing ```vagrant up --provision```
4. Update hosts file entry on your computer to point **192.168.56.106** to **ncsolar.dev**
        * **OSX** you can achieve this through typing this in a terminal ```echo '192.168.56.106 ncsolar.dev' | sudo tee -a /etc/hosts```)
5. The QA server will act as the authoritative source of data for this project. Create any pages or fields on the QA server and then sync down the database to your local vagrant instance and do any code development.
        * For convenience, there are two scripts provided: `src/sync-qa-db.sh` and `src/apply-schema.sh` The first script pulls down a copy of the QA server's database and allows you to optionally download images on the QA server and apply the data to your local instance. The second script just applies whatever SQL is in the `src/sql/schema.sql` file to your local vagrant instance.
        * When starting this project for the first time, run `src/sync-qa-db.sh` and follow instructions to copy the database (including all data) to your local instance.
6. You can now access the site at [http://ncsolar.dev](http://ncsolar.dev)

** AWS **
For AWS environment, the `src` directory contains the necessary code to run the website.

1. Deploy the code in `src` to a directory such that `src/public` can be set (or symlinked) as the Document Root for Apache
2. Set up the necessary configuration files
    * Look for all files within `src/config/autoload` that end in `*.local.php.dist-gitbranchname` where `gitbranchname` is the name of the git branch you cloned (for production this ought to be 'master', for staging this ought to be 'develop')
    * Copy each of those files such that the `.dist-gitbranchname` portion is removed
        * example: `doctrine.local.php.dist-develop` gets copied as is to `doctrine.local.php` for staging server, `doctrine.local.php.dist-master` gets copied to `doctrine.local.php` for production server.
3. Run composer
    * Within `src` run `composer update` to install all 3rd party PHP libraries.


Dependencies
------------

* Zend Framework 2.3
    * ZfcUser
    * FzyAuth
* AngularJS
* Doctrine
* PHP 5.4
* Gulp


Notes
-----------------------------------
Run ```npm install``` to install node_modules