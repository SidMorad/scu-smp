<?php 
require_once dirname(__FILE__).'/../../library/phplayersmenu320/PHPLIB.php';
require_once dirname(__FILE__).'/../../library/phplayersmenu320/layersmenu-common.inc.php';
require_once dirname(__FILE__).'/../../library/phplayersmenu320/treemenu.inc.php';

$mid = new TreeMenu();
$mid->setDirroot('./');
$mid->setLibjsdir('./static/js/menu/');
$mid->setImgdir('./static/images/menu/');
$mid->setImgwww('./static/images/menu/');
$mid->setIcondir('./static/images/menu/');
$mid->setIconwww('./static/images/menu/');

$mid->setMenuStructureFile(dirname(__FILE__).'/layersmenu-vertical-1.txt');
$mid->setIconsize(16,16);
$mid->parseStructureForMenu('treemenu1');
//$mid->setSelectedItemByCount('treemenu1',1);
$selectedURL = 'index.php';
if (isset($_GET['view'])){
	$selectedURL = $selectedURL . '?view=' . $_GET['view'];
	if (isset($_GET['action'])){
		$selectedURL = $selectedURL . '&action=' . $_GET['action'];  
	}
}
$mid->setSelectedItemByUrl('treemenu1', $selectedURL);
print $mid->newTreeMenu('treemenu1');
