<?php

/**
 * Project model
 *
 * @author Ole Aass <ole@oleaass.com>
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
     * @author Ole Aass <ole@oleaass.com>
     */
    public function __construct()
    {
        $projects = file_get_contents(__DIR__ . '/../../public/projects/projects.json');
        $projects = json_decode($projects, true);

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
     * @author Ole Aass <ole@oleaass.com>
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
     * @author Ole Aaas <ole@oleaass.com>
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
     * @author Ole Aass <ole@oleaass.com>
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
     * @author Ole Aass <ole@oleaass.com>
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
}