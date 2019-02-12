<?php

/** @var \Magento\Framework\Registry $registry */
$objectManager = \Magento\TestFramework\Helper\Bootstrap::getObjectManager();
$registry = $objectManager->get(\Magento\Framework\Registry::class);

$registry->unregister('isSecureArea');
$registry->register('isSecureArea', true);

/** @var $category \Magento\Catalog\Model\Category */
foreach ([333, 335] as $categoryId) {
    $category = $objectManager->create(\Magento\Catalog\Model\Category::class);
    $category->load($categoryId);
    if ($category->getId()) {
        $category->delete();
    }
}
