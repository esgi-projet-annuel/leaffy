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

    public function saveTestimonial()
    {
        var_dump($_POST);
        $testimonial = new Testimonial();
        $data = $_POST; //TODO a supprimer et décommenter ligne de dessus
        if (!empty($data)) {
            $testimonial->setContent($data['content']);
            $testimonial->setUserName($_SESSION['userName']);
            $testimonial->setStatus('PENDING');
            $testimonial->save();
        }

        return var_dump($_POST);
    }

    public function approveTestimonial(): void
    {
        $this->checkAdmin();
        $testimonialId = intval($_POST['testimonialId']);
        $testimonial = new Testimonial();
        $testimonial->findById($testimonialId);
        $data = $_POST;
        if(!empty($data) ){
            $testimonial->setStatus('APPROVED');
            $testimonial->save();
        }
    }

    public function rejectTestimonial(): void
    {
        $this->checkAdmin();
        $testimonialId = intval($_POST['testimonialId']);
        $testimonial = new Testimonial();
        $testimonial->findById($testimonialId);
        $data = $_POST;
        if(!empty($data) ){
            $testimonial->setStatus('REJECTED');
            $testimonial->save();
        }
    }

    public function listPendings(): array {
        //$this->checkAdmin();
        $testimonial = new Testimonial();
        $pendingTestimonials = $testimonial->findAllBy(['status' => 'PENDING']);
        var_dump($pendingTestimonials);
        return $pendingTestimonials;
    }
}
