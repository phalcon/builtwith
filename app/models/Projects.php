<?php

use Phalcon\Paginator\Adapter\NativeArray;

/**
 * Project model
 *
 * @author Ole Aass <ole.aass@gmx.com>
 */
class Projects
{
    /**
     * Array holding all projects
     * @access public
     * @var array
     */
    public $projects;

    /**
     * Fields allowed to sort on
     * @access public
     * @var string
     */
    public $sortFields = ['name', 'submissionDate'];

    /**
     * Class constructor
     *
     * Reads the projects.json file and saves the data to the object scope
     *
     * @access public
     * @return void
     *
     * @author Ole Aass <ole.aass@gmx.com>
     */
    public function __construct()
    {
        $config = \Phalcon\DI::getDefault()->getConfig();
        $projects = file_get_contents($config->application->varDir . '/projects.json');
        $projects = json_decode($projects, true);
        $this->featured = $projects['featured'];
        $this->projects = $projects['projects'];
    }

    /**
     * Find all projects
     *
     * @param string $sort Field name to sort the output on
     *
     * @access public
     * @return array
     *
     * @author Ole Aass <ole.aass@gmx.com>
     */
    public function findAll($sort = 'submissionDate')
    {
        $sort = (in_array($sort, $this->sortFields)) ? $sort : 'name';
        return $this->sortBy($this->projects, $sort);
    }

    /**
     * Get a list of tags
     *
     * @access public
     * @return array
     *
     * @author Ole Aaas <ole.aass@gmx.com>
     */
    public function getTags()
    {
        $tags = [];
        foreach ($this->projects as $project) {
            $tags = array_merge($tags, array_flip($project['tags']));
        }
        $tags = array_keys($tags);
        sort($tags);
        return $tags;
    }

    /**
     * Find projects by tags
     *
     * @param array $tags Array of tags
     * @param string $sort Field name to sort the result on
     *
     * @access public
     * @return array
     *
     * @author Ole Aass <ole.aass@gmx.com>
     */
    public function findByTags($tags, $sort = 'submissionDate')
    {
        if (empty($tags)) {
            return $this->findAll($sort);
        }
        $projects = [];
        foreach ($tags as $tag) {
            foreach ($this->projects as $project) {
                if (in_array($tag, $project['tags'])) {
                    $projects[$project['name']] = $project;
                }
            }
        }

        $sort = (in_array($sort, $this->sortFields)) ? $sort : 'name';

        $projects = $this->sortBy($projects, $sort);
        return $this->sortBy($projects, $sort);
    }

    /**
     * Sort array of projects
     *
     * @param array $projects Array of projects
     * @param string $sort Field to sort the array on
     *
     * @access public
     * @return array
     *
     * @author Ole Aass <ole.aass@gmx.com>
     */
    public function sortBy($projects, $sort)
    {
        usort($projects, function($a, $b) use ($sort) {
            if ($sort == 'submissionDate') {
                return ($a[$sort] > $b[$sort]) ? -1 : 1;
            } else {
                return ($a[$sort] - $b[$sort]);
            }
        });

        return $projects;
    }

    /**
     * Find a project by permalink
     *
     * @param string $permalink Project permalink
     *
     * @access public
     * @return array|boolean
     *
     * @author Ole Aass <ole.aass@gmx.com>
     */
    public function findByPermalink($permalink)
    {
        foreach ($this->projects as $key => $project) {
            if ($project['permalink'] == $permalink) {
                $project = $this->projects[$key];
                sort($project['tags']);
                return $project;
            }
        }

        return false;
    }

    /**
     * Find featured projects
     *
     * @access public
     * @return array
     *
     * @author Ole Aass <ole.aass@gmx.com>
     */
    public function findFeatured()
    {
        $featured = [];
        foreach ($this->projects as $key => $project) {
            if (in_array($project['permalink'], $this->featured)) {
                $featured[] = $project;
            }
        }
        return $featured;
    }


    /**
     * Paginate results
     *
     * @access public
     * @return array
     *
     * @author Christian Esperar <christianesperar@gmail.com>
     */
    public function paginate($list, $currentPage, $limit = 10)
    {
        //Passing an array as data
        $paginator = new NativeArray(
            array(
                "data"  => $list,
                "limit" => $limit,
                "page"  => $currentPage,
            )
        );

        // Return the paginated results
       return $paginator->getPaginate();
    }
}