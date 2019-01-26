<?php

class StaticController {

    public function showHomePage(){
        $view = new View("home", "front");
    }

    public function showAboutPage(){
        $view = new View("about", "front");
    }

    public function showContactPage(){
        $view = new View("contact", "front");
    }

    public function showBlogPage(){
        $view = new View("blog", "front");
    }
}