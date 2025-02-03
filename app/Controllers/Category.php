<?php

namespace App\Controllers;

use App\Libraries\Filter;
use App\Models\CategoryproductsModel;
use CodeIgniter\HTTP\RedirectResponse;

class Category extends BaseController {

    protected $validation;
    protected $session;
    protected $filter;
    protected $categoryproductsModel;

    public function __construct()
    {
        $this->validation = \Config\Services::validation();
        $this->session = \Config\Services::session();
        $this->categoryproductsModel = new CategoryproductsModel();
        $this->filter = new Filter();
    }

    /**
     * @description This method provides category page view.
     * @param int $cat_id
     * @return void
     */
    public function index($slug){
        $settings = get_settings();





        $data['keywords'] = $settings['meta_keyword'];
        $data['description'] = $settings['meta_description'];
        $data['title'] = $slug;



        $data['page_title'] = $slug;
        echo view('Theme/'.$settings['Theme'].'/header',$data);
        echo view('Theme/'.$settings['Theme'].'/Category/index',$data);
        echo view('Theme/'.$settings['Theme'].'/footer', $data);
    }

    /**
     * @description This method provides search url generate and redirect.
     * @return RedirectResponse
     */
    public function url_generate(){

        $prod_cat_id = $this->request->getPost('prod_cat_id');
        $cat = $this->request->getPost('cat');
        $shortBy = $this->request->getPost('shortBy');
        $category = $this->request->getPost('category');
        $options = $this->request->getPost('options[]');
        $brand = $this->request->getPost('manufacturer[]');
        $rating = $this->request->getPost('rating[]');
        $price = $this->request->getPost('price');
        $show = $this->request->getPost('show');
        $global_search = $this->request->getPost('global_search');

        $category_cookie = isset($_COOKIE['category_cookie']) ? $_COOKIE['category_cookie'] : '';
        $selCategory = !empty($category)?$category:$cat;
        $vars = array();

        if (($category_cookie == $selCategory) || (!empty($global_search))){

            if (!empty($brand)) {
                $menu = '';
                foreach ($brand as $key => $brVal) {
                    $menu .= $brVal . ',';
                }
                $vars ['manufacturer'] = rtrim($menu, ',');
            }

            if (!empty($options)) {
                $option = '';
                foreach ($options as $key => $optVal) {
                    $option .= $optVal . ',';
                }
                $vars ['option'] = rtrim($option, ',');
            }

            if (!empty($price)) {
                $vars ['price'] = $price;
            }

            if (!empty($rating)) {
                $rat = '';
                foreach ($rating as $key => $ratVal) {
                    $rat .= $ratVal . ',';
                }
                $vars ['rating'] = rtrim($rat, ',');
            }
        }else{
            setcookie('category_cookie',$category,time()+86400, "/");
        }

        if (!empty($global_search)) {
            $vars ['keywordTop'] = $global_search;
        }

        if (!empty($category)) {
            $vars ['category'] = $category;
        }

        if (!empty($shortBy)) {
            $vars ['shortBy'] = $shortBy;
        }
        if (!empty($show)) {
            $vars ['show'] = $show;
        }


        $querystring = http_build_query($vars);
        return redirect()->to('products/search?cat='.$cat.'&'.$querystring);

    }


}
