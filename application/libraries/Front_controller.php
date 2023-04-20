<?php
defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH . './libraries/REST_Controller.php';

class Front_controller extends REST_Controller
{
    public function img_upload_lib($path = '', $format = '', $name = '', $resize = false, $width = '', $height = "", $maintain = true)
    {
        $config['upload_path'] = $path;
        $config['allowed_types'] = $format;
        $config['encrypt_name'] = true;
        $config['file_ext_tolower'] = true;

        $this->upload->initialize($config);

        if (!$this->upload->do_upload($name)) {
            $error = array('error' => $this->upload->display_errors());
            return ['error' => $error['error']];
        } else {
            $data = array('upload_data' => $this->upload->data());
        }

        if ($resize) {
            $config['image_library'] = 'gd2';
            $config['source_image'] = $path . $data['upload_data']['file_name'];
            $config['new_image'] = $path . $width . '-' . $height . '-' . $data['upload_data']['file_name'];
            $config['create_thumb'] = false;
            $config['maintain_ratio'] = $maintain;
            $config['width'] = $width;
            $config['height'] = $height;
            $this->image_lib->clear();
            $this->image_lib->initialize($config);
            $this->image_lib->resize();
        }

        return $data;
    }

    public function site_pagination($url = '', $per_page = '', $count = '', $segment = '')
	{
		$config['base_url'] = base_url() . $url;
		$config['total_rows'] = $count;
		$config['per_page'] = $per_page;
		$config['uri_segment'] = $segment;
		$config['full_tag_open'] = '<ul class="pagination">';
		$config['full_tag_close'] = '</ul>';
		$config['first_tag_open'] = '<li class="page-count">';
		$config['first_tag_close'] = '</li>';
		$config['last_tag_open'] = '<li class="">';
		$config['last_tag_close'] = '</li>';
		$config['num_tag_open'] = '<li class="page-count">';
		$config['num_tag_close'] = '</li>';
		$config['next_tag_open'] = '<li class="next-page">';
		$config['next_tag_close'] = '</li>';
		$config['prev_tag_open'] = '<li class="next-page">';
		$config['prev_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="active-page"><a>';
		$config['cur_tag_close'] = '</a></li>';
		$config['first_link'] = '<li class="next-page">First';
		$config['last_link'] = '<li class="next-page">Last';
		$config['next_link'] = '<i class="fa fa-angle-double-right" aria-hidden="true"></i>';
		$config['prev_link'] = '<i class="fa fa-angle-double-left" aria-hidden="true"></i>';

		$this->pagination->initialize($config);
		$segment = $this->uri->segment($segment);

		return array(
			"limit" => $config['per_page'],
			"offset" => $segment
		);
	}



}
