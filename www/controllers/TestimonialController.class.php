<?php

namespace LeaffyMvc\Controllers;

use LeaffyMvc\Models\Testimonial ;
use LeaffyMvc\Core\View;
use LeaffyMvc\Core\Validator;

class TestimonialController extends AbstractController
{
    public function getTestimonialForm(): array{
        $testimonial = new Testimonial();
        $form = $testimonial->getTestimonialForm();
        $method = strtoupper($form["config"]["method"]);
        $data = $GLOBALS["_".$method];
        if( $_SERVER['REQUEST_METHOD']==$method && !empty($data) ) {
            $validator = new Validator($form, $data);
            $form["errors"] = $validator->errors;
            if(empty($form["errors"])){
                $form["errors"][] ="Merci pour votre avis!  ";
            }
        }
        return $form;
    }

//    public function viewTestimonialList():void {
//        $view = new View('testimonials', 'back');
//    }

    public function saveTestimonial():void{
        $testimonial = new Testimonial();
        $form = $testimonial->getTestimonialForm();

        $method = strtoupper($form["config"]["method"]);
        $data = $GLOBALS["_".$method];
        if( $_SERVER['REQUEST_METHOD']==$method && !empty($data) ) {
            $validator = new Validator($form, $data);
            $form["errors"] = $validator->errors;

            if(empty($form["errors"])){
                $testimonial->setContent($data['content']);
                $testimonial->setUserName($data['userName']);
                $testimonial->setStatus('PENDING');
                $testimonial->save();
                $form["errors"][] ="Merci pour votre avis!  ";
            }
            $view = new View("home", "front");
            $view->assign("formTestimonial", $form);
        }
    }

    public function approveTestimonial(): void
    {
        $data = $_POST;
        if(!empty($data) ){
            $testimonialId = intval($data['id']);
            $testimonial = new Testimonial();
            $testimonial->findById($testimonialId);
            $testimonial->setStatus('APPROVED');
            $testimonial->save();
        }
    }

    public function rejectTestimonial(): void
    {
        $data = $_POST;
        if(!empty($data) ){
        $testimonialId = intval($data['id']);
        $testimonial = new Testimonial();
        $testimonial->findById($testimonialId);
            $testimonial->setStatus('REJECTED');
            $testimonial->save();
        }
    }

    public function listTestimonialsByStatus():void {
        //$this->checkAdmin();
        $status = isset($_GET['status'])?$_GET['status']:'PENDING';
        $testimonial = new Testimonial();
        $testimonials = $testimonial->findAllBy(['status' => $status]);
        $view = new View("testimonials", "back");
        $view->assign("testimonials", $testimonials);
    }

}
