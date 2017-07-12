<?php
namespace sanotto\atkGlobalSearch;

use Sintattica\Atk\Core\Atk;
use Sintattica\Atk\Core\Tools;
use Sintattica\Atk\Core\Menu;

class Module_base extends \Sintattica\Atk\Core\Module
{
    static $module = 'Search';

    public function boot()
    {
    	//$this->registerNode('Users',Users::class,['admin', 'add', 'edit', 'delete', 'view']);

		$search='
      <input type="text" class="form-control" placeholder="Search for...">
        <button class="btn btn-default" type="button">Go!</button>
  ';
        $this->getMenu()->addMenuItem($search, null, 'main', true, 0, static::$module, '', 'right');

    }
    
		public function register()
		{
		}

}
?>
