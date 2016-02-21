<?php

namespace Lowtech\NewsBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class NewsAdmin extends Admin
{
    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id')
            ->add('name')
            ->add('image')
            ->add('description')
            ->add('recommended')
            ->add('enabled')
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id')
            ->add('name')
            ->add('image', 'string', array(
                'template' => 'LowtechNewsBundle::sonata_news_list_image.html.twig',
            ))

            ->add('description')
            ->add('recommended')
            ->add('enabled')
            ->add('_action', 'actions', array(
                'actions' => array(
                    'show' => array(),
                    'edit' => array(),
                    'delete' => array(),
                )
            ))
        ;
    }

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        // get the current entity instance
        $news = $this->getSubject();

        $fileFieldOptions = array('required' => false);
        if ($news && ($webPath = $news->getWebPath())) {
            $container = $this->getConfigurationPool()->getContainer();
            $fullPath = $container->get('request')->getBasePath().'/'.$webPath;

            $fileFieldOptions['help'] = '<img src="'.$fullPath.'" class="admin-preview" width="200px" />';
        }

        $formMapper
            //->add('id')
            ->add('news_type_id')
            ->add('name')
            ->add('file', 'file', $fileFieldOptions)
            ->add('description')
            ->add('start_at', 'sonata_type_datetime_picker', array('required' => false))
            ->add('end_at', 'sonata_type_datetime_picker', array('required' => false))
            ->add('recommended')
            ->add('enabled')
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('id')
            ->add('name')
            ->add('file')
            ->add('recommended')
            ->add('description')
            ->add('enabled')
        ;
    }

    public function prePersist($image)
    {
        $this->manageFileUpload($image);
    }

    public function preUpdate($image)
    {
        $this->manageFileUpload($image);
    }

    private function manageFileUpload($image)
    {
        if ($image->getFile()) {
            //$image->refreshUpdated();
            $image->preUpdate();
        }
    }

}
