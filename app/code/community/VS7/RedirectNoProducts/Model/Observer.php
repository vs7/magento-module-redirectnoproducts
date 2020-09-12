<?php

class VS7_RedirectNoProducts_Model_Observer
{
    public function checkNoProducts($event)
    {
        $collection = $event->getCollection();
        if ($collection->getSize() == 0) {
            $category = Mage::getSingleton('catalog/layer')->getCurrentCategory();
            if ($category && $category->getId() != null) {
                $originalPathInfo = Mage::app()->getRequest()->getOriginalPathInfo();
                if ($category->getUrlPath() != ltrim($originalPathInfo, '/')) {
                    $url = $category->getUrl();
                    Mage::app()->getResponse()
                        ->setRedirect($url, 301)
                        ->sendResponse();
                    exit();
                }
            }
        }
    }
}
