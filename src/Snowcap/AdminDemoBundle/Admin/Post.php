<?php
namespace Snowcap\AdminDemoBundle\Admin;

use
Snowcap\AdminBundle\Admin\Content,
Snowcap\AdminBundle\Grid\Content as ContentGrid,
Snowcap\AdminBundle\Form\ContentType;

class Post extends Content
{

    public function getContentQueryBuilder()
    {
        return $this->environment->get('doctrine')->getEntityManager()->createQueryBuilder()
            ->select('p')
            ->from('SnowcapAdminDemoBundle:Post', 'p');
    }

    public function getContentGrid()
    {
        $grid = new ContentGrid('post');
        $grid->setQueryBuilder($this->getContentQueryBuilder());
        $grid->add('title');
        $grid->addAction('content_update', array('code' => 'posts'));
        return $grid;
    }

    public function getContentType($data)
    {

    }
}