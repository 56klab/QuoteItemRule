<?php
 
class Quantility_QuoteItemRule_Model_SalesRule_Rule_Condition_Product extends Mage_Rule_Model_Condition_Product_Abstract
{
    protected function _addSpecialAttributes(array &$attributes)
    {
        parent::_addSpecialAttributes($attributes);
        $attributes['quote_item_qty'] = Mage::helper('salesrule')->__('Quantity in cart');
        $attributes['quote_item_price'] = Mage::helper('salesrule')->__('Price in cart');
        $attributes['quote_item_row_total'] = Mage::helper('salesrule')->__('Row total in cart');
 
        /* @Quantility */
        $attributes['quote_item_sku'] = Mage::helper('salesrule')->__('SKU');
        /* @Quantility */
    }
 
    public function validate(Varien_Object $object)
    {
        $product = false;
        if ($object->getProduct() instanceof Mage_Catalog_Model_Product) {
            $product = $object->getProduct();
        } else {
            $product = Mage::getModel('catalog/product')
                ->load($object->getProductId());
        }
 
        $product
            ->setQuoteItemQty($object->getQty())
            ->setQuoteItemPrice($object->getPrice())
            ->setQuoteItemRowTotal($object->getBaseRowTotal())
            /* @Quantility */
            ->setQuoteItemSku($object->getSku())
            /* @Quantility */;
 
        return parent::validate($product);
    }
}
?>
