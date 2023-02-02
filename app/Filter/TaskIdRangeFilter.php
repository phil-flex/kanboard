<?php

namespace Kanboard\Filter;

use Kanboard\Core\Filter\FilterInterface;
use Kanboard\Model\TaskModel;

/**
 * Filter tasks by due date range
 *
 * @package filter
 * @author  Frederic Guillot
 */
class TaskIdRangeFilter extends BaseFilter implements FilterInterface
{
    /**
     * Get search attribute
     *
     * @access public
     * @return string[]
     */
    public function getAttributes()
    {
        return array();
    }

    /**
     * Apply filter
     *
     * @access public
     * @return FilterInterface
     */
    public function apply()
    {
        $this->query->beginOr();
        $this->query->isNull(TaskModel::TABLE.'.id');
        $this->query->eq(TaskModel::TABLE.'.id', 0);
        $this->query->closeOr();

        $this->query->gte(TaskModel::TABLE.'.id', $this->value[0]);
        $this->query->lte(TaskModel::TABLE.'.id', $this->value[1]);
        return $this;
    }
}
