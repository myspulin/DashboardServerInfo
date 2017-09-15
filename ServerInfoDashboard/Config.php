<?php

namespace Backend\Modules\ServerInfoDashboard;

/**
 * Dashboard Server Information module
 *
 * @author Lukas Krchnak <lukas.krchnak@uniqueweb.com>
 */

use Backend\Core\Engine\Base\Config as BackendBaseConfig;

/**
 * This is the configuration-object for the Server Information module
 */
class Config extends BackendBaseConfig{

    /**
     * The default action
     *
     * @var string
     */
    protected $defaultAction = 'Index';

    /**
     * The disabled actions
     *
     * @var array
     */
    protected $disabledActions = array();

}