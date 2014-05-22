<?php

/**
 * @uses Phalcon\Mvc\Controller
 */
use Phalcon\Mvc\Controller;

/**
 * Index controller
 *
 * @author Ole Aass <ole@oleaass.com>
 */
class IndexController extends Controller
{
    /**
     * Index action
     *
     * @access public
     * @return void
     *
     * @author Ole Aass <ole@oleaass.com>
     */
    public function indexAction()
    {
        $projects = new Projects();
        $this->view->setVar('projects', $projects->findAll());
        $this->view->setVar('tags', $projects->getTags());
    }

    /**
     * Filter action
     *
     * This action is called through ajax on filter change like tags & order
     *
     * @access public
     * @return void
     *
     * @author Ole Aass <ole@oleaass.com>
     */
    public function filterAction()
    {
        if ($this->request->isPost() && $this->request->isAjax()) {
            $tags = $this->request->getPost('tags');
            $projects = new Projects();

            if (empty($tags)) {
                $list = $projects->findAll();
            } else {
                $tags = array_keys($tags);
                $list = $projects->findByTags($tags);
            }

            $this->view->setVar('projects', $list);
            $this->view->partial('index/projects');
        }
    }
}