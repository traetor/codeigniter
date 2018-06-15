<?php 
	class Store_items extends MX_Controller
	{
		function __construct()
		{
			parent::__construct();
		}
		function create()
		{
			$this->load->library('session');
			$this->load->module('site_security');
			$this->site_security->_make_sure_is_admin();
			$update_id = $this->uri->segment(3);
			$submit = $this->input->post('submit', TRUE);
			if ($submit == "Zapisz")
			{
				//process the form
				$this->load->library('form_validation');
				$this->form_validation->set_rules('item_title', 'Nazwa produktu', 'required|max_length[240]');
				$this->form_validation->set_rules('item_price', 'Cena produktu', 'required|numeric');
				$this->form_validation->set_rules('was_price', 'Stara cena', 'numeric');
				$this->form_validation->set_rules('item_description', 'Opis produktu', 'required');
				if ($this->form_validation->run() == TRUE)
				{
					//get the varables
					$data = $this->fetch_data_from_post();
					if (is_numeric($update_id))
					{
						//update the item details
						$this->_update($update_id, $data);
						$flash_msg = "Produkt został zaktualizowany pomyślnie!";
						$value = '<div class="alert alert-success" role="alert">'.$flash_msg.'</div>';
						$this->session->set_flashdata('item', $value);
						redirect('store_items/create/'.$update_id);
					}else
					{
						//insert a new item
						$this->_insert($data);
						$update_id = $this->get_max(); //get the ID of the new item
						$flash_msg = "Produkt został dodany pomyślnie!";
						$value = '<div class="alert alert-success" role="alert">'.$flash_msg.'</div>';
						$this->session->set_flashdata('item', $value);
						redirect('store_items/create/'.$update_id);
					}
				}
			}
			if ((is_numeric($update_id)) && ($submit!="Zapisz"))
			{
				$data = $this->fetch_data_from_db($update_id);
			}else
			{
				$data = $this->fetch_data_from_post();
			}
						if (!is_numeric($update_id))
			{
				$data['headline'] = "Dodaj nowy produkt";
			}else
			{
				$data['headline'] = "Zaktualizuj szczegóły produktu";
			}
			$data['update_id'] = $update_id;
			$data['flash'] = $this->session->flashdata('item');
			$data['view_module'] = "store_items";
			$data['view_file'] = "create";
			$this->load->module('templates');
			$this->templates->admin($data);
		}
		function manage()
		{
			$this->load->module('site_security');
			$this->site_security->_make_sure_is_admin();
			$data['view_module'] = "store_items";
			$data['view_file'] = "manage";
			$this->load->module('templates');
			$this->templates->admin($data);
		}
		function fetch_data_from_post()
		{
			$data['item_title'] = $this->input->post('item_title', TRUE);
			$data['item_price'] = $this->input->post('item_price', TRUE);
			$data['was_price'] = $this->input->post('was_price', TRUE);
			$data['item_description'] = $this->input->post('item_description', TRUE);
			return $data;
		}
		function fetch_data_from_db($update_id)
		{
			$query = $this->get_where($update_id);
			foreach($query->result() as $row)
			{
				$data['item_title'] = $row->item_title;
				$data['item_url'] = $row->item_url;
				$data['item_price'] = $row->item_price;
				$data['item_description'] = $row->item_description;
				$data['big_pic'] = $row->big_pic;
				$data['small_pic'] = $row->small_pic;
				$data['was_price'] = $row->was_price;
			}
			if (!isset($data))
			{
				$data = "";
			}
			return $data;
		}
		function get($order_by)
		{
			$this->load->model('Mdl_store_items');
			$query = $this->Mdl_store_items->get($order_by);
			return $query;
		}
		//test
		function get_with_limit($limit, $offset, $order_by)
		{
			$this->load->model('Mdl_store_items');
			$query = $this->Mdl_store_items->get_with_limit($limit, $offset, $order_by);
			return $query;
		}
		function get_where($id)
		{
			$this->load->model('Mdl_store_items');
			$query = $this->Mdl_store_items->get_where($id);
			return $query;
		}
		function get_where_custom($col, $value)
		{
			$this->load->model('Mdl_store_items');
			$query = $this->Mdl_store_items->get_where_custom($col, $value);
		}
		function _insert($data)
		{
			$this->load->model('Mdl_store_items');
			$this->Mdl_store_items->_insert($data);
		}
		function _update($id, $data)
		{
			$this->load->model('Mdl_store_items');
			$this->Mdl_store_items->_update($id, $data);
		}
		function _delete($id)
		{
			$this->load->model('Mdl_store_items');
			$this->Mdl_store_items->_delete($id);
		}
		function count_where($column, $value)
		{
			$this->load->model('Mdl_store_items');
			$count = $this->Mdl_store_items->count_where($column, $value);
			return $count;
		}
		function get_max()
		{
			$this->load->model('Mdl_store_items');
			$max_id = $this->Mdl_store_items->get_max();
			return $max_id;
		}
		function _custom_query($mysql_query)
		{
			$this->load->model('Mdl_store_items');
			$query = $this->Mdl_store_items->_custom_query($mysql_query);
			return $query;
		}
	}
?>