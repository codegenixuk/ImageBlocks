<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Codegenixuk\ImageBlock\Model;

use Codegenixuk\ImageBlock\Api\Data\ImageBlockInterface;
use Codegenixuk\ImageBlock\Api\Data\ImageBlockInterfaceFactory;
use Codegenixuk\ImageBlock\Api\Data\ImageBlockSearchResultsInterfaceFactory;
use Codegenixuk\ImageBlock\Api\ImageBlockRepositoryInterface;
use Codegenixuk\ImageBlock\Model\ResourceModel\ImageBlock as ResourceImageBlock;
use Codegenixuk\ImageBlock\Model\ResourceModel\ImageBlock\CollectionFactory as ImageBlockCollectionFactory;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;

class ImageBlockRepository implements ImageBlockRepositoryInterface
{

    /**
     * @var ResourceImageBlock
     */
    protected $resource;

    /**
     * @var ImageBlockCollectionFactory
     */
    protected $imageBlockCollectionFactory;

    /**
     * @var ImageBlockInterfaceFactory
     */
    protected $imageBlockFactory;

    /**
     * @var ImageBlock
     */
    protected $searchResultsFactory;

    /**
     * @var CollectionProcessorInterface
     */
    protected $collectionProcessor;


    /**
     * @param ResourceImageBlock $resource
     * @param ImageBlockInterfaceFactory $imageBlockFactory
     * @param ImageBlockCollectionFactory $imageBlockCollectionFactory
     * @param ImageBlockSearchResultsInterfaceFactory $searchResultsFactory
     * @param CollectionProcessorInterface $collectionProcessor
     */
    public function __construct(
        ResourceImageBlock $resource,
        ImageBlockInterfaceFactory $imageBlockFactory,
        ImageBlockCollectionFactory $imageBlockCollectionFactory,
        ImageBlockSearchResultsInterfaceFactory $searchResultsFactory,
        CollectionProcessorInterface $collectionProcessor
    ) {
        $this->resource = $resource;
        $this->imageBlockFactory = $imageBlockFactory;
        $this->imageBlockCollectionFactory = $imageBlockCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->collectionProcessor = $collectionProcessor;
    }

    /**
     * @inheritDoc
     */
    public function save(ImageBlockInterface $imageBlock)
    {
        try {
            $this->resource->save($imageBlock);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__(
                'Could not save the imageBlock: %1',
                $exception->getMessage()
            ));
        }
        return $imageBlock;
    }

    /**
     * @inheritDoc
     */
    public function get($imageBlockId)
    {
        $imageBlock = $this->imageBlockFactory->create();
        $this->resource->load($imageBlock, $imageBlockId);
        if (!$imageBlock->getId()) {
            throw new NoSuchEntityException(__('ImageBlock with id "%1" does not exist.', $imageBlockId));
        }
        return $imageBlock;
    }

    /**
     * @inheritDoc
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $criteria
    ) {
        $collection = $this->imageBlockCollectionFactory->create();
        
        $this->collectionProcessor->process($criteria, $collection);
        
        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($criteria);
        
        $items = [];
        foreach ($collection as $model) {
            $items[] = $model;
        }
        
        $searchResults->setItems($items);
        $searchResults->setTotalCount($collection->getSize());
        return $searchResults;
    }

    /**
     * @inheritDoc
     */
    public function delete(ImageBlockInterface $imageBlock)
    {
        try {
            $imageBlockModel = $this->imageBlockFactory->create();
            $this->resource->load($imageBlockModel, $imageBlock->getImageblockId());
            $this->resource->delete($imageBlockModel);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__(
                'Could not delete the ImageBlock: %1',
                $exception->getMessage()
            ));
        }
        return true;
    }

    /**
     * @inheritDoc
     */
    public function deleteById($imageBlockId)
    {
        return $this->delete($this->get($imageBlockId));
    }
}

