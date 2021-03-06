<?php

namespace sanotto\atkGlobalSearch;

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
		if (empty($search))
		{
			$this->renderBox(Tools::atktext('criterianeeded','Search'), Tools::atktext('Error','Search'));
			return false;
		}

		$atk = Atk::getInstance();
		$nodes_uris = $atk->g_nodesClasses;

        $nodes_uris = array_keys($nodes_uris);
        $results=[];
		foreach($nodes_uris as $node_uri)
        {
            if ($node_uri == "Setup.Setup") continue;

            $node= $atk->atkGetNode($node_uri);
            if(method_exists($node,'searchdescriptor')) continue;

			if (isset($node->m_table))
			{
                $resultset=	$node->searchDb($search);
                if (count($resultset) == 0){
                    $resultset=	$node->searchDb(strtoupper($search));
                }
                if (count($resultset) == 0){
                    $resultset=	$node->searchDb(strtolower($search));
                }

				$links = $this->recLinks($resultset, $node,$node_uri);

				foreach($links as $item)
				{
					//$results[] = Tools::href($item['url'],$item['title']);
					$results[] = $item;
				}
			}
        }
        $contents=Tools::atktext("No results");
        if (count($results)==1){
            $this->redirect($item['url'], true);
        }
        if (count($results)>0){
            $contents='<ul>';
            foreach($results as $result){
			    $link =  Tools::href($item['url'],$item['title']);
                $contents.='<li>'.$link.'</li>';
            }
            $contents.="</ul>";
        }
	    $this->renderBox($contents, Tools::atktext("results for",'Search').': '.$search);

	}

	public function renderBox($content, $title='')
	{
		$ui = $this->getUi();
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
			        $item["url"] = Tools::dispatch_url($nodetype, "view", array("atkselector"=>$node->primaryKey($recordset[$i])));
                    $res[] = $item;
                }
            }
        }
        return $res;
   }
 
}
?>
