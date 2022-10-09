<?php

namespace Codegenixuk\ImageBlock\Block\Widget;

use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\View\Element\Template;
use Magento\Widget\Block\BlockInterface;

class ImageBlock extends Template implements BlockInterface
{
    /**
     * @var string
     */
    protected $_template = "widget/image-block.phtml";
    /**
     * @var \Codegenixuk\ImageBlock\Model\ImageBlock|null
     */
    protected ?\Codegenixuk\ImageBlock\Model\ImageBlock $model = null;
    /**
     * @var \Codegenixuk\ImageBlock\Model\ImageBlockFactory
     */
    private \Codegenixuk\ImageBlock\Model\ImageBlockFactory $imageBlock;

    /**
     * @param Template\Context $context
     * @param \Codegenixuk\ImageBlock\Model\ImageBlockFactory $imageBlock
     * @param \Magento\Store\Model\StoreManagerInterface $storeManager
     * @param array $data
     */
    public function __construct(
        Template\Context $context,
        \Codegenixuk\ImageBlock\Model\ImageBlockFactory $imageBlock,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        array $data = []
    ) {
        $this->imageBlock = $imageBlock;
        $this->_storeManager = $storeManager;

        parent::__construct($context, $data);
    }

    public function getModel($id)
    {
        if (!is_null($this->model)) {
            return $this->model;
        }

        $this->model = $this->imageBlock->create()->load($id);

        return $this->model;
    }


    public function getImage($id)
    {
        $model = $this->getModel($id);
        $file = $model->getImage();
        return $this->getMediaUrl($file);
    }


    public function getContent($id)
    {
        $model = $this->getModel($id);
        return $model->getHtml();
    }


    public function getMediaUrl($file)
    {
        return $this->_storeManager->getStore()
                ->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA) . $file;
    }
}
