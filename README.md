postWall
========

postWall a simple video posting-site framework in php no DB needed as flat files are used.

##Built with the following

* Bootstrap http://getbootstrap.com/
* Spectrum http://bgrins.github.io/spectrum/
* bootstrap-datepicker http://www.eyecon.ro/bootstrap-datepicker/

##How to use

1. Clone to a folder on your own web server.
2. Hit yourserver/admin/ServerConfig.php and setup your user/password.
3. Delete above /admin/ServerConfig.php file to keep settings safe.
4. Hit yourserver/admin/ to configure your pages.
5. You may need to adjust folder permissions for settings and entries to be created.

##Local Testing

1. vagrant up
2. local instance will be running at localhost:8080

##What to know

1. Only Youtube or Vimeo videos work as entries.

##Features that are not present by design

1. Comments on posts by others
2. Pagination
3. Social Site Sharing

##Demo

http://www.muteldar.com is built with postWall.
