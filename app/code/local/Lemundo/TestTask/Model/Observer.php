<?php

class Lemundo_TestTask_Model_Observer
{
    /**
     * Add a test word to a product name. The event is catalog_product_save_after
     * @param Varien_Event_Observer $observer
     * @return $this
     * @throws Mage_Core_Model_Store_Exception
     */
    public function updateProductName($observer){
        $product = $observer->getData('product');
        $name = $product->getName();
        $configValueActive = Mage::getStoreConfig('testtask/general/active', Mage::app()->getStore());
        if ($configValueActive) {
            $configValueTestWord = Mage::getStoreConfig('testtask/general/text_field', Mage::app()->getStore());
            $name.= $configValueTestWord;
            $product->setData('name', $name);
        }
        return $product->getResource()->saveAttribute($product, 'name');
    }
}