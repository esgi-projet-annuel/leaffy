<?php

declare(strict_types = 1);

class SettingsController {

    public function default():void{
        $user = new User();
        $form = $user->getRegisterForm();
        $view = new View('settings', 'back');
        $view->assign('form', $form);
    }
}
