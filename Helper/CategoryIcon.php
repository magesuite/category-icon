<?php

namespace MageSuite\CategoryIcon\Helper;

class CategoryIcon extends \Magento\Framework\App\Helper\AbstractHelper
{
    /**
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    protected $storeManager;
    /**
     * @var \Magento\Framework\Filesystem
     */
    protected $directory;

    public function __construct(
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Framework\Filesystem $filesystem
    ) {
        $this->storeManager = $storeManager;
        $this->directory = $filesystem->getDirectoryRead(\Magento\Framework\App\Filesystem\DirectoryList::PUB);
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

    protected function getBaseUrl()
    {
        return $this->storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_WEB);
    }

    protected function buildUrl($imagePath)
    {
        $imagePath = ltrim($imagePath, '/');
        $imagePath = str_replace('media/catalog/category/', '', $imagePath);

        return $this->getBaseMediaUrl() . 'catalog/category/' . $imagePath;
    }

    public function getMimeType(\Magento\Catalog\Model\Category $category)
    {
        $categoryIcon = $category->getCategoryIcon();

        if (empty($categoryIcon)) {
            return null;
        }

        $categoryPath = '/media/catalog/category/';

        if (strpos($categoryIcon, $categoryPath) === false) {
            $categoryIcon = $categoryPath . $categoryIcon;
        }

        $filePath = $this->directory->getAbsolutePath() . $categoryIcon;

        if (!file_exists($filePath)) {
            return null;
        }

        return mime_content_type($filePath);
    }
}
