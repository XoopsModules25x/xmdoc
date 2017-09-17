<?php
/*
 You may not change or alter any portion of this comment or credits
 of supporting developers from this source code or any supporting source code
 which is considered copyrighted (c) material of the original comment or credit authors.

 This program is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
*/

/**
 * xmdoc module
 *
 * @copyright       XOOPS Project (http://xoops.org)
 * @license         GNU GPL 2 (http://www.gnu.org/licenses/old-licenses/gpl-2.0.html)
 * @author          Mage Gregory (AKA Mage)
 */
use Xmf\Request;
use Xmf\Module\Helper;

require_once dirname(dirname(__DIR__)) . '/mainfile.php';

include __DIR__ . '/include/common.php';
xoops_load('utility', basename(__DIR__));

$helper     = Helper::getHelper('xmdoc');
$permHelper = new \Xmf\Module\Helper\Permission();

$cat_id = Request::getInt('cat_id', 0);
$doc_id  = Request::getInt('doc_id', 0);

// Checking access
if ($cat_id == 0) {
    redirect_header(XOOPS_URL, 2, _MA_XMDOC_ERROR_NOCATEGORY . 'AAA');
}
// permission to view
$permHelper->checkPermissionRedirect('xmdoc_view', $cat_id, 'index.php', 2, _NOPERM);
if ($doc_id == 0) {
    redirect_header(XOOPS_URL, 2, _MA_XMDOC_ERROR_NODOCUMENT);
}
$category = $categoryHandler->get($cat_id);
$document = $documentHandler->get($doc_id);
if (count($category) == 0) {
    redirect_header(XOOPS_URL, 2, _MA_XMDOC_ERROR_NOCATEGORY . 'BBB');
}
if (count($document) == 0) {
    redirect_header(XOOPS_URL, 2, _MA_XMDOC_ERROR_NODOCUMENT);
}
if ($category->getVar('category_status') == 0 || $document->getVar('document_status') == 0) {
    redirect_header(XOOPS_URL, 2, _MA_XMDOC_ERROR_NACTIVE);
}

$url = XmdocUtility::formatURL($document->getVar('document_document'));
Header("Location: $url");
exit();