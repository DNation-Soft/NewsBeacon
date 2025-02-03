<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Libraries\Permission;
use CodeIgniter\HTTP\RedirectResponse;

class News_category extends BaseController
{

    protected $validation;
    protected $session;
    protected $crop;
    protected $permission;
    private $module_name = 'News_category';

    public function __construct()
    {
        $this->validation = \Config\Services::validation();
        $this->session = \Config\Services::session();
        $this->crop = \Config\Services::image();
        $this->permission = new Permission();
    }

    /**
     * @description This method provides Product category page view
     * @return RedirectResponse|void
     */
    public function index()
    {
        $isLoggedInEcAdmin = $this->session->isLoggedInEcAdmin;
        $adRoleId = $this->session->adRoleId;
        if (!isset($isLoggedInEcAdmin) || $isLoggedInEcAdmin != TRUE) {
            return redirect()->to(site_url('admin'));
        } else {

            $table = DB()->table('nb_news_category');
            $data['category'] = $table->get()->getResult();


            //$perm = array('create','read','update','delete','mod_access');
            $perm = $this->permission->module_permission_list($adRoleId, $this->module_name);
            foreach ($perm as $key => $val) {
                $data[$key] = $this->permission->have_access($adRoleId, $this->module_name, $key);
            }
            echo view('Admin/header');
            echo view('Admin/sidebar');
            if (isset($data['mod_access']) and $data['mod_access'] == 1) {
                echo view('Admin/News_category/index', $data);
            } else {
                echo view('Admin/no_permission');
            }
            echo view('Admin/footer');
        }
    }

    /**
     * @description This method provides create page view
     * @return RedirectResponse|void
     */
    public function create()
    {
        $isLoggedInEcAdmin = $this->session->isLoggedInEcAdmin;
        $adRoleId = $this->session->adRoleId;
        if (!isset($isLoggedInEcAdmin) || $isLoggedInEcAdmin != TRUE) {
            return redirect()->to(site_url('admin'));
        } else {

            $table = DB()->table('nb_news_category');
            $data['category'] = $table->get()->getResult();

            //$perm = array('create','read','update','delete','mod_access');
            $perm = $this->permission->module_permission_list($adRoleId, $this->module_name);
            foreach ($perm as $key => $val) {
                $data[$key] = $this->permission->have_access($adRoleId, $this->module_name, $key);
            }
            echo view('Admin/header');
            echo view('Admin/sidebar');
            if (isset($data['create']) and $data['create'] == 1) {
                echo view('Admin/News_category/create', $data);
            } else {
                echo view('Admin/no_permission');
            }
            echo view('Admin/footer');
        }
    }

