<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Codegenixuk\ImageBlock\Api\Data;

interface ImageBlockInterface
{

    const IMAGEBLOCK_ID = 'imageblock_id';
    const IMAGE = 'Image';
    const HTML = 'Html';

    /**
     * Get imageblock_id
     * @return string|null
     */
    public function getImageblockId();

    /**
     * Set imageblock_id
     * @param string $imageblockId
     * @return \Codegenixuk\ImageBlock\ImageBlock\Api\Data\ImageBlockInterface
     */
    public function setImageblockId($imageblockId);

    /**
     * Get Image
     * @return string|null
     */
    public function getImage();

    /**
     * Set Image
     * @param string $image
     * @return \Codegenixuk\ImageBlock\ImageBlock\Api\Data\ImageBlockInterface
     */
    public function setImage($image);

    /**
     * Get Html
     * @return string|null
     */
    public function getHtml();

    /**
     * Set Html
     * @param string $html
     * @return \Codegenixuk\ImageBlock\ImageBlock\Api\Data\ImageBlockInterface
     */
    public function setHtml($html);
}

