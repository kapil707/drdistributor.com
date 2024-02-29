<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class MedicineItemModel extends CI_Model  
{
	public function __construct(){
		parent::__construct();
		// Load model
		$this->load->model("model-drdistributor/medicine_item/MedicineNewThisMonthModel");
		$this->load->model("model-drdistributor/medicine_item/MedicineMustBuyModel");
		$this->load->model("model-drdistributor/medicine_item/MedicineHotSellingModel");
		$this->load->model("model-drdistributor/medicine_item/MedicineAvailableNowModel");
		$this->load->model("model-drdistributor/medicine_item/MedicineTopSearchModel");
		$this->load->model("model-drdistributor/medicine_item/MedicineLowPriceModel");
		$this->load->model("model-drdistributor/medicine_item/MedicineSchemeNewModel");
		$this->load->model("model-drdistributor/medicine_item/MedicineItemWiseModel");		
	}
	
	public function medicine_item($session_yes_no="no",$category_id,$user_type='',$user_altercode='',$salesman_id='',$show_out_of_stock="1",$get_record="12",$limit="12",$show_type="RAND")
	{
		if($category_id=="1"){
			return $this->MedicineNewThisMonthModel->get_medicine_new_this_month_api($session_yes_no,$category_id,$show_out_of_stock,$get_record,$limit,$show_type);
		}
		if($category_id=="2"){
			return $this->MedicineHotSellingModel->get_medicine_hot_selling_api($session_yes_no,$category_id,$show_out_of_stock,$get_record,$limit,$show_type);
		}
		if($category_id=="3"){
			return $this->MedicineMustBuyModel->get_medicine_must_buy_api($session_yes_no,$category_id,$show_out_of_stock,$get_record,$limit,$show_type);
		}
		
		if($category_id=="4"){
			return $this->MedicineAvailableNowModel->get_medicine_available_now_api($session_yes_no,$category_id,$show_out_of_stock,$get_record,$limit,$show_type);
		}
		
		if($category_id=="5" && $session_yes_no=="yes"){
			 return $this->MedicineTopSearchModel->get_medicine_top_search_api($session_yes_no,$category_id,$user_type,$user_altercode,$salesman_id,$show_out_of_stock,$get_record,$limit,$show_type);
		}
		if($category_id=="5" && $session_yes_no=="no"){
			// jab session na milay to yha chalta ha 
			$return["items"] = "[]";
			$return["title"] = 'Search';
			return $return;
		}
		
		if($category_id=="6"){
			return $this->MedicineLowPriceModel->get_medicine_low_price_api($session_yes_no,$category_id,$show_out_of_stock,$get_record,$limit,$show_type);
		}
		if($category_id=="7"){
			return $this->MedicineSchemeNewModel->get_medicine_scheme_now_api($session_yes_no,$category_id,$show_out_of_stock,$get_record,$limit,$show_type);
		}
		
		return $this->MedicineItemWiseModel->get_medicine_item_view_api($session_yes_no,$category_id,$show_out_of_stock,$get_record,$limit,$show_type);
	}
	
}