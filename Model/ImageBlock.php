<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Codegenixuk\ImageBlock\Model;

use Codegenixuk\ImageBlock\Api\Data\ImageBlockInterface;
use Magento\Framework\Model\AbstractModel;

class ImageBlock extends AbstractModel implements ImageBlockInterface
{

    /**
     * @inheritDoc
     */
    public function _construct()
    {
        $this->_init(\Codegenixuk\ImageBlock\Model\ResourceModel\ImageBlock::class);
    }

    /**
     * @inheritDoc
     */
    public function getImageblockId()
    {
        return $this->getData(self::IMAGEBLOCK_ID);
    }

    /**
     * @inheritDoc
     */
    public function setImageblockId($imageblockId)
    {
        return $this->setData(self::IMAGEBLOCK_ID, $imageblockId);
    }

    /**
     * @inheritDoc
     */
    public function getImage()
    {
        return $this->getData(self::IMAGE);
    }

    /**
     * @inheritDoc
     */
    public function setImage($image)
    {
        return $this->setData(self::IMAGE, $image);
    }

    /**
     * @inheritDoc
     */
    public function getHtml()
    {
        return $this->getData(self::HTML);
    }

    /**
     * @inheritDoc
     */
    public function setHtml($html)
    {
        return $this->setData(self::HTML, $html);
    }
}

