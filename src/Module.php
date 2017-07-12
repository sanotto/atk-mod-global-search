<?php
namespace sanotto\atkGlobalSearch;

use Sintattica\Atk\Core\Atk;
use Sintattica\Atk\Core\Tools;
use Sintattica\Atk\Core\Menu;

class Module extends \Sintattica\Atk\Core\Module
{
    static $module = 'Search';

    public function boot()
    {
    	//$this->registerNode('Users',Users::class,['admin', 'add', 'edit', 'delete', 'view']);

		$search_piece ='<input type="text" class="form-control" placeholder="'.Tools::atktext('searchfor', $this->module).'">';
		$search_piece.='<button type="button" class="btn btn-info"> <span class="glyphicon glyphicon-search"></span>&nbsp;'. Tools::atktext('search', $this->module).' </button>';
        $this->getMenu()->addMenuItem($search_piece, null, 'main', true, 0, static::$module, '', 'right');

    }
    
		public function register()
		{
		}

}
?>
