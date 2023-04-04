<?php
/**
 * @abstract Web service that answers the question 'are there selected samples for a freezer pull.'
 * If there are selected samples then we return true, otherwise we return false.  This service is used
 * to show or hide the sample pull report link.
 * @author w. Patrick Gale (May 2012)
 */
// we do not print header or footer html
$this->RenderBegin(false);
$freezerPullArray = unserialize(QSessionDB::get('__FREEZER_PULL_LIST__'));
// if we have a list of selected samples to pull then we will return true
if (is_array($freezerPullArray) && count($freezerPullArray) > 0) print 1;
else print 0;
$this->RenderEnd(false);
?>