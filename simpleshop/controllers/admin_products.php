<?php defined('BASEPATH') OR exit('No direct script access allowed');

// Include the SimpleShop base controller
require_once dirname(dirname(__FILE__)) . '/core/Simpleshop_Admin_Controller.php';

/**
 * Product management controller
 */
class Admin_Products extends Simpleshop_Admin_Controller {

	/**
	 * Doctrine EntityManager
	 * @access  protected
	 * @var     \Doctrine\ORM\EntityManager
	 */
	protected $em;

	/**
	 * The current active section
	 * @access  protected
	 * @var     int
	 */
	protected $section = 'products';

	/**
	 * The array containing the rules for products
	 * @access  private
	 * @var     array
	 */
	private $validation_rules = array(
		array(
			'field' => 'title',
			'label' => 'lang:product_title_label',
			'rules' => 'trim|required|max_length[130]|callback__check_title'
		),
		array(
			'field'	=> 'description',
			'label'	=> 'lang:product_description_label',
			'rules'	=> 'trim|max_length[2000]'
		)
	);

	/**
	 * Constructor
	 */
	public function __construct()
	{
		parent::__construct();

		$this->lang->load('products');
	}

	/**
	 * List all products
	 *
	 * @return void
	 */
	public function index()
	{
		$this->template
			->title($this->module_details['name'], lang('products_title'))
			->build('admin/products/index', array(
				'products' => $this->em->getRepository('Entity\Product')->findAll(array(), 'title')
		));
	}

	/**
	 * Delete a product
	 *
	 * @param   int     $id
	 * @return  void
	 */
	public function delete($id = 0)
	{
		$id_array = ( ! empty($id)) ? array($id) : $this->input->post('action_to');

		// Delete multiple
		if ( ! empty($id_array))
		{
			$deleted = array();

			foreach ($id_array as $id)
			{
				$product = $this->em->find('\Entity\Product', $id);

				try
				{
					$this->em->remove($product);
					$deleted[] = $product->getTitle();
				}
				catch (InvalidArgumentException $e)
				{
					$this->session->set_flashdata('error', sprintf($this->lang->line('product_single_delete_error'), $product->getTitle()));
				}
			}

			try
			{
				$this->em->flush();
				$this->session->set_flashdata('success', sprintf($this->lang->line('product_mass_delete_success'), implode(', ', $deleted)));
			}
			catch (\Doctrine\ORM\OptimisticLockException $e)
			{
				$this->session->set_flashdata('error', $this->lang->line('product_mass_delete_error'));
			}
		}
		else
		{
			$this->session->set_flashdata('error', $this->lang->line('product_no_select_error'));
		}

		redirect('admin/simpleshop/products');
	}

	/**
	 * Create a new product
	 *
	 * @return	void
	 */
	public function create()
	{
		$this->_display_form(new \Entity\Product);
	}

	/**
	 * Edit an existing product
	 *
	 * @param   int     $product_id
	 * @return  void
	 */
	public function edit($product_id = NULL)
	{
		$product = $this->em->find('\Entity\Product', $product_id);

		$product OR redirect('admin/simpleshop/products');

		$this->_display_form($product);
	}

	/**
	 * Display the create/edit form
	 *
	 * @param   Entity\Product $product
	 * @return  void
	 */
	private function _display_form(\Entity\Product $product)
	{
		role_or_die('simpleshop', 'create_product');

		$this->form_validation->set_rules($this->validation_rules);

		if ($_POST)
		{
			$product->setTitle($this->input->post('title'))
					->setDescription($this->input->post('description'));
		}

		if ($this->form_validation->run())
		{
			// Save the Product
		    $this->em->persist($product);
		    $this->em->flush();

			// Redirect back to the form or main page
			if ($this->input->post('btnAction') == 'save_exit')
			{
				redirect('admin/simpleshop/products');
			}
			else
			{
				redirect('admin/simpleshop/products/edit/' . $product->getId());
			}
		}

		if ($this->method == 'create')
		{
			$page_title = lang('create_product');
		}
		else
		{
			$page_title = sprintf(lang('edit_product'), $product->getTitle());
		}

		$this->template
			->title($this->module_details['name'], $page_title)
			->build('admin/products/form', array(
				'page_title' => $page_title,
				'product' => $product
		));
	}

	/**
	 * Callback method that checks for unique product titles
	 *
	 * @access  public
	 * @param   string  $title
	 * @return  bool
	 */
	public function _check_title($title = '')
	{
		if ($this->em->getRepository('\Entity\Product')->findOneBy(array('title' => $title)))
		{
			$this->form_validation->set_message('_check_title', sprintf($this->lang->line('product_already_exist_error'), $title));
			return FALSE;
		}

		return TRUE;
	}

}

/* End of file admin_products.php */