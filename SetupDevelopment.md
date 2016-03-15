# Required software #

For start developing this project you need to have these software installed in your computer:
  * Apache-2.2.x
  * PHP-5.2.x
  * MySQL-5.x


Note: For easy installation, you may want use XAMP for windows ([link](http://www.apachefriends.org/en/xampp-windows.html)).

# Required configuration #

## Database config file ##
{project\_root}/smp/config/[smp\_config.xml](http://code.google.com/p/scu-smp/source/browse/trunk/smp-php/smp/config/smp_config.xml)

You can change DSN config to yours or create similar MySQL environment like below:

## MySQL ##
Run below commands in MySQL console
```
CREATE USER smp@localhost IDENTIFIED BY 'smp';
CREATE DATABASE smp;
GRANT ALL ON smp.* to smp@localhost;
\. /path/to/your/db/schema.sql
```
Note: SMP schema file is on root of project ([db.sql](http://code.google.com/p/scu-smp/source/browse/trunk/smp-php/db.sql)).

## PEAR packages ##
Install below PEAR packages :
```
pear install HTML_Table-1.8.3
pear install HTTP_Upload-1.0.0b1
pear install Image_Transform-0.9.3
pear install Mail-1.2.0
pear install Net_SMTP-1.4.2
pear install -o Structures_DataGrid-0.9.0
pear install -o Structures_DataGrid_DataSource_MDB2-0.1.11
pear install -o Structures_DataGrid_Renderer_CSV-0.1.4
pear install -o Structures_DataGrid_Renderer_HTMLTable-0.1.5
pear install -o Structures_DataGrid_Renderer_Pager-0.1.3
pear install -o Structures_DataGrid_Renderer_XLS-0.1.3
pear install OLE-0.6.1
pear install Pager-2.4.8
pear install MDB2-2.5.0b2
pear install MDB2_Driver_mysql-1.5.0b2
pear install Structures_Graph-1.0.3
pear install Spreadsheet_Excel_Writer-0.9.2
```
Note: Different versions should work fine too, if you want last version just type `pear install package_name` (without version number).

Note2 : If you got error for install Structures\_DataGrid then try `pear install -o Structures_DataGrid-beta` (solution from [here](http://pear.php.net/manual/en/package.structures.structures-datagrid.installation.php)).

## Mail Server ##
{project\_root}/smp/util/[MailUtil.php](http://code.google.com/p/scu-smp/source/browse/trunk/smp-php/smp/util/MailUtil.php)

SMTP is default settings for sending email.

for different config you can have a look at [here](http://pear.php.net/package/Mail/docs).

## Constants ##
{project\_root}/smp/[Constants.php](http://code.google.com/p/scu-smp/source/browse/trunk/smp-php/smp/Constants.php)

You should modify APPLICATION\_DOMAIN const to yours.

You may want to modify other consts but be careful about change Role's constants (If you change them , then you need to update the data of Role's table from database too).

## Others ##
If you installed local copy of PEAR on a shared host, then
you need to make sure line 6 of [index.php](http://code.google.com/p/scu-smp/source/browse/trunk/smp-php/index.php) refers to PEAR directory correctly.
```
// Include a local PEAR copy on a shared host
set_include_path('~/pear/lib' . PATH_SEPARATOR . get_include_path());
```