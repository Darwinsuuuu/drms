<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */


class AdminModel extends CI_Model
{
	
	function __construct() {
		$this->load->database();
	}


	public function display_widgets($type, $month) {

		$year = date("Y");

		$query = $this->db->query("SELECT count(*) AS counts FROM request_tbl WHERE MONTH(date_created) = '".$month."' AND YEAR(date_created) = '".$year."' AND status IN(".$type.")");
		return $query->row();

	}

	public function display_employee_status() {
		$query = $this->db->query("SELECT * FROM staff_account_tbl, course_handler_tbl WHERE course_handler_tbl.staff_id_ric = staff_account_tbl.staff_id OR course_handler_tbl.staff_id_frontline = staff_account_tbl.staff_id GROUP BY staff_account_tbl.staff_id ORDER BY staff_account_tbl.staff_type");
		return $query->result();
	}



	public function count_employee_status_months($id, $staff_type, $status, $student_type) {
		
		$year = date("Y");
		$month = date('m');

		$query = $this->db->query("SELECT count(*) as count FROM course_handler_tbl, request_tbl where course_handler_tbl.course_id = request_tbl.course_id AND request_tbl.status IN (".$status.") AND course_handler_tbl.".$staff_type." = '".$id."' AND request_tbl.student_type = '".$student_type."' AND MONTH(date_created) = '".$month."' AND YEAR(date_created)");
		
		return $query->row();
		
	}


	public function count_employee_status($id, $staff_type, $status, $student_type) {
		$query = $this->db->query("SELECT count(*) as count FROM course_handler_tbl, request_tbl where course_handler_tbl.course_id = request_tbl.course_id AND request_tbl.status IN (".$status.") AND course_handler_tbl.".$staff_type." = '".$id."' AND request_tbl.student_type = '".$student_type."'");
		
		return $query->row(); 
	}




	public function displayAccounts() {
		$query = $this->db->query("SELECT * FROM staff_account_tbl ORDER BY CASE WHEN account_status = '1' THEN 1 WHEN account_status = '0' THEN 2 WHEN account_status = '2' THEN 3 END ASC, staff_type");
        return $query->result();
	}

	public function checkAccount($id) {
		$query = $this->db->query("SELECT * FROM staff_account_tbl WHERE staff_id = '".$id."'");
		return $query->row();
	}

	public function checkAccountEmail() {
		$query = $this->db->query("SELECT * FROM staff_account_tbl");
		return $query->result();
	}


	public function checkAccountUpdate($id) {
		$query = $this->db->query("SELECT * FROM staff_account_tbl WHERE staff_id <> '".$id."'");
		return $query->result();
	}


	public function createAccount($data) {
        $this->db->insert('staff_account_tbl', $data);
    }

	public function updateAccount($id, $data) {
		$this->db->where('staff_id', $id);
		$this->db->update('staff_account_tbl', $data);
	}

	public function deleteAccount($id) {
		$this->db->where('staff_id', $id);
		$this->db->delete('staff_account_tbl');
	}

	public function displayColleges() {
		$db2 = $this->load->database('admissions', TRUE);
		$query = $db2->get('tbl_college');
        return $query->result();
	}

	// public function createCollege($data) {
    //     $this->db->insert('college_tbl', $data);
	// }

	// public function updateCollege($id, $data) {
	// 	$this->db->where('college_id', $id);
	// 	$this->db->update('college_tbl', $data);
	// }


	// public function deleteCollege($id) {
	// 	$this->db->where('college_id', $id);
	// 	$this->db->delete('college_tbl');
	// }


	public function getColleges_option() {
		$db2 = $this->load->database('admissions', TRUE);
		$query = $db2->query("SELECT * FROM tbl_college ORDER BY college_id ASC");
        return $query->result();
	}

	public function displayCourses($id) {
		$db2 = $this->load->database('admissions', TRUE);
		$query = $db2->query("SELECT * FROM tbl_course WHERE college_id = '".$id."' AND course_type NOT IN('EMP')");
        return $query->result();
	}


	public function displayHandlers($id) {
		$query = $this->db->query("SELECT * FROM course_handler_tbl where course_id = '".$id."'");
        return $query->row();
	}



	public function getRICs() {
		$query = $this->db->query('SELECT * FROM staff_account_tbl WHERE staff_type = 1');
        return $query->result();
	}

	public function getfrontlines() {
		$query = $this->db->query('SELECT * FROM staff_account_tbl WHERE staff_type = 2');
        return $query->result();
	}

	
	public function create_handlerRIC($data) {
		$this->db->insert('course_handler_tbl', $data);
        $id = $this->db->insert_id();
		return $id;
	}


	public function create_handlerFrontline($data) {
		$this->db->insert('course_handler_tbl', $data);
        $id = $this->db->insert_id();
		return $id;
	}
	
	public function update_handlerRIC($id, $ric) {
		$this->db->set('staff_id_ric', $ric);
		$this->db->where('course_handler_id', $id);
		$this->db->update('course_handler_tbl');
		return $id;
	}
	

	public function update_handlerFrontline($id, $frontline) {
		$this->db->set('staff_id_frontline', $frontline);
		$this->db->where('course_handler_id', $id);
		$this->db->update('course_handler_tbl');
		return $id;
	}

	public function feedbackRatings($type){
		$query = $this->db->query('SELECT CAST(AVG (user_friendly) AS DECIMAL (12,2)) AS ratingAVG FROM feedback_tbl WHERE student_type IN ('.$type.')');
        return $query->row();
	}
	
	
	public function suggestions($type) {
		$query = $this->db->query("SELECT * FROM feedback_tbl WHERE suggestion IS NOT NULL AND student_type IN (".$type.") ORDER BY date_created DESC");
		return $query->result();
	}



