<?php

namespace App\Controllers;

class Gallery extends BaseController {

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
    public function detail($album_id){
        $settings = get_settings();
        $theme = $settings['Theme'];

        $table = DB()->table('nb_album');
        $data['gallery'] = $table->where('album_id',$album_id)->get()->getRow();

        $tableDetail = DB()->table('nb_album_details');
        $data['detail'] = $tableDetail->where('album_id',$album_id)->get()->getResult();


        $data['home_menu'] = true;
        $data['theme'] = $theme;

        $data['keywords'] = $settings['meta_keyword'];
        $data['description'] = $settings['meta_description'];
        $data['title'] = !empty($settings['meta_title'])?$settings['meta_title']:$settings['store_name'];

        echo view('Theme/'.$settings['Theme'].'/header',$data);
        echo view('Theme/'.$settings['Theme'].'/Gallery/view',$data);
        echo view('Theme/'.$settings['Theme'].'/footer');
    }




}
