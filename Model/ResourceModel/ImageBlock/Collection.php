<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Codegenixuk\ImageBlock\Model\ResourceModel\ImageBlock;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{

    /**
     * @inheritDoc
     */
    protected $_idFieldName = 'imageblock_id';

    /**
     * @inheritDoc
     */
    protected function _construct()
    {
        $this->_init(
            \Codegenixuk\ImageBlock\Model\ImageBlock::class,
            \Codegenixuk\ImageBlock\Model\ResourceModel\ImageBlock::class
        );
    }
}

