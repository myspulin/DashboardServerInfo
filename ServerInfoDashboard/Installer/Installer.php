<?php

namespace Backend\Modules\ServerInfoDashboard\Installer;

/**
 * Installer for Dashboard Server Information module
 *
 * @author Lukas Krchnak <lukas.krchnak@uniqueweb.com>
 */

use Backend\Core\Installer\ModuleInstaller;

/**
 * Installer for the Server Information module
 */
class Installer extends ModuleInstaller
{

    /**
     * Insert an empty admin dashboard sequence
     */
    private function insertWidget(){

        $this->insertDashboardWidget('ServerInfoDashboard', 'ServerInfo');

    }

    /**
     * Install the module
     */
    public function install(){

        // add 'server information' as a module
        $this->addModule('ServerInfoDashboard');

        // import locale
        $this->importLocale(__DIR__ . '/Data/locale.xml');

        // insert dashboard widget
        $this->insertWidget();

    }

}