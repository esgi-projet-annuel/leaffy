<?php
declare(strict_types = 1);

namespace LeaffyMvc\Controllers;

use LeaffyMvc\Core\View;
use LeaffyMvc\Models\Page;

class MenuController extends AbstractController {

    public function default():void{
        $view = new View("setMenus", "back");
    }

    function cmp($a, $b)
    {
        return $a['menu_position'] - $b['menu_position'];
    }

    public function generatePageSlug($pageTitle): string {
        return str_replace(" ", "_", $pageTitle);
    }

    public function generateMenu():string {
        $str="";
        $listId= 1;
        $page= new Page();
        $pageList= $page->findAllBy(['menu_id'=>0, 'status'=>'PUBLISHED']);

        usort($pageList, function($first,$second){
            return $first->menu_position > $second->menu_position;
        });
        
        foreach ($pageList as $pageForMenu=>$value) {
            $slug = $this->generatePageSlug($value->title);
            $str.= <<<EOF
               <li id="menu-item-$listId" class="menu-item menu-item-type-custom menu-item-object-custom current-menu-item current_page_item menu-item-home menu-item-16">
                   <a href="/$slug"> $value->title</a>
               </li> 
EOF;
         ++$listId;
        }
        return $str;
    }
}
