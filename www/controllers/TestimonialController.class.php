<?php

namespace LeaffyMvc\Controllers;

use LeaffyMvc\Models\Testimonial ;
use LeaffyMvc\Core\View;

class TestimonialController extends AbstractController
{
    public function viewTestimonialForm(): void{
        $testimonial = new Testimonial();
        $form = $testimonial->getTestimonialForm();
        $view = new View('home', 'front');
        $view->assign("formTestimonial", $form);
    }

    public function viewTestimonialList():void {
        $view = new View('testimonials', 'back');
    }

    public function saveTestimonial()
    {
        $testimonial = new Testimonial();
        $form = $testimonial->getTestimonialForm();

        $method = strtoupper($form["config"]["method"]);
        $data = $GLOBALS["_".$method];
        if (!empty($data)) {
            $testimonial->setContent($data['content']);
            $testimonial->setUserName($data['userName']);
            $testimonial->setStatus('PENDING');
            $testimonial->save();
            $form["errors"][] ="Merci pour votre avis!  ";
        }

        $view = new View("home", "front");
        $view->assign("formTestimonial", $form);
    }

    public function approveTestimonial(): void
    {
        $this->checkAdmin();
        $testimonialId = intval($_POST['id']);
        $testimonial = new Testimonial();
        $testimonial->findById($testimonialId);
        var_dump($testimonial);
        $data = $_POST;
        if(!empty($data) ){
            $testimonial->setStatus('APPROVED');
            $testimonial->save();
        }
    }

    public function rejectTestimonial(): void
    {
        $this->checkAdmin();
        $data = $_POST;
        if(!empty($data) ){
        $testimonialId = intval($_POST['id']);
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
