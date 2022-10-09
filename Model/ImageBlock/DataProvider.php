<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Codegenixuk\ImageBlock\Model\ImageBlock;

use Codegenixuk\ImageBlock\Model\ResourceModel\ImageBlock\CollectionFactory;
use Magento\Catalog\Model\Category\FileInfo;
use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Framework\App\ObjectManager;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Ui\DataProvider\AbstractDataProvider;

class DataProvider extends AbstractDataProvider
{

    /**
     * @inheritDoc
     */
    protected $collection;

    /**
     * @var DataPersistorInterface
     */
    protected $dataPersistor;

    /**
     * @var array
     */
    protected $loadedData;

    /**
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param CollectionFactory $collectionFactory
     * @param DataPersistorInterface $dataPersistor
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $collectionFactory,
        DataPersistorInterface $dataPersistor,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        FileInfo $fileInfo = null,
        \Magento\Framework\Filesystem $filesystem,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $collectionFactory->create();
        $this->dataPersistor = $dataPersistor;

        $this->_storeManager = $storeManager;

        $this->fileInfo = $fileInfo ?: ObjectManager::getInstance()->get(FileInfo::class);

        $this->_filesystem = $filesystem;

        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    /**
     * @inheritDoc
     */
    public function getData()
    {
        if (isset($this->loadedData)) {
            return $this->loadedData;
        }

        $m = [];

        $items = $this->collection->getItems();
        foreach ($items as $model) {
            $this->loadedData[$model->getId()] = $model->getData();
            if ($model->getImage()) {
                $stat = stat($this->getMediaPath($model->getImage()));
                $name = $model->getImage();
                $tmp = explode('codegenixuk/imageblock/image/', $model->getImage());
                if (isset($tmp[1])) {
                    $name =  $tmp[1];
                }
                $m['image'][0]['name'] = $name;
                $m['image'][0]['url'] = $this->getMediaUrl($model->getImage());
                $m['image'][0]['size'] = $stat['size'];
                $m['image'][0]['type'] = mime_content_type($this->getMediaPath($model->getImage()));
                $fullData = $this->loadedData;
                $this->loadedData[$model->getId()] = array_merge($fullData[$model->getId()], $m);
            }
        }

        $data = $this->dataPersistor->get('codegenixuk_imageblock_imageblock');
        if (!empty($data)) {
            $model = $this->collection->getNewEmptyItem();
            $model->setData($data);
            $this->loadedData[$model->getId()] = $model->getData();
            $this->dataPersistor->clear('codegenixuk_imageblock_imageblock');
        }

        return $this->loadedData;
    }

    /**
     * Retrieve media url
     * @param string $file
     * @return string
     */
    public function getMediaUrl($file)
    {
        return $this->_storeManager->getStore()
                ->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA) . $file;
    }

    public function getMediaPath($file)
    {
        return $this->_filesystem->getDirectoryRead(DirectoryList::MEDIA)->getAbsolutePath() . $file;
    }
}
