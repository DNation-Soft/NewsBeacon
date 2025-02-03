<div class="col-md-9 position-relative">
    <div class="row">
        <div class="col-md-12 " style="margin-bottom: 420px;">
            <center><p class="main-title text-capitalize">ফটোগ্যালারি <?= $gallery->name;?></p></center>

            <div class="row">
                <div class="col-md-4 mt-3 ">
                    <?php $img = str_replace("pro_", "", $gallery->thumb); $url = base_url('uploads/album/'.$gallery->album_id.'/'.$img); ?>
                    <a class="example-image-link" href="<?= $url;?>" data-lightbox="example-set">
                        <?php echo image_view('uploads/album',$gallery->album_id,'254_'.$gallery->thumb,'noimage.png','border w-100');?>
                    </a>
                </div>

                <?php foreach ($detail as $val){ $img2 = str_replace("pro_", "", $val->image); $url2 = base_url('uploads/album/'.$val->album_id.'/'.$val->album_details_id.'/'.$img2); ?>
                    <div class="col-md-4 mt-3 ">
                        <a class="example-image-link" href="<?= $url2;?>" data-lightbox="example-set" >
                            <?php echo multi_image_view('uploads/album', $val->album_id, $val->album_details_id, '254_' . $val->image, 'noimage.png', 'border w-100');?>
                        </a>
                    </div>
                <?php } ?>
            </div>
        </div>





        <div class="col-md-12 map mt-5 bottom-row">
            <center><p class="title-home "><a href="https://maps.app.goo.gl/syrWkN55uJLzsdBTA" class="text-decoration-none text-danger " target="_blank">প্রতিষ্ঠানের গুগল ম্যাপ </a></p></center>
            <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d29372.021260362104!2d89.3942166!3d23.0420263!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39ffa1d46d09228d%3A0x34f9ff76c7bae818!2sNOAPARA%20TECHNICAL%20INSTITUTE!5e0!3m2!1sen!2sbd!4v1728222935153!5m2!1sen!2sbd"
                    width="100%" height="350" style="border:0;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>


    </div>
</div>