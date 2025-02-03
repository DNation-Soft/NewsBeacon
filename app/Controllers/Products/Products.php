<?php namespace App\Controllers\Products;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\RedirectResponse;

class Products extends BaseController {

    protected $validation;
    protected $session;
    protected $cart;

    public function __construct()
    {
        $this->validation = \Config\Services::validation();
        $this->session = \Config\Services::session();
        $this->cart = \Config\Services::cart();
    }

    /**
     * @description This method provides product detail page view
     * @param int $product_id
     * @return void
     */
    public function detail($product_id)
    {
        $settings = get_settings();

        $table = DB()->table('nb_products');
        $table->join('nb_product_description', 'nb_product_description.product_id = nb_products.product_id ');
        $data['products'] = $table->where('nb_products.product_id',$product_id)->get()->getRow();

        //image
        $imgTable = DB()->table('nb_product_image');
        $data['proImg'] = $imgTable->where('product_id',$product_id)->where('Product_option_id',null)->get()->getResult();

        //related product
        $relatedProduct = array();
        $relTable = DB()->table('nb_product_related');
        $relPro = $relTable->where('product_id',$product_id)->limit(5)->get()->getResult();
        foreach ($relPro as $rVal){
            $tableSear = DB()->table('nb_products');
            $rowPro = $tableSear->where('product_id',$rVal->related_id)->get()->getRow();
            array_push($relatedProduct,$rowPro);
        }
        $data['relProd'] = $relatedProduct;

        //related product  2 products view
        $relatedProduct2 = array();
        $relTable = DB()->table('nb_product_related');
        $relPro2 = $relTable->where('product_id',$product_id)->orderBy('product_id','DESC')->limit(2)->get()->getResult();
        foreach ($relPro2 as $rVal2){
            $tableSear2 = DB()->table('nb_products');
            $rowPro2 = $tableSear2->where('product_id',$rVal2->related_id)->get()->getRow();
            array_push($relatedProduct2,$rowPro2);
        }
        $data['relProdSide'] = $relatedProduct2;

        //reviews
        $reviewTable = DB()->table('nb_product_feedback');
        $data['review'] = $reviewTable->where('product_id',$product_id)->where('status','Active')->get()->getResult();



        //bought together products view
        $bothProduct = array();
        $bothTable = DB()->table('nb_product_bought_together');
        $bothPro = $bothTable->where('product_id',$product_id)->orderBy('product_id','DESC')->get()->getResult();
        foreach ($bothPro as $bVal){
            $tableboth = DB()->table('nb_products');
            $rowPro = $tableboth->where('product_id',$bVal->related_id)->get()->getRow();
            array_push($bothProduct,$rowPro);
        }
        $data['bothProducts'] = $bothProduct;



        $data['option'] = $this->optionView($product_id);


        $data['keywords'] = !empty($data['products']->meta_keyword)?$data['products']->meta_keyword:$settings['meta_keyword'];
        $data['description'] = !empty($data['products']->meta_description)?$data['products']->meta_description:$settings['meta_description'];
        $data['title'] = !empty($data['products']->meta_title)?$data['products']->meta_title:$data['products']->name;

        $data['page_title'] = 'Product Detail';
        echo view('Theme/'.$settings['Theme'].'/header',$data);
        echo view('Theme/'.$settings['Theme'].'/Product/detail');
        echo view('Theme/'.$settings['Theme'].'/footer');
    }

    /**
     * @description This method provides option price calculate.
     * @return void
     */
    public function optionPriceCalculate(){

        $product_id = $this->request->getPost('product_id');

        $totalOptionPrice = 0;
        foreach(get_all_data_array('nb_option') as $vl) {
            $fildName = str_replace(' ','',$vl->name);
            $data[strtolower($vl->name)] = $this->request->getPost(strtolower($fildName));

            $table = DB()->table('nb_product_option');
            $option = $table->where('option_value_id',$data[strtolower($vl->name)])->where('product_id',$product_id)->get()->getRow();

            if (!empty($option)) {
                if (empty($option->subtract)){
                    $totalOptionPrice = $totalOptionPrice + $option->price;
                }else{
                    $totalOptionPrice = $totalOptionPrice - $option->price;
                }
            }
        }

        $proPrice = get_data_by_id('price','nb_products','product_id',$product_id);
        $specialprice = get_data_by_id('special_price','nb_product_special','product_id',$product_id);
        if (!empty($specialprice)){
            $proPrice = $specialprice;
        }

        print currency_symbol($proPrice + $totalOptionPrice);
    }

