<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Codegenixuk\ImageBlock\Api;

use Magento\Framework\Api\SearchCriteriaInterface;

interface ImageBlockRepositoryInterface
{

    /**
     * Save ImageBlock
     * @param \Codegenixuk\ImageBlock\Api\Data\ImageBlockInterface $imageBlock
     * @return \Codegenixuk\ImageBlock\Api\Data\ImageBlockInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(
        \Codegenixuk\ImageBlock\Api\Data\ImageBlockInterface $imageBlock
    );

    /**
     * Retrieve ImageBlock
     * @param string $imageblockId
     * @return \Codegenixuk\ImageBlock\Api\Data\ImageBlockInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function get($imageblockId);

    /**
     * Retrieve ImageBlock matching the specified criteria.
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Codegenixuk\ImageBlock\Api\Data\ImageBlockSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
    );

    /**
     * Delete ImageBlock
     * @param \Codegenixuk\ImageBlock\Api\Data\ImageBlockInterface $imageBlock
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(
        \Codegenixuk\ImageBlock\Api\Data\ImageBlockInterface $imageBlock
    );

    /**
     * Delete ImageBlock by ID
     * @param string $imageblockId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($imageblockId);
}

