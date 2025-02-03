<?php

namespace App\Controllers;

class Home extends BaseController {

    protected $validation;
    protected $session;

    public function __construct()
    {
        $this->validation = \Config\Services::validation();
        $this->session = \Config\Services::session();
    }

    /**
     * @description This method provides home page view
     * @return void
     */
    public function index(){
        $settings = get_settings();
        $theme = $settings['Theme'];



        $data['home_menu'] = true;
        $data['theme'] = $theme;

        $data['keywords'] = $settings['meta_keyword'];
        $data['description'] = $settings['meta_description'];
        $data['title'] = !empty($settings['meta_title'])?$settings['meta_title']:$settings['store_name'];

        echo view('Theme/'.$settings['Theme'].'/header',$data);
        echo view('Theme/'.$settings['Theme'].'/Home/index',$data);
        echo view('Theme/'.$settings['Theme'].'/footer');
    }

    /**
     * @description This method provides default theme function
     * @return array
     */
    private function Default(){
        $theme_settings = get_theme_settings();
        $data = '';

        return $data;
    }



    /**
     * @description This method provides user subscription store
     * @return void
     */
    public function user_subscribe(){
        $email = $this->request->getPost('email');

        if (!empty($email)){
            if(is_exists('nb_newsletter','email',$email) == true) {
                $newData['email'] = $email;
                $newAd = DB()->table('nb_newsletter');
                $newAd->insert($newData);

                print "Thank you.Your subscription has been successfully completed";

                $subject = 'Subscription';
                $message = "Thank you.Your subscription has been successfully completed";
//            email_send($email,$subject,$message);
            }else{
                print 'Your email already exists';
            }
        }else{
            print 'Email required';
        }
    }


}
