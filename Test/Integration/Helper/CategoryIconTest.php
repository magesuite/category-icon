<?php

declare(strict_types=1);

namespace MageSuite\CategoryIcon\Test\Integration\Helper;

/**
 * @magentoDbIsolation enabled
 * @magentoAppIsolation enabled
 */
class CategoryIconTest extends \PHPUnit\Framework\TestCase
{
    protected ?\Magento\Framework\App\ObjectManager $objectManager;
    protected ?\Magento\Catalog\Api\CategoryRepositoryInterface $categoryRepository;
    protected ?\MageSuite\CategoryIcon\Helper\CategoryIcon $categoryHelper;

    public function setUp(): void
    {
        $this->objectManager = \Magento\TestFramework\ObjectManager::getInstance();
        $this->categoryHelper = $this->objectManager->get(\MageSuite\CategoryIcon\Helper\CategoryIcon::class);
        $this->categoryRepository = $this->objectManager->create(\Magento\Catalog\Api\CategoryRepositoryInterface::class);
    }

    /**
     * @magentoAppArea frontend
     * @magentoDbIsolation enabled
     * @magentoAppIsolation enabled
     * @magentoDataFixture MageSuite_CategoryIcon::Test/Integration/_files/categories.php
     */
    public function testItReturnsCategoryIcon(): void
    {
        $categoryId = 335;
        $category = $this->categoryRepository->get($categoryId);

        $this->assertEquals('icon.png', $category->getCategoryIcon());

        $url = $this->categoryHelper->getUrl($category);
        $url = str_replace('pub/', '', $url);
        $this->assertEquals(
            'http://localhost/media/catalog/category/icon.png',
            $url
        );
    }

    /**
     * @magentoAppArea frontend
     * @magentoDbIsolation enabled
     * @magentoAppIsolation enabled
     * @magentoDataFixture MageSuite_CategoryIcon::Test/Integration/_files/categories.php
     */
    public function testItReturnsCategoryIconWhenMediaPathIsIncludedInAttribute(): void
    {
        $categoryId = 336;
        $category = $this->categoryRepository->get($categoryId);

        $this->assertEquals('/media/catalog/category/icon.png', $category->getCategoryIcon());

        $url = $this->categoryHelper->getUrl($category);
        $url = str_replace('pub/', '', $url);
        $this->assertEquals(
            'http://localhost/media/catalog/category/icon.png',
            $url
        );
    }

    /**
     * @magentoAppArea frontend
     * @magentoDbIsolation enabled
     * @magentoAppIsolation enabled
     * @magentoDataFixture MageSuite_CategoryIcon::Test/Integration/_files/categories.php
     */
    public function testItReturnsCategoryIconMimeType(): void
    {
        $categoryId = 337;
        $category = $this->categoryRepository->get($categoryId);

        $this->assertEquals('image/jpeg', $this->categoryHelper->getMimeType($category));

        $categoryId = 338;
        $category = $this->categoryRepository->get($categoryId);

        if(!in_array($this->categoryHelper->getMimeType($category), ['image/svg', 'image/svg+xml'])) {
            $this->fail('Mime type must be either image/svg or image/svg+xml');
        }
    }
}
