<?php
namespace sanotto\atkGlobalSearch;

use Sintattica\Atk\Core\Atk;
use Sintattica\Atk\Core\Tools;
use Sintattica\Atk\Session\SessionManager;
use Sintattica\Atk\Core\Menu;

class Module extends \Sintattica\Atk\Core\Module
{
    static $module = 'Search';

    public function boot()
    {
    	//$this->registerNode('Users',Users::class,['admin', 'add', 'edit', 'delete', 'view']);
		$sm = SessionManager::getInstance();
        $sessionstatus = SessionManager::SESSION_DEFAULT;
		$text='<span class="glyphicon glyphicon-search"></span>&nbsp;'. Tools::atktext('search', $this->module);
		$submit_button = '<button type="submit" class="btn btn-info">'.$text.'</button>';

		#$search_piece = '<table style="vertical-align:sub"><tr><td>';
        $search_piece.= '<form method="post" name="entryform"  class="navbar-form navbar-right form-inline" >';
        $search_piece.= '<div class="form-group">';
        $search_piece.= $sm->formState();
		$search_piece.='<input type="hidden" name="atknodeuri" value="Search.Search">';
		$search_piece.='<input type="hidden" name="atkaction" value="search">';
		$search_piece.='<input type="text" name="searchfor" class="form-control" placeholder="'.Tools::atktext('searchfor', $this->module).'">';
        $search_piece.= $submit_button;
        $search_piece.= '</div>';
		$search_piece.= '</form>';

        $this->getMenu()->addMenuItem($search_piece,null , 'main', true, 0, static::$module, '', 'right',true);
    	$this->registerNode('Search',Search::class,['search']);

    }
    
		public function register()
		{
		}

}
?>
