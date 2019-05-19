<?php

namespace Hotfix\Datatables\Engines;

/**
 * Laravel Datatables Eloquent Engine
 *
 * @package  Laravel
 * @category Package
 * @author   Frédéric Le Barzic <fred@lebarzic.fr>
 */

use Illuminate\Database\Eloquent\Builder;
use Hotfix\Datatables\Contracts\DataTableEngineContract;
use Hotfix\Datatables\Request;

class EloquentEngine extends QueryBuilderEngine implements DataTableEngineContract
{
    /**
     * @param mixed $model
     * @param \Hotfix\Datatables\Request $request
     */
    public function __construct($model, Request $request)
    {
        $this->query = $model instanceof Builder ? $model : $model->getQuery();
        $this->init($request, $this->query->getQuery(), 'eloquent');
    }
}
