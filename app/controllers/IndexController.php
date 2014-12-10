<?php

/**
 * @uses Phalcon\Mvc\Controller
 */
use Phalcon\Mvc\Controller;

/**
 * Index controller
 *
 * @author Ole Aass <ole.aass@gmx.com>
 */
class IndexController extends Controller
{
    /**
     * Initialize controller
     *
     * Handles required tasks and sets view variables used several places
     *
     * @access public
     * @return void
     *
     * @author Ole Aass <ole.aass@gmx.com>
     */
    public function initialize()
    {
        $this->view->setVar('cdn', $this->config->application->cdnUrl);
    }

    /**
     * Index action
     *
     * @access public
     * @return void
     *
     * @author Ole Aass <ole.aass@gmx.com>
     */
    public function indexAction()
    {
        $projects = new Projects();

        $currentPage = $this->request->getQuery('page', 'int');

        // The data set to paginate
        $list = $projects->findAll();

        $page = $projects->paginate($list, $currentPage, 10);
        $page->counter = 10;

        $this->view->setVar('page', $page);
        $this->view->setVar('featured', $projects->findFeatured());
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
     * @author Ole Aass <ole.aass@gmx.com>
     */
    public function filterAction()
    {
        if ($this->request->isPost() && $this->request->isAjax()) {
            $tags        = $this->request->getPost('tags');
            $currentPage = $this->request->getPost('page', 'int');
            $counter     = $this->request->getPost('counter', 'int');

            $projects = new Projects();

            if (empty($tags)) {
                $list = $projects->findAll();
            } else {
                $tags = array_keys($tags);
                $list = $projects->findByTags($tags);
            }

            $page          = $projects->paginate($list, $currentPage, $counter);
            $page->counter = $counter;

            $this->view->setVar('page', $page);
            $this->view->partial('index/projects');
        }
    }

    /**
     * Project profile
     *
     * Display all information about a project
     *
     * @access public
     * @return void
     *
     * @author Ole Aass <ole.aass@gmx.com>
     */
    public function profileAction($permalink)
    {
        $projects = new Projects();
        $project = $projects->findByPermalink($permalink);

        if (!$project) {
            return $this->view->pick('errors/404');
        } else {
            $this->view->setVar('project', $project);
        }
    }
}