	public function getMaintenanceStatus() {
		$query = $this->db->get('maintenance_tbl');
		return $query->row();
	}


	public function setMaintenanceStatus($status) {
		$this->db->query("UPDATE maintenance_tbl SET status = '".$status."' WHERE id = '1'");
	}


	public function getFeedbackResult($dateFrom, $dateTo) {
		$query = $this->db->query("SELECT * FROM feedback_tbl WHERE CONVERT(date_created, DATE) BETWEEN '$dateFrom' AND '$dateTo'");
		return $query->result();
	}


	public function getFeedbackAverage($dateFrom, $dateTo, $student_type) {
		$query = $this->db->query("SELECT AVG(user_friendly) AS average FROM feedback_tbl WHERE CONVERT(date_created, DATE) BETWEEN '$dateFrom' AND '$dateTo' AND student_type IN ($student_type)");
		return $query->row();
	}


	public function getFeedbackCount($dateFrom, $dateTo, $student_type) {
		$query = $this->db->query("SELECT COUNT(*) AS count FROM feedback_tbl WHERE CONVERT(date_created, DATE) BETWEEN '$dateFrom' AND '$dateTo' AND student_type IN ($student_type)");
		return $query->row();
	}

	public function getStaffAccountsActive() {
		$query = $this->db->query("SELECT * FROM staff_account_tbl WHERE account_status = 1 ORDER BY staff_type ASC");
		return $query->result();
	}

	public function getStaffCourseHandled($staff_id) {
		$query = $this->db->query("SELECT * FROM course_handler_tbl WHERE (staff_id_ric = $staff_id OR staff_id_frontline = $staff_id)");
		return $query->result();
	}

	public function getCourseData($course_id) {
		$query = $this->db->query("SELECT * FROM admissions.tbl_course WHERE course_id = '$course_id'");
		return $query->row();
	}

	public function getCountTotalRequest($dateFrom, $dateTo, $student_type) {
		$query = $this->db->query("SELECT COUNT(*) AS count from request_tbl WHERE CONVERT(date_created, DATE) BETWEEN '$dateFrom' AND '$dateTo' AND student_type in ($student_type)");
		return $query->row();
	}

	public function getCountRequest($dateFrom, $dateTo, $status, $student_type) {
		$query = $this->db->query("SELECT COUNT(*) AS count from request_tbl WHERE CONVERT(date_created, DATE) BETWEEN '$dateFrom' AND '$dateTo' AND status IN($status) AND student_type IN ($student_type)");
		return $query->row();
	}

	public function getCountDocumentRequest($dateFrom, $dateTo, $status, $student_type) {
		$query = $this->db->query("SELECT * from request_tbl WHERE CONVERT(date_created, DATE) BETWEEN '$dateFrom' AND '$dateTo' AND student_type IN ($student_type) AND status IN ($status)");
		return $query->result();
	}

	public function getCountDocs($request_id) {
		$query = $this->db->query("SELECT * from document_request_tbl WHERE request_id = '$request_id'");
		return $query->result();
	}


	public function getAllStaffActive() {
		$query = $this->db->query("SELECT * from staff_account_tbl WHERE account_status = 1 ORDER BY staff_type ASC");
		return $query->result();
	}


	public function getStaffStatus($staff_id, $request_type, $status, $dateFrom, $dateTo) {
		$query = $this->db->query("SELECT COUNT(*) as count from request_log, request_tbl JOIN document_request_tbl WHERE request_log.request_id = request_tbl.request_id AND request_log.staff_id = '$staff_id' AND document_request_tbl.request_id = request_log.request_id AND CONVERT(request_tbl.date_created, DATE) BETWEEN '$dateFrom' AND '$dateTo' AND document_request_tbl.document_type = '$request_type' and request_log.status IN ($status);");
		return $query->row();
	}

	public function getStaffStatusPending($staff_id, $request_type, $status, $student_type, $dateFrom, $dateTo) {
		$query = $this->db->query("SELECT COUNT(*) as count from request_tbl, document_request_tbl JOIN course_handler_tbl WHERE request_tbl.request_id = document_request_tbl.request_id AND request_tbl.status IN ($status) AND CONVERT(request_tbl.date_created, DATE) BETWEEN '$dateFrom' AND '$dateTo' AND course_handler_tbl.course_id = request_tbl.course_id AND (course_handler_tbl.staff_id_ric = '$staff_id' OR course_handler_tbl.staff_id_frontline = '$staff_id') AND document_request_tbl.document_type = '$request_type' AND request_tbl.student_type = '$student_type'");
		return $query->row();
	}

	public function getAllPendingRequests() {
		$query = $this->db->query("SELECT * FROM request_tbl, requestor_info_tbl WHERE request_tbl.request_id = requestor_info_tbl.request_id AND request_tbl.status IN (1,2,4,5,6,7)");
		return $query->result();
	}

	public function getCountRequestChart($status, $month, $year) {
		$query = $this->db->query("SELECT COUNT(*) as count FROM request_tbl WHERE status IN ($status) AND Month(date_created) = $month AND YEAR(date_created) = $year");
		return $query->row();
	}


	public function getCountDocumentRequestChart($month, $request_type, $year) {
		$query = $this->db->query("SELECT COUNT(*) as count FROM document_request_tbl WHERE Month(date_created) = '$month' AND YEAR(date_created) = $year AND document_type = '$request_type'");
		return $query->row();
	}

}