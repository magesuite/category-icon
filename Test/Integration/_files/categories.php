<?php

/** @var \Magento\Catalog\Model\Category $category */
$objectManager = \Magento\TestFramework\Helper\Bootstrap::getObjectManager();

$category = $objectManager->create(\Magento\Catalog\Model\Category::class);
$category->isObjectNew(true);
$category
    ->setId(333)
    ->setCreatedAt('2014-06-23 09:50:07')
    ->setName('Main category')
    ->setParentId(2)
    ->setPath('1/2/333')
    ->setLevel(3)
    ->setAvailableSortBy('name')
    ->setDefaultSortBy('name')
    ->setIsActive(true)
    ->setPosition(1)
    ->setAvailableSortBy(['position'])
    ->save();

$category = $objectManager->create(\Magento\Catalog\Model\Category::class);
$category->isObjectNew(true);
$category
    ->setId(335)
    ->setCreatedAt('2014-06-23 09:50:07')
    ->setName('Category with icon')
    ->setParentId(333)
    ->setPath('1/2/333/335')
    ->setLevel(4)
    ->setAvailableSortBy('name')
    ->setDefaultSortBy('name')
    ->setIsActive(true)
    ->setPosition(1)
    ->setAvailableSortBy(['position'])
    ->setIncludeInMenu(0)
    ->setCategoryIcon('icon.png')
    ->save();

$category = $objectManager->create(\Magento\Catalog\Model\Category::class);
$category->isObjectNew(true);
$category
    ->setId(336)
    ->setCreatedAt('2014-06-23 09:50:07')
    ->setName('Category with icon including media path')
    ->setParentId(333)
    ->setPath('1/2/333/335')
    ->setLevel(4)
    ->setAvailableSortBy('name')
    ->setDefaultSortBy('name')
    ->setIsActive(true)
    ->setPosition(1)
    ->setAvailableSortBy(['position'])
    ->setIncludeInMenu(0)
    ->setCategoryIcon('/media/catalog/category/icon.png')
    ->save();

/** @var $mediaDirectory \Magento\Framework\Filesystem\Directory\WriteInterface */
$mediaDirectory = $objectManager->get(\Magento\Framework\Filesystem::class)
    ->getDirectoryWrite(\Magento\Framework\App\Filesystem\DirectoryList::MEDIA);
$fileName = 'magento.jpg';
$fileNameSvg = 'adobe.svg';
$filePath = 'catalog/category/' . $fileName;
$filePathSvg = 'catalog/category/' . $fileNameSvg;
$mediaDirectory->create('catalog/category');

copy(__DIR__ . DIRECTORY_SEPARATOR . $fileName, $mediaDirectory->getAbsolutePath($filePath));
copy(__DIR__ . DIRECTORY_SEPARATOR . $fileNameSvg, $mediaDirectory->getAbsolutePath($filePathSvg));

$category = $objectManager->create(\Magento\Catalog\Model\Category::class);
$category->isObjectNew(true);
$category
    ->setId(337)
    ->setCreatedAt('2014-06-23 09:50:07')
    ->setName('Category with JPG icon')
    ->setParentId(333)
    ->setPath('1/2/333/335')
    ->setLevel(4)
    ->setAvailableSortBy('name')
    ->setDefaultSortBy('name')
    ->setIsActive(true)
    ->setPosition(1)
    ->setAvailableSortBy(['position'])
    ->setIncludeInMenu(0)
    ->setCategoryIcon('/media/catalog/category/magento.jpg')
    ->save();

$category = $objectManager->create(\Magento\Catalog\Model\Category::class);
$category->isObjectNew(true);
$category
    ->setId(338)
    ->setCreatedAt('2014-06-23 09:50:07')
    ->setName('Category with SVG icon')
    ->setParentId(333)
    ->setPath('1/2/333/335')
    ->setLevel(4)
    ->setAvailableSortBy('name')
    ->setDefaultSortBy('name')
    ->setIsActive(true)
    ->setPosition(1)
    ->setAvailableSortBy(['position'])
    ->setIncludeInMenu(0)
    ->setCategoryIcon('/media/catalog/category/adobe.svg')
    ->save();