    /**
     * @description This method provides review action execute
     * @return RedirectResponse
     */
    public function review(){
        $data['product_id'] = $this->request->getPost('product_id');
        $data['customer_id'] = $this->session->cusUserId;
        $data['feedback_star'] = $this->request->getPost('rating');
        $data['feedback_text'] = $this->request->getPost('feedback_text');

        $this->validation->setRules([
            'product_id' => ['label' => 'Product', 'rules' => 'required'],
            'feedback_star' => ['label' => 'Rating', 'rules' => 'required'],
            'feedback_text' => ['label' => 'Message', 'rules' => 'required'],
        ]);

        if ($this->validation->run($data) == FALSE) {
            $this->session->setFlashdata('message', '<div class="alert alert-danger alert-dismissible" role="alert">' . $this->validation->listErrors() .'</div>');
            return redirect()->to('detail/'. $data['product_id']);
        } else {

            $table = DB()->table('nb_product_feedback');
            $table->insert($data);

            $dataRet['average_feedback'] = product_id_by_average_rating($data['product_id']);
            $tablePro = DB()->table('nb_products');
            $tablePro->where('product_id',$data['product_id'])->update($dataRet);

            $this->session->setFlashdata('message', '<div class="alert-success-m alert-success alert-dismissible" role="alert">Successfully submitted review</div>');
            return redirect()->to('detail/'. $data['product_id']);
        }
    }

    /**
     * @description This method provides both product price.
     * @return void
     */
    public function both_product_price(){
        $productId = $this->request->getPost('both_product[]');
        $total = 0;
        foreach ($productId as $id){
            $regPric = get_data_by_id('price','nb_products','product_id',$id);
            $spPric = get_data_by_id('special_price','nb_product_special','product_id',$id);
            $total += !empty($spPric)?$spPric:$regPric;
        }
        print currency_symbol($total);
    }

    /**
     * @description This method provides option view.
     * @param int $product_id
     * @return string
     */
    private function optionView($product_id){
        $productOption = DB()->table('nb_product_option');
        $allOptionsGroup = $productOption->where('product_id',$product_id)->groupBy('option_id')->get()->getResult();

        $view ='';
        foreach ($allOptionsGroup as $gro) {
            $type = get_data_by_id('type', 'nb_option', 'option_id', $gro->option_id);
            $name = get_data_by_id('name', 'nb_option', 'option_id', $gro->option_id);
            $view .= '<p class="tit-op " >' . $name . ' <span class="mess-alert  ' . strtolower($name) . '"></span></p>';
            $view .= $this->optionType($type,$gro->option_id,$product_id,$name);
        }

        return $view;
    }

    /**
     * @description This method provides option type.
     * @param string $type
     * @param int $option_id
     * @param int $product_id
     * @param string $name
     * @return string|void
     */
    private function optionType($type,$option_id,$product_id,$name){
        if ($type == 'radio'){
            return $this->typeRadio($option_id,$product_id,$name);
        }
        if ($type == 'select'){
            return $this->typeSelect($option_id,$product_id,$name);
        }

    }

    /**
     * @description This method provides option radio type.
     * @param int $option_id
     * @param int $product_id
     * @param string $name
     * @return string
     */
    private function typeRadio($option_id,$product_id,$name){
        $table = DB()->table('nb_product_option');
        $data = $table->where('option_id',$option_id)->where('product_id',$product_id)->get()->getResult();
        $view = '<ul class="list-unstyled filter-items mb-3">';
        foreach($data as $key=> $opVal){
            $fildName = str_replace(' ','',$name);
            $view .='<li class="mt-2"><input type="radio" class="btn-check" oninput="optionPriceCalculate('.$product_id.')"  name="'.strtolower($fildName).'" id="option_'.$opVal->option_value_id.'" value="'.$opVal->option_value_id.'"  autocomplete="off" required>';

            $nameVal = get_data_by_id('name','nb_option_value','option_value_id',$opVal->option_value_id);
            $firstCar =  mb_substr($nameVal, 0, 1); $length = strlen($nameVal);
            $isColor = (($firstCar == '#') && ($length == 7))?'':$nameVal;
            $nameOp = !empty($isColor)?$isColor:'';
            $style = empty($isColor)?"background-color: $nameVal;padding: 15px 18px; border: unset;":"";

            $view .='<label class="btn btn-outline-secondary pd-new"  style="'.$style.' border-radius: unset; margin-left:8px;"  for="option_'.$opVal->option_value_id.'">
                '.$nameOp.'</label></li>';
        }
        $view .='</ul>';
        return $view;
    }

    /**
     * @description This method provides option select type.
     * @param int $option_id
     * @param int $product_id
     * @param string $name
     * @return string
     */
    private function typeSelect($option_id,$product_id,$name){
        $table = DB()->table('nb_product_option');
        $data = $table->where('option_id',$option_id)->where('product_id',$product_id)->get()->getResult();
        $fildName = str_replace(' ','',$name);
        $view = '<select name="'.strtolower($fildName).'"  onchange="optionPriceCalculate('.$product_id.')" class="form-control detail-select my-2" required><option value="" >Please select</option>';
        foreach($data as $key=> $opVal){
            $nameVal = get_data_by_id('name','nb_option_value','option_value_id',$opVal->option_value_id);
            $firstCar =  mb_substr($nameVal, 0, 1); $length = strlen($nameVal);
            $isColor = (($firstCar == '#') && ($length == 7))?'':$nameVal;
            $nameOp = !empty($isColor)?$isColor:'';
            $style = empty($isColor)?"background-color: $nameVal;padding: 15px 18px; border: unset;":"";
            $view .='<option value="'.$opVal->option_value_id.'" style="'.$style.'" >'.$nameVal.'</option>';
        }
        $view .='</select>';
        return $view;
    }


}
