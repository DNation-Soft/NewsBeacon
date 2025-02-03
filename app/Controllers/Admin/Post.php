<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Libraries\Image_processing;
use App\Libraries\Permission;
use CodeIgniter\HTTP\RedirectResponse;

class Post extends BaseController
{

    protected $validation;
    protected $session;
    protected $crop;
    protected $permission;
    protected $imageProcessing;
    private $module_name = 'Post';

    public function __construct()
    {
        $this->validation = \Config\Services::validation();
        $this->session = \Config\Services::session();
        $this->crop = \Config\Services::image();
        $this->permission = new Permission();
        $this->imageProcessing = new Image_processing();
    }

    /**
     * @description This method provides album page view
     * @return RedirectResponse|void
     */
    public function index()
    {
        $isLoggedInEcAdmin = $this->session->isLoggedInEcAdmin;
        $adRoleId = $this->session->adRoleId;
        if (!isset($isLoggedInEcAdmin) || $isLoggedInEcAdmin != TRUE) {
            return redirect()->to(site_url('admin'));
        } else {

            $table = DB()->table('nb_posts');
            $data['posts'] = $table->get()->getResult();


            //$perm = array('create','read','update','delete','mod_access');
            $perm = $this->permission->module_permission_list($adRoleId, $this->module_name);
            foreach ($perm as $key => $val) {
                $data[$key] = $this->permission->have_access($adRoleId, $this->module_name, $key);
            }
            echo view('Admin/header');
            echo view('Admin/sidebar');
            if (isset($data['mod_access']) and $data['mod_access'] == 1) {
                echo view('Admin/Post/index', $data);
            } else {
                echo view('Admin/no_permission');
            }
            echo view('Admin/footer');
        }
    }

