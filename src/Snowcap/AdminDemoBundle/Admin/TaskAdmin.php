<?php
namespace Snowcap\AdminDemoBundle\Admin;

use Snowcap\AdminBundle\Admin\TranslatableContentAdmin;
use Snowcap\AdminDemoBundle\Form\TaskType;
use Snowcap\AdminDemoBundle\Form\TaskTranslationType;

class TaskAdmin extends TranslatableContentAdmin
{
    /**
     * @return \Snowcap\AdminBundle\Datalist\AbstractDatalist
     */
    public function getDatalist()
    {
        $datalist = $this->createDatalist('grid', 'task');
        $datalist
            ->add('id', 'text');
        return $datalist;
    }

    public function getForm($data = null)
    {
        return $this->createForm(new TaskType(), $data);
    }

    public function getTranslationForm($data = null) {
        return $this->createForm(new TaskTranslationType(), $data);
    }


}