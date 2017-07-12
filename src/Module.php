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
		$sm = SessionManager::getInstance();
        $sessionstatus = SessionManager::SESSION_DEFAULT;
		$url=Tools::dispatch_url('Search.Search','search');
        $script = 'atkSubmit("'.self::atkurlencode($sm->sessionUrl($url, $sessionstatus)).'")';
		$text='<span class="glyphicon glyphicon-search"></span>&nbsp;'. Tools::atktext('search', $this->module);

        $button = '<input type="button" class="btn btn-info"  value="'.$text.'" onClick=\''.$script.'\'>';
		$search_piece = '';
        $search_piece.= '<form name="entryform">';
        $search_piece.= $sm->formState();
		$search_piece.='<input type="text" class="form-control" placeholder="'.Tools::atktext('searchfor', $this->module).'">';
        $search_piece.= $button;
        $search_piece.= '</form>';
        $this->getMenu()->addMenuItem($search_piece, null, 'main', true, 0, static::$module, '', 'right');

    }
    
		public function register()
		{
		}

}
?>
