<?php

declare(strict_types = 1);

class MenuController {

    public function default():void{
        $view = new View("setMenus", "back");
    }

    public function generateMenu():string {
        $str="";
        $listId= 1;
        $page= new Page();
        $pageList= $page->findAllBy(['menu_id'=>0]);
        foreach ($pageList as $pageForMenu=>$value) {
            $str.= <<<EOF
               <li id="menu-item-$listId" class="menu-item menu-item-type-custom menu-item-object-custom current-menu-item current_page_item menu-item-home menu-item-16">
                   <a href="/?page=$value->id"> $value->title</a>
               </li> 
EOF;
         ++$listId;
        }
        return $str;
    }
}