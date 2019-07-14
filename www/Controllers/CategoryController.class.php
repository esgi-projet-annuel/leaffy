<?php
declare(strict_types = 1);

namespace LeaffyMvc\Controllers;

use LeaffyMvc\Core\View;
use LeaffyMvc\Models\Category;
use LeaffyMvc\Core\Validator;

class CategoryController extends AbstractController {

  public function getAllCategory():void {
      $status = isset($_GET['status'])?$_GET['status']:'DRAFT';
      $category = new Category();
      $categories = $category->findAllBy(['status'=>$status]); // ????? quelle methode
      $view = new View("categories", "back");
      $view->assign("categories", $categories);
      $form = $category->getCategoryForm();
      $view->assign("formCategory", $form);
  }

  public function saveCategory():void{
      $category = new Category();
      $form = $category->getCategoryForm();

      $method = strtoupper($form["config"]["method"]);
      $data = $GLOBALS["_".$method];
      if( $_SERVER['REQUEST_METHOD']==$method && !empty($data) ) {
          $validator = new Validator($form, $data);
          $form["errors"] = $validator->errors;

          if(empty($form["errors"])){
              $category->setName($data['name']);
              $category->save();
              $this->getAllCategory();
          }else{
              $view = new View("categories", "back");
              $view->assign("formCategory", $form);
          }
      }
  }

}
