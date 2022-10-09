<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Codegenixuk\ImageBlock\Api\Data;

interface ImageBlockSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{

    /**
     * Get ImageBlock list.
     * @return \Codegenixuk\ImageBlock\Api\Data\ImageBlockInterface[]
     */
    public function getItems();

    /**
     * Set Image list.
     * @param \Codegenixuk\ImageBlock\Api\Data\ImageBlockInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}

