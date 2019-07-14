<?php
declare(strict_types = 1);

namespace LeaffyMvc\Controllers;

use LeaffyMvc\Core\View;
use LeaffyMvc\Models\Category;
use LeaffyMvc\Core\Validator;

class CategoryController extends AbstractController {

  public function getAllCategory():void {
      $category = new Category();
      $categories = $category->findAllByOrder(['orderBy'=>'name']);
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

  public function deleteCategory(){
      $categoryId = intval($_POST['id']);
      $category = new Category();
      $category->findById($categoryId);
      $category->delete();
  }

}