    /**
     * @description This method store product category
     * @return RedirectResponse
     */
    public function create_action()
    {
        $data['category_name'] = $this->request->getPost('category_name');
        $data['slug'] = $this->request->getPost('slug');
        $data['parent_id'] = !empty($this->request->getPost('parent_id')) ? $this->request->getPost('parent_id') : null;
        $data['createdBy'] = $this->session->adUserId;

        $this->validation->setRules([
            'category_name' => ['label' => 'Category Name', 'rules' => 'required'],
            'slug' => ['label' => 'Slug', 'rules' => 'required'],
        ]);

        if ($this->validation->run($data) == FALSE) {
            $this->session->setFlashdata('message', '<div class="alert alert-danger alert-dismissible" role="alert">' . $this->validation->listErrors() . ' <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            return redirect()->to('admin/news_category_create');
        } else {
            if (!empty($_FILES['image']['name'])) {
                $target_dir = FCPATH . '/uploads/category/';
                if (!file_exists($target_dir)) {
                    mkdir($target_dir, 0777);
                }

                //new image uplode
                $pic = $this->request->getFile('image');
                $namePic = $pic->getRandomName();
                $pic->move($target_dir, $namePic);
                $news_img = 'category_' . $pic->getName();
                $this->crop->withFile($target_dir . $namePic)->fit(166, 208, 'center')->save($target_dir . $news_img);
                unlink($target_dir . $namePic);
                $data['image'] = $news_img;
            }

            $table = DB()->table('nb_news_category');
            $table->insert($data);

            $this->session->setFlashdata('message', '<div class="alert alert-success alert-dismissible" role="alert">Product Category Create Success <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            return redirect()->to('admin/news_category_create');
        }
    }

    /**
     * @description This method provides update page view
     * @param int $news_cat_id
     * @return RedirectResponse|void
     */
    public function update($news_cat_id)
    {
        $isLoggedInEcAdmin = $this->session->isLoggedInEcAdmin;
        $adRoleId = $this->session->adRoleId;
        if (!isset($isLoggedInEcAdmin) || $isLoggedInEcAdmin != TRUE) {
            return redirect()->to(site_url('admin'));
        } else {

            $table = DB()->table('nb_news_category');
            $data['category'] = $table->where('news_cat_id', $news_cat_id)->get()->getRow();

            $table2 = DB()->table('nb_news_category');
            $data['allcategory'] = $table2->where('news_cat_id !=', $news_cat_id)->get()->getResult();

            //$perm = array('create','read','update','delete','mod_access');
            $perm = $this->permission->module_permission_list($adRoleId, $this->module_name);
            foreach ($perm as $key => $val) {
                $data[$key] = $this->permission->have_access($adRoleId, $this->module_name, $key);
            }
            echo view('Admin/header');
            echo view('Admin/sidebar');
            if (isset($data['update']) and $data['update'] == 1) {
                echo view('Admin/News_category/update', $data);
            } else {
                echo view('Admin/no_permission');
            }
            echo view('Admin/footer');
        }
    }

    /**
     * @description This method update product category
     * @return RedirectResponse
     */
    public function update_action()
    {
        $news_cat_id = $this->request->getPost('news_cat_id');
        $data['slug'] = $this->request->getPost('slug');
        $data['category_name'] = $this->request->getPost('category_name');
        $data['parent_id'] = !empty($this->request->getPost('parent_id')) ? $this->request->getPost('parent_id') : null;
        $data['description'] = $this->request->getPost('description');
        $data['updatedBy'] = $this->session->adUserId;

        $this->validation->setRules([
            'category_name' => ['label' => 'Category Name', 'rules' => 'required'],
            'slug' => ['label' => 'Slug', 'rules' => 'required'],
        ]);

        if ($this->validation->run($data) == FALSE) {
            $this->session->setFlashdata('message', '<div class="alert alert-danger alert-dismissible" role="alert">' . $this->validation->listErrors() . ' <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            return redirect()->to('admin/news_category_update/' . $news_cat_id);
        } else {


            if (!empty($_FILES['image']['name'])) {
                $target_dir = FCPATH . '/uploads/category/';
                if (!file_exists($target_dir)) {
                    mkdir($target_dir, 0777);
                }

                //old image unlink
                $old_img = get_data_by_id('image', 'nb_news_category', 'news_cat_id', $news_cat_id);
                if (!empty($old_img)) {
                    $imgPath = $target_dir . $old_img;
                    if (file_exists($imgPath)) {
                        unlink($target_dir .  $old_img);
                    }
                }

                //new image uplode
                $pic = $this->request->getFile('image');
                $namePic = $pic->getRandomName();
                $pic->move($target_dir, $namePic);
                $news_img = 'category_' . $pic->getName();
                $this->crop->withFile($target_dir . $namePic)->fit(166, 208, 'center')->save($target_dir . $news_img);
                unlink($target_dir . $namePic);
                $data['image'] = $news_img;
            }

            $table = DB()->table('nb_news_category');
            $table->where('news_cat_id', $news_cat_id)->update($data);

            $this->session->setFlashdata('message', '<div class="alert alert-success alert-dismissible" role="alert">Product Category Update Success <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            return redirect()->to('admin/news_category_update/' . $news_cat_id);
        }
    }

    /**
     * @description This method update product category
     * @return RedirectResponse
     */
    public function update_action_others()
    {
        $news_cat_id = $this->request->getPost('news_cat_id');
        $data['meta_title'] = $this->request->getPost('meta_title');
        $data['meta_keyword'] = $this->request->getPost('meta_keyword');
        $data['meta_description'] = $this->request->getPost('meta_description');
        $data['sort_order'] = $this->request->getPost('sort_order');
        $data['header_menu'] = $this->request->getPost('header_menu');
        $data['side_menu'] = $this->request->getPost('side_menu');


        $data['updatedBy'] = $this->session->adUserId;

        $this->validation->setRules([
            'header_menu' => ['label' => 'Header Menu', 'rules' => 'required'],
        ]);

        if ($this->validation->run($data) == FALSE) {
            $this->session->setFlashdata('message', '<div class="alert alert-danger alert-dismissible" role="alert">' . $this->validation->listErrors() . ' <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            return redirect()->to('admin/news_category_update/' . $news_cat_id);
        } else {

            $table = DB()->table('nb_news_category');
            $table->where('news_cat_id', $news_cat_id)->update($data);

            $this->session->setFlashdata('message', '<div class="alert alert-success alert-dismissible" role="alert">Product Category Update Success <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            return redirect()->to('admin/news_category_update/' . $news_cat_id);
        }
    }

    /**
     * @description This method delete product category
     * @param int $prod_cat_id
     * @return RedirectResponse
     */
    public function delete($news_cat_id)
    {

        $target_dir = FCPATH . '/uploads/category/';
        //old image unlink
        $old_img = get_data_by_id('image', 'nb_news_category', 'news_cat_id', $news_cat_id);
        if (!empty($old_img)) {
            $imgPath = $target_dir . $old_img;
            if (file_exists($imgPath)) {
                unlink($target_dir . $old_img);
            }
        }

        $checkPost = is_exists('nb_news_category', 'parent_id', $news_cat_id);
        if ($checkPost == false) {
            $upData['parent_id'] = NULL;
            $tablePost = DB()->table('nb_news_category');
            $tablePost->where('parent_id', $news_cat_id)->update($upData);
        }

        $checkPost = is_exists('nb_posts', 'news_cat_id', $news_cat_id);
        if ($checkPost == false) {
            $upData['news_cat_id'] = 0;
            $tablePost = DB()->table('nb_posts');
            $tablePost->where('news_cat_id', $news_cat_id)->update($upData);
        }

        $table = DB()->table('nb_news_category');
        $table->where('news_cat_id', $news_cat_id)->delete();



        $this->session->setFlashdata('message', '<div class="alert alert-success alert-dismissible" role="alert">Product Category Delete Success <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        return redirect()->to('admin/news_category');
    }

    /**
     * @description This method update product category
     * @return void
     */
    public function sort_update_action()
    {
        $news_cat_id = $this->request->getPost('news_cat_id');
        $value = $this->request->getPost('value');

        $data['sort_order'] = $value;

        $table = DB()->table('nb_news_category');
        $table->where('news_cat_id', $news_cat_id)->update($data);
        print '<div class="alert alert-success alert-dismissible" role="alert">Sort Update Success <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
    }


}