    /**
     * @description This method provides album create page view
     * @return RedirectResponse|void
     */
    public function create(){
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
                echo view('Admin/Post/create',$data);
            } else {
                echo view('Admin/no_permission');
            }
            echo view('Admin/footer');
        }
    }

    /**
     * @description This method provides album create action
     * @return RedirectResponse
     */
    public function create_action()
    {
        $data['post_title'] = $this->request->getPost('post_title');
        $data['news_cat_id'] = $this->request->getPost('news_cat_id');
        $data['post_content'] = $this->request->getPost('post_content');
        $data['post_author'] = $this->session->adUserId;
        $data['createdBy'] = $this->session->adUserId;

        $this->validation->setRules([
            'post_title' => ['label' => 'Title', 'rules' => 'required'],
            'news_cat_id' => ['label' => 'Category', 'rules' => 'required'],
            'post_content' => ['label' => 'Description', 'rules' => 'required'],
        ]);

        if ($this->validation->run($data) == FALSE) {
            $this->session->setFlashdata('message', '<div class="alert alert-danger alert-dismissible" role="alert">' . $this->validation->listErrors() . ' <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            return redirect()->to('admin/post_create');
        } else {

            $table = DB()->table('nb_posts');
            $table->insert($data);
            $postId = DB()->insertID();

            //image size array
            $this->imageProcessing->sizeArray = [ ['width'=>'420', 'height'=>'420', ] , ['width'=>'50', 'height'=>'50', ],];

            if (!empty($_FILES['image']['name'])) {
                $target_dir = FCPATH . '/uploads/post/'.$postId.'/';
                $this->imageProcessing->directory_create($target_dir);

                //new image upload
                $pic = $this->request->getFile('image');

                $news_img = $this->imageProcessing->product_image_upload_and_crop_all_size($pic,$target_dir);

                $dataImg['featured_image'] = $news_img;

                $albumTable = DB()->table('nb_posts');
                $albumTable->where('post_id',$postId)->update($dataImg);
            }
            //album table data insert(end)


            $this->session->setFlashdata('message', '<div class="alert alert-success alert-dismissible" role="alert">Create Record Success <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            return redirect()->to('admin/post_create');
        }
    }

    /**
     * @description This method provides album update page view
     * @param int $post_id
     * @return RedirectResponse|void
     */
    public function update($post_id)
    {
        $isLoggedInEcAdmin = $this->session->isLoggedInEcAdmin;
        $adRoleId = $this->session->adRoleId;
        if (!isset($isLoggedInEcAdmin) || $isLoggedInEcAdmin != TRUE) {
            return redirect()->to(site_url('admin'));
        } else {
            $table = DB()->table('nb_news_category');
            $data['category'] = $table->get()->getResult();

            $table = DB()->table('nb_posts');
            $data['post'] = $table->where('post_id', $post_id)->get()->getRow();



            //$perm = array('create','read','update','delete','mod_access');
            $perm = $this->permission->module_permission_list($adRoleId, $this->module_name);
            foreach ($perm as $key => $val) {
                $data[$key] = $this->permission->have_access($adRoleId, $this->module_name, $key);
            }
            echo view('Admin/header');
            echo view('Admin/sidebar');
            if (isset($data['update']) and $data['update'] == 1) {
                echo view('Admin/Post/update', $data);
            } else {
                echo view('Admin/no_permission');
            }
            echo view('Admin/footer');
        }
    }

    /**
     * @description This method provides color family update action
     * @return RedirectResponse
     */
    public function update_action()
    {
        $post_id = $this->request->getPost('post_id');
        $data['post_title'] = $this->request->getPost('post_title');
        $data['news_cat_id'] = $this->request->getPost('news_cat_id');
        $data['post_content'] = $this->request->getPost('post_content');
        $data['post_status'] = $this->request->getPost('post_status');

        $this->validation->setRules([
            'post_title' => ['label' => 'Title', 'rules' => 'required'],
            'news_cat_id' => ['label' => 'Category', 'rules' => 'required'],
            'post_content' => ['label' => 'Description', 'rules' => 'required'],
        ]);

        if ($this->validation->run($data) == FALSE) {
            $this->session->setFlashdata('message', '<div class="alert alert-danger alert-dismissible" role="alert">' . $this->validation->listErrors() . ' <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            return redirect()->to('admin/post_update/' . $post_id);
        } else {

            $table = DB()->table('nb_posts');
            $table->where('post_id', $post_id)->update($data);

            //image size array
            $this->imageProcessing->sizeArray = [ ['width'=>'420', 'height'=>'420', ] ,  ['width'=>'50', 'height'=>'50', ],];

            if (!empty($_FILES['image']['name'])) {
                $target_dir = FCPATH . '/uploads/post/'.$post_id.'/';
                //unlink
                $oldImg = get_data_by_id('featured_image','nb_posts','post_id',$post_id);
                $pic = $this->request->getFile('image');
                $news_img = $this->imageProcessing->single_product_image_unlink($target_dir,$oldImg)->directory_create($target_dir)->product_image_upload_and_crop_all_size($pic,$target_dir);

                $dataImg['featured_image'] = $news_img;

                $proUpTable = DB()->table('nb_posts');
                $proUpTable->where('post_id',$post_id)->update($dataImg);
            }
            //product table data insert(end)


            $this->session->setFlashdata('message', '<div class="alert alert-success alert-dismissible" role="alert">Update Record Success <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            return redirect()->to('admin/post_update/' . $post_id);

        }
    }

    /**
     * @description This method provides color family delete
     * @param int $post_id
     * @return RedirectResponse
     */
    public function delete($post_id){

        helper('filesystem');

        DB()->transStart();

        $target_dir = FCPATH . '/uploads/post/'.$post_id;
        if (file_exists($target_dir)) {
            delete_files($target_dir, TRUE);
            rmdir($target_dir);
        }
        $table = DB()->table('nb_posts');
        $table->where('post_id', $post_id)->delete();

        DB()->transComplete();


        $this->session->setFlashdata('message', '<div class="alert alert-success alert-dismissible" role="alert">Delete Record Success <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        return redirect()->to('admin/post');
    }



}
