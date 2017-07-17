<?php

namespace sanotto\atkGlobalSearch;
use App\Modules\AtkBuilderNode;
use Sintattica\Atk\Core\Atk;
use Sintattica\Atk\Core\Node;
use Sintattica\Atk\Core\Tools;
use Sintattica\Atk\Attributes\Attribute as A;
use Sintattica\Atk\Attributes\Attribute;
use Sintattica\Atk\Attributes\PasswordAttribute;
use Sintattica\Atk\Attributes\BoolAttribute;


class Search extends Node
{
	public function action_search()
	{
		$search= $this->m_postvars['searchfor'];

		$atk = Atk::getInstance();
		$nodes_uris = $atk->g_nodesClasses;

		unset($nodes_uris['Setup.Setup']);
		unset($nodes_uris['Search.Search']);
		$nodes_uris = array_keys($nodes_uris);
		$contents='<ul>';
		foreach($nodes_uris as $node_uri)
		{
			$node= $atk->atkGetNode($node_uri);
			if (isset($node->m_table))
			{
				$resultset=	$node->searchDb($search);
				$links = $this->recLinks($resultset, $node,$node_uri);

				foreach($links as $item)
				{
					$contents.= '<li>'.Tools::href($item['url'],$item['title']).'</li>';
				}
			}
		}
		$contents.="</ul>";
		$this->renderBox($contents, Tools::atktext("results"));

	}
	public function renderBox($content, $title='')
	{
		$ui = $this->getUi();
		#$output= Tools::href(Tools::dispatch_url("Security.Users", "admin"),"<span class='glyphicon glyphicon-print'></span> ");
		$box =  $ui->renderBox(array(
		'title' => $title,
		'content' => $content,
		));
		$page = $this->getPage();
		$page->addContent($box);
	}	

	function recLinks($recordset, $node, $nodetype)
	{	      
        $res = array();
       
        if ($node->allowed("view"))
        {
			for($i=0, $_i=count($recordset); $i<$_i; $i++)
			{
				if(method_exists($node,'searchdescriptor'))
				{
					$item["title"] = $node->searchdescriptor($recordset[$i]);
				}
				else
				{
					$item["title"] = $node->descriptor($recordset[$i]);
				}
			    $item["url"] = Tools::dispatch_url($nodetype, "view", array("atkselector"=>$node->primaryKey($recordset[$i])));
                $res[] = $item;
            }
        }
        return $res;
   } // end functi
}
?>
