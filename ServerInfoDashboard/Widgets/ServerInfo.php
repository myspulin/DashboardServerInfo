<?php

namespace Backend\Modules\ServerInfoDashboard\Widgets;

/**
 * Dashboard Server Information module
 *
 * @author Lukas Krchnak <lukas.krchnak@uniqueweb.com>
 */

use Backend\Core\Engine\Base\Widget as BackendBaseWidget;
use Backend\Core\Engine\Model as BackendModel;

/**
 * This widget will show the hosting information
 */
class ServerInfo extends BackendBaseWidget
{

    /**
     * @var Database connection
     */
    private $dbConnection;

    /**
     * Hosting data
     *
     * @var array
     */
    private $hostingData;

    /**
     * Execute the widget
     */
    public function execute(){

        $this->setColumn('middle');
        $this->setPosition(0);
        $this->loadData();
        $this->parse();
        $this->display();

    }

    /**
     * Load the data
     */
    private function loadData(){

        $em = BackendModel::getContainer()->get('doctrine');
        $this->dbConnection = $em->getConnection();
        $versionDb = $this->getDbVersion();

        $this->hostingData = array(

            'version' => array(
                'php' => phpversion(),
                'server' => $_SERVER['SERVER_SOFTWARE']
            ),

            'php' => array(
                'memory_limit' => ini_get('memory_limit'),
                'max_execution_time' => ini_get('max_execution_time'),
                'upload_max_filesize' => ini_get('upload_max_filesize')
            ),

            'database' => array(
                'version' => $versionDb['version_comment'] . ' ' . $versionDb['version'],
                'host' => $this->dbConnection->getHost(),
                'name' => $this->dbConnection->getDatabase(),
                'user' => $this->dbConnection->getUserName(),
                'driver' => $this->dbConnection->getDriver()->getName(),
            ),

            'uname' => function_exists('php_uname') ? php_uname('s').' '.php_uname('v').' '.php_uname('m') : '',
            
        );

    }

    /**
     * Parse into template
     */
    private function parse(){

        $this->tpl->assign('hostingData', $this->hostingData);

    }

    /**
     * @return mixed
     */
    private function getDbVersion(){

        return $this->dbConnection->executeQuery('SHOW VARIABLES LIKE "%version%"')->fetchAll(\PDO::FETCH_KEY_PAIR);

    }

}