<?php
	// Set error in 
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);

	// include header and footer for page
	require_once('../FullScreenLayout.php');

	// include autoload php file for loading WooCommerce API  <<<Start>>>
	require_once('../vendor/autoload.php');
	use Automattic\WooCommerce\Client;
	use Automattic\WooCommerce\HttpClient\HttpClientException;

	$currentURL = 'index.php';

	class Index
	{
		private $rval;
		private $header, $footer, $order_html;
		private $store, $consumer_key, $consumer_secret;
		private $woocommerce, $results;
		private $billingArray = [], $shippingArray = [], $order_details = [];


		/*
		*	Set header and footer when create Index class object. 
		*/
		function __construct(){
			$objFullScreenLayout = new FullScreenLayout('../assets/');
			$this->header = $objFullScreenLayout->setHeader();
			$this->footer = $objFullScreenLayout->setFooter();

			// create controller object
			//global $ctrl;
			//$ctrl = new ctrl_persondetails();

			$this->store	= 'http://insilla.vooforce.com/';
			$this->consumer_key = 'ck_2a286fc6a839e560760216a681961319c90c7b1d';
			$this->consumer_secret = 'cs_87cc8ce63216224d5475a8e445cfe050840d4d86';
		}

		/*
		*	Get existing data from the data base.
		*/
		public function getData(){
			
			// create Client object and set nessory parameter for API Call.
			$this->woocommerce = new Client(
			    $this->store, 
			    $this->consumer_key, 
			    $this->consumer_secret,
			    [
			        'wp_api' => true,
			        'version' => 'wc/v1',
			        'query_string_auth' => true
			    ]
			);

			// Call API or Fetch all order of Jun-2017
			try {
			    // Array of response results.
			    // Example: ['customers' => [[ 'id' => 8, 'created_at' => '2015-05-06T17:43:51Z', ...etc
			    $this->results = $this->woocommerce->get('orders', $parameters = ['after' => '2017-05-30T17:43:51Z', 'before' => '2017-07-01T17:43:51Z']);
			    //var_dump($this->results);exit;
			} catch (HttpClientException $e) {
			    $e->getMessage(); // Error message.
			    $e->getRequest(); // Last request data.
			    $e->getResponse(); // Last response data.
			}

			// make associative array
			for($orderIterator = 0; $orderIterator < count($this->results); $orderIterator++){
				// Billing array
				$this->billingArray[$orderIterator] = [
					'full_name' => $this->results[$orderIterator]->billing->first_name.' '.$this->results[$orderIterator]->billing->last_name,
					'company_name' => $this->results[$orderIterator]->billing->company,
					'address' => $this->results[$orderIterator]->billing->address_1.', '.$this->results[$orderIterator]->billing->address_2,
					'city' => $this->results[$orderIterator]->billing->city,
					'state' => $this->results[$orderIterator]->billing->state,
					'postcode' => $this->results[$orderIterator]->billing->postcode,
					'country' => $this->results[$orderIterator]->billing->country,
					'email' => $this->results[$orderIterator]->billing->email,
					'phone' => $this->results[$orderIterator]->billing->phone
				];

				// Shipping array
				$this->shippingArray[$orderIterator] = [
					'full_name' => $this->results[$orderIterator]->shipping->first_name.' '.$this->results[$orderIterator]->shipping->last_name,
					'company_name' => $this->results[$orderIterator]->shipping->company,
					'address' => $this->results[$orderIterator]->shipping->address_1.', '.$this->results[$orderIterator]->shipping->address_2,
					'city' => $this->results[$orderIterator]->shipping->city,
					'state' => $this->results[$orderIterator]->shipping->state,
					'postcode' => $this->results[$orderIterator]->shipping->postcode,
					'country' => $this->results[$orderIterator]->shipping->country
				];

				// total amount array 
				$this->order_details[$orderIterator] = [
					'order_id' => $this->results[$orderIterator]->id,
					'status' => $this->results[$orderIterator]->status,
					'order_date' => $this->results[$orderIterator]->date_created,
					'modified_date' => $this->results[$orderIterator]->date_modified,
					'discount_total' => $this->results[$orderIterator]->discount_total,
					'shipping_total' => $this->results[$orderIterator]->shipping_total,
					'total' => $this->results[$orderIterator]->total
				];
			}
		}

		/*
		*	Display all data into the table.
		*/
		public function createForm(){

			$this->order_html .= $this->header;

			$this->order_html .= <<<EOT
				<div id="index_div">
					<h3><strong>All Order List Of JUN-2017</strong></h3>
					<hr style="margin-top: 0rem;">
EOT;
	// Fill data which is get from API
		for($orderIterator = 0; $orderIterator < count($this->billingArray); $orderIterator++){
			$this->order_html .= <<<EOT
					<div class="row" style="margin: 1rem 3rem 1rem 3rem;">
						<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 col-xl-2">
							<h5><strong>Order ID </strong>
							  <p>&nbsp;&nbsp;&nbsp;{$this->order_details[$orderIterator]['order_id']}</p>
							</h5> 
						</div>
						<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 col-xl-4">
							<h5><strong>Shipping Address</strong></h5>
							<p><strong>Full Name : </strong>
								{$this->billingArray[$orderIterator]['full_name']}
							<p>
							<p><strong>Company name : </strong>
								{$this->billingArray[$orderIterator]['company_name']}
							<p>
							<p><strong>Address : </strong>
								{$this->billingArray[$orderIterator]['address']}
							<p>
							<p><strong>City : </strong>
								{$this->billingArray[$orderIterator]['city']}
							<p>
							<p><strong>State : </strong>
								{$this->billingArray[$orderIterator]['state']}
							<p>
							<p><strong>Post Code : </strong>
								{$this->billingArray[$orderIterator]['postcode']}
							<p>
							<p><strong>Country : </strong>
								{$this->billingArray[$orderIterator]['country']}
							<p>
							<p><strong>Email : </strong>
								{$this->billingArray[$orderIterator]['email']}
							<p>
							<p><strong>Phone : </strong>
								{$this->billingArray[$orderIterator]['phone']}
							<p>
EOT;
			$this->order_html .= <<<EOT
						</div>
						<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 col-xl-3">
							<h5><strong>Billing Address</strong></h5>
							<p><strong>Full Name : </strong>
								{$this->shippingArray[$orderIterator]['full_name']}
							</p>
							<p><strong>Company Name : </strong>
								{$this->shippingArray[$orderIterator]['company_name']}
							</p>
							<p><strong>Address : </strong>
								{$this->shippingArray[$orderIterator]['address']}
							</p>
							<p><strong>State : </strong>
								{$this->shippingArray[$orderIterator]['state']}
							</p>
							<p><strong>Post Code : </strong>
								{$this->shippingArray[$orderIterator]['postcode']}
							</p>
							<p><strong>Country : </strong>
								{$this->shippingArray[$orderIterator]['country']}
							</p>
EOT;
			$this->order_html .= <<<EOT
						</div>
						<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 col-xl-3">
							<h5><strong>Order Details</strong></h5>
							<p><strong>Status : </strong>
								{$this->order_details[$orderIterator]['status']}
							</p>
							<p><strong>Order Date : </strong>
								{$this->order_details[$orderIterator]['order_date']}
							</p>
							<p><strong>Modified Date : </strong>
								{$this->order_details[$orderIterator]['modified_date']}
							</p>
							<p><strong>Discount Total :</strong>
								{$this->order_details[$orderIterator]['discount_total']}
							</p>
							<p><strong>Shipping Total : </strong>
								{$this->order_details[$orderIterator]['shipping_total']}
							</p>
							<p><strong>Total Amount : </strong>
								{$this->order_details[$orderIterator]['total']}
							</p>
						</div>
					</div>
					<hr style="margin: 1rem 3rem 1rem 3rem;">
EOT;
		}
			$this->order_html .= <<<EOT
				</div>
EOT;
			$this->order_html .= $this->footer;

			return $this->order_html;
		}

	}

	// create Index class object.
	$objOrder = new Index();

	$objOrder -> getData();

	echo $objOrder -> createForm();

?>