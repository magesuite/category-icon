<?php

namespace MageSuite\CategoryIcon\Helper;

class CategoryIcon extends \Magento\Framework\App\Helper\AbstractHelper
{
    /**
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    protected $storeManager;

    public function __construct(\Magento\Store\Model\StoreManagerInterface $storeManager)
    {
        $this->storeManager = $storeManager;
    }

    /**
     * @param \Magento\Catalog\Model\Category $category
     * @return null|string
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getUrl(\Magento\Catalog\Model\Category $category)
    {
        $imagePath = $category->getCategoryIcon();

        if (!$imagePath) {
            return null;
        }

        if (is_string($imagePath)) {
            return $this->buildUrl($imagePath);
        } elseif (is_array($imagePath) && isset($imagePath[0]) && isset($imagePath[0]['name'])) {
            return $this->buildUrl($imagePath[0]['name']);
        }

        throw new \Magento\Framework\Exception\LocalizedException(__('Something went wrong while getting the image url.'));
    }

    protected function getBaseMediaUrl()
    {
        return $this->storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA);
    }

    protected function buildUrl($imagePath) {
        return $this->getBaseMediaUrl() . 'catalog/category/' . $imagePath;
    }
}