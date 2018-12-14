<?php
namespace Lowtech\NewsBundle\Listener;

use Symfony\Component\HttpKernel\KernelInterface;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Lowtech\NewsBundle\Entity\News;

class NewsEntityListener
{
    protected $kernel;

    /**
     * Constructor
     *
     * @param KernelInterface $kernel A kernel instance
     */
    public function __construct(KernelInterface $kernel)
    {
        $this->kernel = $kernel;
    }

    /**
     * On Post Load
     * This method will be trigerred once an entity gets loaded
     *
     * @param LifecycleEventArgs $args Doctrine event
     */
    public function postLoad(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();

        #if(!method_exists($entity, 'setKernel')) {
        #    return;
        #}
        if (!($entity instanceof News)) {
            return;
        }

        $entity->setKernel($this->kernel);
      
    }
}
