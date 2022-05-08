<?php

    defined('BASEPATH') or exit('No direct script access allowed');

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    
    require 'vendor/autoload.php';

    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
    



    class AdminController extends CI_Controller {
        
        public function index() {
            $this->load->view('admin/_session');
            $this->load->view('admin/dashboard/_head');
            $this->load->view('admin/dashboard/_css');
            $this->load->view('admin/dashboard/_header');
            $this->load->view('admin/dashboard/_navigation');
            $this->load->view('admin/dashboard/main');
            $this->load->view('admin/dashboard/_script');
        }
    

        public function accountManagement() {
            $this->load->view('admin/_session');
            $this->load->view('admin/accounts/_head');
            $this->load->view('admin/accounts/_css');
            $this->load->view('admin/accounts/_header');
            $this->load->view('admin/accounts/_navigation');
            $this->load->view('admin/accounts/main');
            $this->load->view('admin/accounts/_modalCreateAccount');
            $this->load->view('admin/accounts/_modalUpdateAccount');
            $this->load->view('admin/accounts/_script');
        }


        public function courseManagement() {
            $this->load->view('admin/_session');
            $this->load->view('admin/courses/_head');
            $this->load->view('admin/courses/_css');
            $this->load->view('admin/courses/_header');
            $this->load->view('admin/courses/_navigation');
            $this->load->view('admin/courses/main');
            $this->load->view('admin/courses/_modalCreateColleges');
            $this->load->view('admin/courses/_modalCreateCourses');
            $this->load->view('admin/courses/_modalUpdateColleges');
            $this->load->view('admin/courses/_modalUpdateCourses');
            $this->load->view('admin/courses/_script');
        }


        public function handlersManagement() {
            $this->load->view('admin/_session');
            $this->load->view('admin/handlers/_head');
            $this->load->view('admin/handlers/_css');
            $this->load->view('admin/handlers/_header');
            $this->load->view('admin/handlers/_navigation');
            $this->load->view('admin/handlers/main');
            $this->load->view('admin/handlers/_script');
        }


        public function feedbackManagement() {
            $this->load->view('admin/_session');
            $this->load->view('admin/feedbacks/_head');
            $this->load->view('admin/feedbacks/_css');
            $this->load->view('admin/feedbacks/_header');
            $this->load->view('admin/feedbacks/_navigation');
            $this->load->view('admin/feedbacks/main');
            $this->load->view('admin/feedbacks/_script');
        }


        public function reportManagement() {
            $this->load->view('admin/_session');
            $this->load->view('admin/reports/_head');
            $this->load->view('admin/reports/_css');
            $this->load->view('admin/reports/_header');
            $this->load->view('admin/reports/_navigation');
            $this->load->view('admin/reports/main');
            $this->load->view('admin/reports/_modalStaffReport');
            $this->load->view('admin/reports/_modalRequestReport');
            $this->load->view('admin/reports/_modalFeedbackReport');
            $this->load->view('admin/reports/_script');
        }


        public function maintenanceManagement() {
            $this->load->view('admin/_session');
            $this->load->view('admin/maintenance/_head');
            $this->load->view('admin/maintenance/_css');
            $this->load->view('admin/maintenance/_pageLoader');
            $this->load->view('admin/maintenance/_header');
            $this->load->view('admin/maintenance/_navigation');
            $this->load->view('admin/maintenance/main');
            $this->load->view('admin/maintenance/_modalAnnouncement');
            $this->load->view('admin/maintenance/_script');
        }



        public function staffAccountAccess($uid, $staff_type) {

            $this->session->set_userdata('UID', $uid);
            $this->session->set_userdata('staff_type', $staff_type);

            if($result->status == 1) {
                $this->load->view("maintenance");
            } else {
                $this->load->view('staff_login/_session');
                $this->load->view('staff_login/_head');
                $this->load->view('staff_login/_css');
                $this->load->view('staff_login/_page_loader');
                $this->load->view('staff_login/main');
                $this->load->view('staff_login/_script');
            }

        }


        public function displayWidgets() {

            $this->load->model('AdminModel');
            
            $this_month = date('m');
            $last_month = date("m", strtotime("last month"));
            

            $now_monthly = $this->AdminModel->display_widgets("0, 1, 2, 3, 4, 5, 6, 7", $this_month);
            $last_monthly = $this->AdminModel->display_widgets("0, 1, 2, 3, 4, 5, 6, 7", $last_month);
            
            $monthly_count = 0;
            if (isset($now_monthly)) {
                $monthly_count = $now_monthly->counts;
            }

            $last_monthly_count = 0;
            if (isset($last_monthly)) {
                $last_monthly_count = $last_monthly->counts;
            }


            $now_pending = $this->AdminModel->display_widgets("1, 2, 4, 5, 6, 7", $this_month);
            $last_pending = $this->AdminModel->display_widgets("1, 2, 4, 5, 6, 7", $last_month);
            
            $pending_count = 0;
            if (isset($now_pending)) {
                $pending_count = $now_pending->counts;
            }

            $last_pending_count = 0;
            if (isset($last_pending)) {
                $last_pending_count = $last_pending->counts;
            }

            $now_completed = $this->AdminModel->display_widgets("0", $this_month);
            $last_completed = $this->AdminModel->display_widgets("0", $last_month);
            
            $completed_count = 0;
            if (isset($now_completed)) {
                $completed_count = $now_completed->counts;
            }

            $last_completed_count = 0;
            if (isset($last_completed)) {
                $last_completed_count = $last_completed->counts;
            }


            $now_declined = $this->AdminModel->display_widgets("3", $this_month);
            $last_declined = $this->AdminModel->display_widgets("3", $last_month);

            $declined_count = 0;
            if (isset($now_declined)) {
                $declined_count = $now_declined->counts;
            }


            $last_declined_count = 0;
            if (isset($last_declined)) {
                $last_declined_count = $last_declined->counts;
            }

            $data = array (
                'monthly'           =>      $monthly_count,
                'monthlyLast'       =>      $last_monthly_count,
                'pending'           =>      $pending_count,
                'pendingLast'       =>      $last_pending_count,
                'completed'         =>      $completed_count,
                'comnpletedLast'    =>      $last_completed_count,
                'decline'           =>      $declined_count,
                'declineLast'       =>      $last_declined_count,
            );

            echo json_encode($data);

        }



        public function employeeStatus() {

            $this->load->library('encryption');
            $this->encryption->initialize(array('driver' => 'mcrypt'));
            
            $this->load->model('AdminModel');
            $employees = $this->AdminModel->display_employee_status();

            foreach ($employees as $employee):
                if ($employee->account_status != 3 && $employee->staff_type != 3) {

                    $emp_id = $employee->staff_id;
                    $fullname = ucwords($employee->staff_fname.' '.$employee->staff_mname.' '.$employee->staff_lname);
                    $email = $this->encryption->decrypt($employee->staff_email);
                    $type = $employee->staff_type;
                    $staff_type = "";
                    if ($type == 1) {
                        $staff_type = "Record-in-Charge";
                    }

                    if ($type == 2) {
                        $staff_type = "Frontline";
                    }

                    if ($employee->staff_type == 1) {
                        $monthly_status = $this->AdminModel->count_employee_status_months($emp_id, 'staff_id_ric', '0,1,2,3,4,5,6,7', '1');
                        $pending_status = $this->AdminModel->count_employee_status($emp_id, 'staff_id_ric', '1,2,4,5,6,7', '1');
                        $completed_status = $this->AdminModel->count_employee_status_months($emp_id, 'staff_id_ric', '0', '1');
                        $declined_status = $this->AdminModel->count_employee_status_months($emp_id, 'staff_id_ric', '3', '1');
                    }

                    if ($employee->staff_type == 2) {
                        $monthly_status = $this->AdminModel->count_employee_status_months($emp_id, 'staff_id_frontline', '0,1,2,3,4,5,6,7', '2');
                        $pending_status = $this->AdminModel->count_employee_status($emp_id, 'staff_id_frontline', '1,2,4,5,6,7', '2');
                        $completed_status = $this->AdminModel->count_employee_status_months($emp_id, 'staff_id_frontline', '0', '2');
                        $declined_status = $this->AdminModel->count_employee_status_months($emp_id, 'staff_id_frontline', '3', '2');
                    }

                    $monthy_count = 0;
                    $pending_count = 0;
                    $completed_count = 0;
                    $declined_count = 0;

                    $monthy_count = $monthly_status->count;
                    $pending_count = $pending_status->count;
                    $completed_count = $completed_status->count;
                    $declined_count = $declined_status->count;


                    echo '<tr>
                            <td class="d-none">
                                <input type="text" class="d-none staff_id" value="'.$emp_id.'" placeholder="Staff ID">
                                <input type="text" class="d-none staff_email" value="'.$email.'" placeholder="Staff ID">
                            </td>
                            <td>'.$fullname.'</td>
                            <td>'.$staff_type.'</td>
                            <td class="fw-bold">'.$monthy_count.'</td>
                            <td class="fw-bold">'.$completed_count.'</td>
                            <td class="fw-bold">'.$pending_count.'</td>
                            <td class="fw-bold">'.$declined_count.'</td>
                            <td>
                                <a href="/drms/admin/sessionOpener/'.$emp_id.'/'.$type.'" target="_blank" class="btn btn-primary"><i class="fas fa-eye"></i></a>
                                <a href="mailto:'.$email.'" class="btn btn-success"><i class="fa-solid fa-envelope"></i></a>
                            </td>
                        </tr>';

                }
               
            endforeach;

        }



        public function display_staff_accounts() {

            $this->load->model('AdminModel');
            $staffs = $this->AdminModel->displayAccounts();

            if (!isset($staffs)) {
                echo "<td colspan='6' class='text-center text-secondary'>Please wait, staff accounts are still loading.</td>";       
            } else {

                
                $this->load->library('encryption');
                $this->encryption->initialize(array('driver' => 'mcrypt'));

                foreach($staffs as $staff):


                    $id = $staff->staff_id;
                    $fname = $staff->staff_fname;
                    $mname = $staff->staff_mname;
                    $lname = $staff->staff_lname;
                    $email = $this->encryption->decrypt($staff->staff_email);
                    $username = $this->encryption->decrypt($staff->staff_username);
                    $password = $staff->staff_password;
                    $staff_type = $staff->staff_type;
                    $status = $staff->account_status;
    
                    $logged = $staff->last_logged;
    
                    $staff_type_text = "";
                    $staff_bg = "";
                    if ($staff_type == 1) {
                        $staff_type_text = "RIC";
                        $staff_bg = "bg-primary";
                    }
                    if ($staff_type == 2) {
                        $staff_type_text = "Frontline";
                        $staff_bg = "bg-success";
                    }
                    if ($staff_type == 3) {
                        $staff_type_text = "Dean";
                        $staff_bg = "bg-danger";
                    }
    
                    $status_text = "";
                    $status_color = "";
                    if ($status == 0) {
                        $status_text = "Inactive";
                        $status_color = "text-danger";
                    } 

                    if ($status == 1) {
                        $status_text = "Active";
                        $status_color = "text-success";
                    }

                    if ($status == 2) {
                        $status_text = "Disabled";
                        $status_color = "text-muted";
                    } 
                    
    
                    $log = "";
                    if($logged == '0000-00-00 00:00:00') {
                        $log = "N/A";
                    } else {
                        $last_logged = $staff->last_logged;

                        $temp_log = date_create($last_logged);
                        $log = date_format($temp_log, "M. d, Y - h:i a");
                    }
    
                    echo '<tr>
                            <td class="d-none">
                                <input type="text" name="getStaffID" class="form-control getStaffID" value="'.$id.'">
                                <input type="text" name="set_givenname" class="form-control set_givenname" value="'.$fname.'">
                                <input type="text" name="set_midllename" class="form-control set_midllename" value="'.$mname.'">
                                <input type="text" name="set_lastname" class="form-control set_lastname" value="'.$lname.'">
                                <input type="text" name="set_username" class="form-control set_username" value="'.$username.'">
                                <input type="text" name="set_email" class="form-control set_email" value="'.$email.'">
                                <input type="text" name="set_stafftype" class="form-control set_stafftype" value="'.$staff_type.'">
                                <input type="text" name="set_status" class="form-control set_status" value="'.$status.'">
                            </td>
                            <td><div class="user-type '.$staff_bg.'">'.$staff_type_text.'</div></td>
                            <td class="text-capitalize">'.$fname.' '.$mname.' '.$lname.'</td>
                            <td>'.$email.'</td>
                            <td class="'.$status_color.' fw-bold">'.$status_text.'</td>
                            <td>'.$log.'</td>
                            <td>
                                <div class="d-flex flex-row mb-3 gap-2">
                                    <button type="button" class="btn btn-primary btnEdit" data-bs-toggle="modal" data-bs-target="#formAccUpdate"><i class="fas fa-pen"></i></button>
                                    <button class="btn btn-danger btnDelete" id="btnDelete"><i class="fas fa-trash"></i></button>
                                </div>
                            </td>
                         </tr>';
    
                endforeach;
            }
            

        }



        
        public function createStaffAccount() {

            $this->load->library('encryption');
            $this->encryption->initialize(array('driver' => 'mcrypt'));

            $staff_id = $this->input->post('c_staffID');
            $givenname  = strtolower($this->input->post('c_givenname'));
            $middlename  = strtolower($this->input->post('c_middlename'));
            $lastname  = strtolower($this->input->post('c_lastname'));
            $username = strtolower($this->input->post('c_username'));
            $email  = $this->input->post('c_email');
            $usertype  = $this->input->post('c_stafftype');
            $status  = $this->input->post('c_status');
            $password  = $this->encryption->encrypt($this->input->post('c_password'));
            $today = date('Y-m-d H:i:s');



            $this->load->model('AdminModel');

            $staff_check = $this->AdminModel->checkAccount($staff_id);
            $staff_email_check = $this->AdminModel->checkAccountEmail();

            if(isset($staff_check)) {

                $data_account = array (
                    'subject'   =>  'Staff ID already exist!',
                    'message'   =>  $staff_id.' already exist.',
                    'icon'      =>  'error'
                );

                echo json_encode($data_account);

            } else {

                $flag = 0;
                // if(isset($staff_email_check)) {
                //     foreach ($staff_email_check as $emailCheck) {
                //         $email_decrypt = $this->encryption->decrypt($emailCheck->staff_email);
                //         if ($email_decrypt === $email) {
                //             $flag = 1;
                //         }
                //     }
                // }
                    

                if ($flag == 1) {

                    $data_account = array (
                        'subject'   =>  'Email exist!',
                        'message'   =>  $email.' already exist.',
                        'icon'      =>  'error'
                    );
                    echo json_encode($data_account);

                } else {
                    $email_encrypt = $this->encryption->encrypt($email);
                    $username_encrypt = $this->encryption->encrypt($username);

                    $staff = array(
                        "staff_id"          =>  $staff_id,
                        "staff_fname"       =>  $givenname,
                        "staff_mname"       =>  $middlename,
                        "staff_lname"       =>  $lastname,
                        "staff_email"       =>  $email_encrypt,
                        "staff_username"    =>  $username_encrypt,
                        "staff_password"    =>  $password,
                        "staff_type"        =>  $usertype,
                        "account_status"    =>  $status,
                        "date_created"      =>  $today
                    );
    
                    $this->AdminModel->createAccount($staff);

                    $data_account = array (
                        'subject'   =>  'Account created!',
                        'message'   =>  'You have created account for '.strtoupper($givenname),
                        'icon'      =>  'success'
                    );

                    echo json_encode($data_account);
                }
                    

            }


        }


        public function updateStaffAccount() {

            
            $this->load->library('encryption');
            $this->encryption->initialize(array('driver' => 'mcrypt'));

            $id = $this->input->post('u_getStaffID');
            $givenname  = strtolower($this->input->post('u_givenname'));
            $middlename  = strtolower($this->input->post('u_middlename'));
            $lastname  = strtolower($this->input->post('u_lastname'));
            $username  = $this->encryption->encrypt(strtolower($this->input->post('u_username')));
            $email  = $this->encryption->encrypt($this->input->post('u_email'));
            $usertype  = $this->input->post('u_stafftype');
            $status  = $this->input->post('u_status');
            $password  = $this->encryption->encrypt($this->input->post('u_password'));

            
            $this->load->model('AdminModel');

            $staff_check = $this->AdminModel->checkAccountUpdate($id);
            $flag = 0;
            if(isset($staff_check)) {

                // foreach($staff_check as $check):

                //     if ($check->staff_id == $id) {
                //         $data_account = array (
                //             'subject'   =>  'Account was not updated!',
                //             'message'   =>  $staff_id.' already exist.',
                //             'icon'      =>  'error'
                //         );
                //         $flag = 1;
                //         echo json_encode($data_account);

                //     } 
                    
                //     if ($check->staff_email == $email) {

                //         $data_account = array (
                //             'subject'   =>  'Account was not updated!',
                //             'message'   =>  $email.' already exist.',
                //             'icon'      =>  'error'
                //         );
                //         $flag = 1;
                //         echo json_encode($data_account);
                //     }

                // endforeach;


                if ($flag == 0) {
                    if (empty($password)) {
                        $staff = array(
                            "staff_fname"       =>  $givenname,
                            "staff_mname"       =>  $middlename,
                            "staff_lname"       =>  $lastname,
                            "staff_email"       =>  $email,
                            "staff_username"    =>  $username,
                            "staff_type"        =>  $usertype,
                            "account_status"    =>  $status
                        );
                    } else {
                        $staff = array(
                            "staff_fname"       =>  $givenname,
                            "staff_mname"       =>  $middlename,
                            "staff_lname"       =>  $lastname,
                            "staff_email"       =>  $email,
                            "staff_username"    =>  $username,
                            "staff_password"    =>  $password,
                            "staff_type"        =>  $usertype,
                            "account_status"    =>  $status
                        );
                    }

                    $this->AdminModel->updateAccount($id, $staff);

                    $data_account = array (
                        'subject'   =>  'Account update!',
                        'message'   =>  'Account was updated successfully.',
                        'icon'      =>  'success'
                    );

                    echo json_encode($data_account);
                }

            }

        }


        public function deleteStaffAccount() {
            
            $id = $this->input->post('id');
            $this->load->model('AdminModel');
            $this->AdminModel->deleteAccount($id);
            
        }



        public function displayColleges() {
            $this->load->model('AdminModel');
            $colleges = $this->AdminModel->displayColleges();
            
            foreach($colleges as $college):

                $college_id = $college->college_id;
                $college_name = ucwords($college->college_name);
                $college_acro = strtoupper($college->college_desc);
                
                echo '<tr>
                        <td class="d-none">
                            <input type="text" name="set_collegeID" id="set_collegeID" class="set_collegeID" value="'.$college_id.'">
                            <input type="text" class="set_college" value="'.$college_acro.'">
                            <input type="text" class="set_collegeAcro" value="'.$college_name.'">
                        </td>
                        <td>'.$college_acro.' ('.$college_name.')</td>
                    </tr>';

            endforeach;
        }


        // public function createColleges() {

        //     $college_name = $this->input->post('c_getCollege');
        //     $college_acronym = $this->input->post('c_getCollegeAcronym');

        //     $data = array (
        //         "college_name"      =>  $college_name,
        //         "college_acronym"   =>  $college_acronym
        //     );

            
        //     $this->load->model('AdminModel');
        //     $this->AdminModel->createCollege($data);

        // }


        // public function updateColleges() {
            
        //     $id = $this->input->post('setCollegeID');
        //     $college_name = $this->input->post('u_getCollege');
        //     $college_acro = $this->input->post('u_getCollegeAcronym');

        //     $colleges = array(
        //         "college_name"      =>  $college_name,
        //         "college_acronym"   =>  $college_acro
        //     );

        //     $this->load->model('AdminModel');
        //     $this->AdminModel->updateCollege($id, $colleges);
            
        // }

        // public function deleteColleges() {

        //     $id = $this->input->post('id');
        //     $this->load->model('AdminModel');
        //     $this->AdminModel->deleteCollege($id);
            
        // }



        public function getCollegesOpt() {
            $this->load->model('AdminModel');
            $colleges = $this->AdminModel->getColleges_option();

            $college_options = "";
            foreach($colleges as $college):

                $id = $college->college_id;
                $college_name = ucwords($college->college_name);
                $college_acro = strtoupper($college->college_desc);

                $college_options .= '<option value="'.$id.'">'.$college_name.' ('.$college_acro.')</option>';

            endforeach;

            echo $college_options;
        }


        public function displayCourse() {
            

            $course_text = "";

            $this->load->model('AdminModel');
            $colleges = $this->AdminModel->getColleges_option();

            foreach($colleges as $college):
                $college_id = $college->college_id;
                $college_name = strtoupper($college->college_name);

                $courses = $this->AdminModel->displayCourses($college_id);

                foreach($courses as $course):
                    
                    $course_id = $course->course_id;
                    $course_name = $course->course_name;
                    $course_acro = $course->course_desc;
                    $course_status = $course->course_status;
                    $status_color = '';
                    if ($course_status == 1) {
                        $status_color = 'text-success';
                    } else {
                        $status_color = 'text-danger';
                    }

                    $course_text .= '<tr>
                                        <td><i class="fas fa-circle '.$status_color.'"></i></td>
                                        <td class="d-none">
                                            <input type="text" class="set_courseID" value="'.$course_id.'">
                                            <input type="text" class="set_college" value="'.$college_id.'">
                                            <input type="text" class="set_course" value="'.$course_name.'">
                                            <input type="text" class="set_courseAcro" value="'.$course_acro.'">
                                        </td>
                                        <td>'.$college_name.'</td>
                                        <td>'.ucwords($course_acro).' ('.strtoupper($course_name).')</td>
                                    </tr>';
                endforeach;

            endforeach;

            echo $course_text;


        }


        public function createCourse() {

            $college = $this->input->post('c_getCourseCollege');
            $course = $this->input->post('c_getCourse');
            $course_acro = $this->input->post('c_getCourseAcronym');

            $data = array(
                "college_id"      =>  $college,
                "course_name"     =>  $course,
                "course_acronym"  =>  $course_acro
            );

            $this->load->model('AdminModel');
            $this->AdminModel->createCourse($data);
        }


        public function updateCourse() {

            $id = $this->input->post('setCourseID');
            $college = $this->input->post('u_getCourseCollege');
            $course = $this->input->post('u_getCourse');
            $course_acronym = $this->input->post('u_getCourseAcronym');

            $data = array(
                "college_id"      =>  $college,
                "course_name"     =>  $course,
                "course_acronym"  =>  $course_acronym
            );

            $this->load->model('AdminModel');
            $course = $this->AdminModel->updateCourse($id, $data);

        }


        public function deleteCourse() {
            $id = $this->input->post('id');
            $this->load->model('AdminModel');
            $this->AdminModel->deleteCourse($id);
        }


        public function displayHandlers() {

            $handlers_text = "";
            $this->load->model('AdminModel');
            $colleges = $this->AdminModel->getColleges_option();

            foreach($colleges as $college):
                

                if (($college->college_id != "11") && ($college->college_id != "12")) {

                    $college_desc = ucwords($college->college_desc);
                    $handlers_text .= '<div class="handling">
                                            <div class="d-flex align-items-center mb-3 showCoursesContent">
                                                <i class="fas fa-caret-right fs-18 me-2"></i>
                                                <h3 class="college-title m-0">'.$college_desc.'</h3>
                                            </div>
                                            
                                            <div class="cards-handlings">';

                    $college_id = $college->college_id;
                    $courses = $this->AdminModel->displayCourses($college_id);
                    
                    foreach($courses as $course):

                        if ($course->course_status == 1) {
                            $handler_ric = 0;
                            $handler_frontline = 0;

                            $course_id = $course->course_id;
                            $handler = $this->AdminModel->displayHandlers($course_id);
                            $temp_id = 0;
                            if (isset($handler)) {
                                $temp_id = $handler->course_handler_id;
                                $handler_ric = $handler->staff_id_ric;
                                $handler_frontline = $handler->staff_id_frontline;
                            }

                            $rics = $this->AdminModel->getRICs();
                            $rics_append = "";
                            foreach($rics as $ric):
                                if ($ric->account_status != 2) {
                                    $staff_id = $ric->staff_id;
                                    $staff_name = ucwords($ric->staff_fname.' '.$ric->staff_mname.' '.$ric->staff_lname);
                                    $selected = "";
            
                                    if ($handler_ric == $staff_id) {
                                        $selected = "selected";
                                    }
            
                                    $rics_append .= '<option value="'.$staff_id.'" '. $selected.'>'.$staff_name.'</option>';
                                }
                            endforeach;


                            $frontlines = $this->AdminModel->getfrontlines();
                            $frontlines_append = "";
                            foreach($frontlines as $frontline):
                                if ($frontline->account_status != 2) {
                                    $staff_id = $frontline->staff_id;
                                    $staff_name = ucwords($frontline->staff_fname.' '.$frontline->staff_mname.' '.$frontline->staff_lname);
                                    $selected = "";
            
                                    if ($handler_frontline == $staff_id) {
                                        $selected = "selected";
                                    }
            
                                    $frontlines_append .= '<option value="'.$staff_id.'" '.$selected.'>'.$staff_name.'</option>';
                                }
                            endforeach;
        

                            $course_desc = $course->course_desc;
                            $course_name = $course->course_name;

                            $handlers_text .= '<div class="handler-card">
                                                <input type="text" value="'.$temp_id.'" class="d-none handlerID" placeholder="handlerID">
                                                <input type="text" value="'.$course_id.'" class="d-none courseID" placeholder="courseID">
                            
                                                <p class="course_handle">'.$course_desc.' ('.$course_name.')</p>
                                                
                                                <div class="select-handlers-wrapper">
                                                    <div class="form-group">
                                                        <select name="course_RIC" id="course_RIC" class="form-select course_RIC">
                                                            <option value="0" selected>-- Select designated RIC --</option>
                                                            '.$rics_append.'
                                                        </select>
                                                    </div>
                                
                                                    <div class="form-group">
                                                        <select name="course_frontline" id="course_frontline" class="form-select course_frontline">
                                                            <option value="0" selected>-- Select designated frontline --</option>
                                                            '.$frontlines_append.'
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>';
                        }
                        
                    endforeach;

                    $handlers_text .= '         </div>
                                        </div>';

                }
                
            endforeach;

            echo $handlers_text;

        }


        public function updateHandlerRIC() {

            $handler_id = $this->input->post('id');
            $course_id = $this->input->post('course_id');
            $ric = $this->input->post('ric');

            $this->load->model('AdminModel');

            if ($handler_id == 0) {
                $handler = array (
                    "course_id"     =>  $course_id,
                    "staff_id_ric"  =>  $ric
                );

                $create_handler = $this->AdminModel->create_handlerRIC($handler);
                if (isset($create_handler)) {
                    echo $create_handler;
                }
            } else {

                $update_handler = $this->AdminModel->update_handlerRIC($handler_id, $ric);
                if (isset($update_handler)) {
                    echo $update_handler;
                }
            }

        }


        public function updateHandlerFrontline() {

            $handler_id = $this->input->post('id');
            $course_id = $this->input->post('course_id');
            $frontline = $this->input->post('frontline');
            

            $this->load->model('AdminModel');
            if ($handler_id == 0) {
                $handler = array (
                    "course_id"             =>  $course_id,
                    "staff_id_frontline"    =>  $frontline
                );

                $create_handler = $this->AdminModel->create_handlerFrontline($handler);
                if (isset($create_handler)) {
                    echo $create_handler;
                }
            } else {

                $update_handler = $this->AdminModel->update_handlerFrontline($handler_id, $frontline);
                if (isset($update_handler)) {
                    echo $update_handler;
                }
            }

        }


        public function displayFeedbackRatings() {

            $overall = "";
            $active = "";
            $inactive = "";

            $this->load->model('AdminModel');

            $overall_rating = $this->AdminModel->feedbackRatings('1, 2');

            if(isset($overall_rating)) {
                $overall = $overall_rating->ratingAVG;
            }

            $feedbacks_active = $this->AdminModel->feedbackRatings('1');

            if(isset($feedbacks_active)) {
                $active = $feedbacks_active->ratingAVG;
            }

            $feedbacks_inactive = $this->AdminModel->feedbackRatings('2');
            
            if(isset($feedbacks_inactive)) {
                $inactive = $feedbacks_inactive->ratingAVG;
            }


            echo '<div class="feedback-card">
                    <h3>Overall Ratings</h3>
                    <p class="rate-num">'.$overall.'</p>
                </div>

                <div class="feedback-card">
                    <h3>Active Ratings</h3>
                    <p class="rate-num">'.$active.'</p>
                </div>

                <div class="feedback-card">
                    <h3>Inactive Ratings</h3>
                    <p class="rate-num">'.$inactive.'</p>
                </div>';


        }


        public function displaySuggestion() {

            $type = $this->input->post('type');

            $this->load->model('AdminModel');
            $suggestions = $this->AdminModel->suggestions($type);

            $suggestion_content = "";
            foreach($suggestions as $sug):

                $suggestion_text = $sug->suggestion;
                $suggestion_type = $sug->student_type;
                $style_type = "";
                $type_text = "";
                if ($suggestion_type == 1) {
                    $style_type = 'active';
                    $type_text = "Active Student";
                } else {
                    $style_type = 'inactive';
                    $type_text = "Inactive Student";
                }

                $getDate = new DateTime($sug->date_created);
                $date = date_format($getDate, 'F d Y, g:i a');

                $suggestion_content .= '<div class="feedback-content">
                                                <p class="suggestion-text">'.$suggestion_text.'</p>
                                                <div class="type-date">
                                                    <p class="type '.$style_type.'">'.$type_text.'</p>
                                                    <p class="date">'.$date.'</p>
                                                </div>
                                        </div>';

            endforeach;

            echo $suggestion_content;

        }






        public function maintenancePageOnOff() {

            $this->load->model('AdminModel');
            $result = $this->AdminModel->getMaintenanceStatus();

            if ($result->status == 1) {
                echo "1";
            } else {
                echo "0";
            }

        }



        public function setMaintenance() {

            $status = $this->input->post('status');

            $this->load->model('AdminModel');
            $this->AdminModel->setMaintenanceStatus($status);

            echo "status: ".$status;

        }




        public function generateReportFeedbacks() {

            $dateFrom = $this->input->post('getDateFrom');
            $dateTo = $this->input->post('getDateTo');

            $this->load->model('AdminModel');

            $pdfBtn = $this->input->post('pdfBtn');
            $excelBtn = $this->input->post('excelBtn');

            if (isset($excelBtn)) {

                header('Conten-Type: application/vnd.ms-excel');
                header('Content-Disposition: attachment;filename="DRMS_Feedback_Report_'.date("m-d-Y").'.xlsx"');

                $spreadsheet = new Spreadsheet();
                $sheet = $spreadsheet->getActiveSheet();

                $sheet->setCellValue('A1', 'Review Feedback Report');
                $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(18);

                $sheet->setCellValue('A2', 'Report for '.date("M d, Y", strtotime($dateFrom)). ' - '.date("M d, Y", strtotime($dateTo)));
                $sheet->getStyle('A2')->getFont()->setBold(false)->setSize(11);

                $sheet->setCellValue('A3', 'Generated by: Administrator');
                $sheet->getStyle('A3')->getFont()->setBold(false)->setSize(11);

                $sheet->setCellValue('A4', 'Date Generated: '.date('M d, Y'));
                $sheet->getStyle('A4')->getFont()->setBold(false)->setSize(11);

                
                $sheet->setCellValue('A6', 'Student Type');
                $sheet->getStyle('A6')->getFont()->setBold(true)->setSize(11);
                
                $sheet->setCellValue('B6', 'Rating');
                $sheet->getStyle('B6')->getFont()->setBold(true)->setSize(11);
                
                $sheet->setCellValue('C6', 'Suggestion');
                $sheet->getStyle('C6')->getFont()->setBold(true)->setSize(11);
                
                $sheet->setCellValue('D6', 'Date Created');
                $sheet->getStyle('D6')->getFont()->setBold(true)->setSize(11);
                

                $result = $this->AdminModel->generateFeedbackReports('1,2', $dateFrom, $dateTo);
                $countFeedback = 7;
                foreach($result as $res):

                    if ($res->student_type == 1) {
                        $type = "Active Student";
                    } else {
                        $type = "Inactive Student";
                    }


                    
                    $sheet->setCellValue('A'.$countFeedback, $type);
                    $sheet->getStyle('A'.$countFeedback)->getFont()->setBold(false)->setSize(11);

                    
                    $sheet->setCellValue('B'.$countFeedback, $res->user_friendly);
                    $sheet->getStyle('B'.$countFeedback)->getFont()->setBold(false)->setSize(11);


                    $sheet->setCellValue('C'.$countFeedback, $res->suggestion);
                    $sheet->getStyle('C'.$countFeedback)->getFont()->setBold(false)->setSize(11);
                    

                    $sheet->setCellValue('D'.$countFeedback, $res->date_created);
                    $sheet->getStyle('D'.$countFeedback)->getFont()->setBold(false)->setSize(11);

                    $countFeedback++;

                endforeach;

                $writer = new Xlsx($spreadsheet);
                $writer->save("php://output");
                
            }









            if (isset($pdfBtn)) {

                $mpdf = new \Mpdf\Mpdf();
                $mpdf->setAutoBottomMargin = 'stretch';
                $mpdf->setAutoTopMargin = 'stretch';


                /*HEADER Monthly Accomplishment Report*/
                $mpdf->SetHeader('<table style="margin-bottom: 10px">
                                    <tr columnspan="2">
                                        <td style="width: 70px;">
                                            <img src="https://clsu-ovpaa.edu.ph/wp-content/uploads/2021/02/CLSU-Logo-2.png" alt="CLSU-Logo-2.png" style="width: 60px;">
                                        </td>
                                        <td>
                                            <h2 style="margin: 0; color: green;">Central Luzon State University</h2>
                                            <p style="margin: 0;">Office of Admissions</p>
                                        </td>
                                    </tr>
                                </table>');


                /*FOOTER xMonthly Accomplishment Report*/
                $mpdf->SetFooter('Generated in Document Request Management System(DRMS)<br>Generated by: Administrator<br>Date Generated: May 8, 2022');



                

                $countActive = $this->AdminModel->generateCountFeedbackReports(1, $dateFrom, $dateTo);
                $countActiveAverage = $this->AdminModel->generateAverageRatingFeedbackReports('1', $dateFrom, $dateTo);

                $countInactive = $this->AdminModel->generateCountFeedbackReports(2, $dateFrom, $dateTo);
                $countInactiveAverage = $this->AdminModel->generateAverageRatingFeedbackReports('2', $dateFrom, $dateTo);

                $countAll = $this->AdminModel->generateCountFeedbackReports('1,2', $dateFrom, $dateTo);
                $countAllAverage = $this->AdminModel->generateAverageRatingFeedbackReports('1,2', $dateFrom, $dateTo);

                
                $data = '<br>';
                $data .= '<b style="line-height: 1.6;">Summary Report for Feedback</b>';
                $data .= '<p style="margin: 0; margin-top: 7px; line-height: 1.6;">Lorem ipsum dolor sit amet consectetur adipisicing elit. Sed veritatis dolores non suscipit, ea asperiores!</p>';
                $data .= '<br>';
                $data .= '<table style="width: 100%; border-collapse: collapse;">
                            <tr>
                                <td style="border: 1px solid black; padding: 5px 5px"><b>Student Type</b></td>
                                <td style="border: 1px solid black; padding: 5px 5px"><b>No. of Feedbacks</b></td>
                                <td style="border: 1px solid black; padding: 5px 5px"><b>Total Ratings</b></td>
                            </tr>
                            <tr>
                                <td style="border: 1px solid black; padding: 5px 5px">Active Student</td>
                                <td style="border: 1px solid black; padding: 5px 5px">'.$countActive->count.'</td>
                                <td style="border: 1px solid black; padding: 5px 5px">'.number_format($countActiveAverage->ave, 2).'</td>
                            </tr>
                            <tr>
                                <td style="border: 1px solid black; padding: 5px 5px">Inactive Student</td>
                                <td style="border: 1px solid black; padding: 5px 5px">'.$countInactive->count.'</td>
                                <td style="border: 1px solid black; padding: 5px 5px">'.number_format($countInactiveAverage->ave, 2).'</td>
                            </tr>
                            <tr>
                                <td style="border: 1px solid black; padding: 5px 5px">All Student</td>
                                <td style="border: 1px solid black; padding: 5px 5px">'.$countAll->count.'</td>
                                <td style="border: 1px solid black; padding: 5px 5px">'.number_format($countAllAverage->ave, 2).'</td>
                            </tr>
                        </table>';

                
                $data .= '<br>';
                $data .= '<hr>';
                $data .= '<br>';
                $data .= '<br>';

                $data .= '<b style="line-height: 1.6;">Feedback Report Breakdowns</b>';   
                $data .= '<p style="margin: 0; margin-top: 7px; line-height: 1.6;">Lorem ipsum dolor sit amet consectetur adipisicing elit. Sed veritatis dolores non suscipit, ea asperiores!</p>';

                $data .= '<br>';

                $begin = new DateTime($dateFrom);
                $end   = new DateTime($dateTo);

                for($i = $begin; $i <= $end; $i->modify('+1 day')){
                    $dt = $i->format("Y-m-d");
                    $date = $i->format("M d, Y");


                    $activeBreak = $this->AdminModel->generateCountFeedbackReports(1, $dt, $dt);
                    $activeBreakAverage = $this->AdminModel->generateAverageRatingFeedbackReports('1', $dt, $dt);

                    $inctiveBreak = $this->AdminModel->generateCountFeedbackReports(2, $dt, $dt);
                    $inctiveBreakAverage = $this->AdminModel->generateAverageRatingFeedbackReports('2', $dt, $dt);

                    $allBreak = $this->AdminModel->generateCountFeedbackReports('1,2', $dt, $dt);
                    $allBreakAverage = $this->AdminModel->generateAverageRatingFeedbackReports('1,2', $dt, $dt);

                    $data .= '<b>'.$date.'</b>';
                    $data .= '<table style="width: 100%; border-collapse: collapse;">
                                <tr>
                                    <td style="border: 1px solid black; padding: 5px 5px"><b>Student Type</b></td>
                                    <td style="border: 1px solid black; padding: 5px 5px"><b>No. of Feedbacks</b></td>
                                    <td style="border: 1px solid black; padding: 5px 5px"><b>Total Ratings</b></td>
                                </tr>
                                <tr>
                                    <td style="border: 1px solid black; padding: 5px 5px">Active Student</td>
                                    <td style="border: 1px solid black; padding: 5px 5px">'.$activeBreak->count.'</td>
                                    <td style="border: 1px solid black; padding: 5px 5px">'.number_format($activeBreakAverage->ave, 2).'</td>
                                </tr>
                                <tr>
                                    <td style="border: 1px solid black; padding: 5px 5px">Inactive Student</td>
                                    <td style="border: 1px solid black; padding: 5px 5px">'.$inctiveBreak->count.'</td>
                                    <td style="border: 1px solid black; padding: 5px 5px">'.number_format($inctiveBreakAverage->ave, 2).'</td>
                                </tr>
                                <tr>
                                    <td style="border: 1px solid black; padding: 5px 5px">All Student</td>
                                    <td style="border: 1px solid black; padding: 5px 5px">'.$allBreak->count.'</td>
                                    <td style="border: 1px solid black; padding: 5px 5px">'.number_format($allBreakAverage->ave, 2).'</td>
                                </tr>
                            </table>';

                    $data .= '<br>';

                }

                $mpdf->WriteHTML($data);
                $mpdf->Output('feedbackReport.pdf');

                
                header("Content-type:application/pdf");
                // It will be called downloaded.pdf
                header("Content-Disposition:attachment;filename=DRMS_Feedback_Report_".date('m-d-Y').".pdf");
                // The PDF source is in original.pdf
                readfile("feedbackReport.pdf");

            }


        }



























        
        public function generateReportDocumentRequests() {

            $this->load->model('AdminModel');


            $student_type = $this->input->post('getStudentTypeRequest');
            $course = $this->input->post('getCourseRequest');
            $dateFrom = $this->input->post('getDateFromRequest');
            $dateTo = $this->input->post('getDateToRequest');

            

            if ($student_type == '1,2') {
                $title = "Document Request Report (All Types of Student)";
            } elseif ($student_type == '1') {
                $title = "Document Request Report (Active Student)";
            } elseif ($student_type == '2') {
                $title = "Document Request Report (Inactive Student)";
            }


            if ($course == 0) {
                $course_title = "All Courses";
            } else {
                $courseTitle = $this->AdminModel->getCourse($course);
                $course_title = ucwords($courseTitle->course_desc). ' ('.$courseTitle->course_name.')';
            }

            

            header('Conten-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="DocumentReport.xlsx"');

            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();

            $sheet->setCellValue('A1', $title);
            $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(18);

            $sheet->setCellValue('A2', $course_title);
            $sheet->getStyle('A2')->getFont()->setBold(false)->setSize(11);

            $sheet->setCellValue('A3', 'Report of '.date("M d, Y", strtotime($dateFrom)). ' - '.date("M d, Y", strtotime($dateTo)));
            $sheet->getStyle('A3')->getFont()->setBold(false)->setSize(11);

            $sheet->setCellValue('A4', 'Date Generated: '.date('M d, Y'));
            $sheet->getStyle('A4')->getFont()->setBold(false)->setSize(11);





            $cog = 0;
            $cogCost = 0;

            $coe = 0;
            $coeCost = 0;

            $cue = 0;
            $cueCost = 0;

            $ccd = 0;
            $ccdCost = 0;
            
            $cgr = 0;
            $cgrCost = 0;

            $cgah = 0;
            $cgahCost = 0;

            $cgg = 0;
            $cggCost = 0;

            $cgs = 0;
            $cgsCost = 0;

            $cft = 0;
            $cftCost = 0;

            $cnid = 0;
            $cnidCost = 0;

            $cr = 0;
            $crCost = 0;

            $checklist = 0;
            $checklistCost = 0;

            $tor = 0;
            $torCost = 0;

            $honorable = 0;
            $honorableCost = 0;

            $diploma = 0;
            $diplomaCost = 0;

            $authentication = 0;
            $authenticationCost = 0;

            $cav_dfa = 0;
            $cav_dfaCost = 0;

            $cav = 0;
            $cavCost = 0;

            $endorsement = 0;
            $endorsementCost = 0;

            $other = 0;
            $otherCost = 0;
            
            $totalCosting = 0;


            if ($course == 0) {
                $requests = $this->AdminModel->generateDocumentDocument2($dateFrom, $dateTo, $student_type);
            } else {
                $requests = $this->AdminModel->generateDocumentDocument($dateFrom, $dateTo, $course, $student_type);
            }


            $sheet->setCellValue('A31', 'REQUEST ID');
            $sheet->getStyle('A31')->getFont()->setBold(true)->setSize(11);

            $sheet->setCellValue('B31', 'STUDENT TYPE');
            $sheet->getStyle('B31')->getFont()->setBold(true)->setSize(11);
            
            $sheet->setCellValue('C31', 'DOCUMENT NAME');
            $sheet->getStyle('C31')->getFont()->setBold(true)->setSize(11);

            $sheet->setCellValue('D31', 'DOCUMENT COPIES');
            $sheet->getStyle('D31')->getFont()->setBold(true)->setSize(11);

            
            $sheet->setCellValue('E31', 'DOCUMENT PAGES');
            $sheet->getStyle('E31')->getFont()->setBold(true)->setSize(11);

            
            $sheet->setCellValue('F31', 'DOCUMENT COST');
            $sheet->getStyle('F31')->getFont()->setBold(true)->setSize(11);

            
            $sheet->setCellValue('G31', 'DATE CREATED');
            $sheet->getStyle('G31')->getFont()->setBold(true)->setSize(11);


            $countCells = 32;
            foreach($requests as $request):
                
                $request_id = $request->request_id;
                $student_type = $request->student_type;
                $document_name = $request->document_name;
                $document_cost = $request->document_cost;
                $document_type = $request->document_type;
                $document_copies = $request->document_copies;
                $document_pages = $request->document_pages;
                $date_created = $request->date_created;

                if ($student_type == 1) {
                    $type = "Active Student";
                }

                if ($student_type == 2) {
                    $type = "Alumni/Inactive Student";
                }


                $totalCosting += $document_cost;

                switch ($document_type) {

                    case 1:
                        $cog++;
                        $cogCost += $document_cost;
                    break;

                    case 2:
                        $coe++;
                        $coeCost += $document_cost;
                    break;

                    case 3:
                        $cue++;
                        $cueCost += $document_cost;
                    break;

                    case 4:
                        $ccd++;
                        $ccdCost += $document_cost;
                    break;

                    case 5:
                        $cgr++;
                        $cgrCost += $document_cost;
                    break;

                    case 6:
                        $cgah++;
                        $cgahCost += $document_cost;
                    break;

                    case 7:
                        $cgg++;
                        $cggCost += $document_cost;
                    break;

                    case 8:
                        $cgs++;
                        $cgsCost += $document_cost;
                    break;

                    case 9:
                        $cft++;
                        $cftCost += $document_cost;
                    break;

                    case 10:
                        $cnid++;
                        $cnidCost += $document_cost;
                    break;

                    case 11:
                        $cr++;
                        $crCost += $document_cost;
                    break;

                    case 12:
                        $checklist++;
                        $checklistCost += $document_cost;
                    break;

                    case 13:
                        $tor++;
                        $torCost += $document_cost;
                    break;

                    case 14:
                        $honorable++;
                        $honorableCost += $document_cost;
                    break;

                    case 15:
                        $diploma++;
                        $diplomaCost += $document_cost;
                    break;

                    case 16:
                        $authentication++;
                        $authenticationCost += $document_cost;
                    break;

                    case 17:
                        $cav_dfa++;
                        $cav_dfaCost += $document_cost;
                    break;

                    case 18:
                        $cav++;
                        $cavCost += $document_cost;
                    break;

                    case 19:
                        $endorsement++;
                        $endorsementCost += $document_cost;
                    break;

                    case 20:
                        $other++;
                        $otherCost += $document_cost;
                    break;

                }





                $sheet->setCellValue('A'.$countCells, $request_id);
                $sheet->getStyle('A'.$countCells)->getFont()->setBold(false)->setSize(11);
    
                $sheet->setCellValue('B'.$countCells, $type);
                $sheet->getStyle('B'.$countCells)->getFont()->setBold(false)->setSize(11);
                
                $sheet->setCellValue('C'.$countCells, $document_name);
                $sheet->getStyle('C'.$countCells)->getFont()->setBold(false)->setSize(11);
                
                $sheet->setCellValue('D'.$countCells, $document_copies);
                $sheet->getStyle('D'.$countCells)->getFont()->setBold(false)->setSize(11);
    
                
                $sheet->setCellValue('E'.$countCells, $document_pages);
                $sheet->getStyle('E'.$countCells)->getFont()->setBold(false)->setSize(11);
    
                
                $sheet->setCellValue('F'.$countCells, $document_cost);
                $sheet->getStyle('F'.$countCells)->getFont()->setBold(false)->setSize(11);
    
                
                $sheet->setCellValue('G'.$countCells, $date_created);
                $sheet->getStyle('G'.$countCells)->getFont()->setBold(false)->setSize(11);

                $countCells++;

            endforeach;











            $sheet->setCellValue('A6', 'SUMMARY OF TOTAL DOCUMENT REQUESTED & FEES COLLECTED');
            $sheet->getStyle('A6')->getFont()->setBold(true)->setSize(11);

            $sheet->setCellValue('A7', 'Document Name');
            $sheet->getStyle('A7')->getFont()->setBold(true)->setSize(11);

            $sheet->setCellValue('A8', 'Certification of Grades');
            $sheet->getStyle('A8')->getFont()->setBold(false)->setSize(11);

            $sheet->setCellValue('A9', 'Certification of Enrollment');
            $sheet->getStyle('A9')->getFont()->setBold(false)->setSize(11);
            
            $sheet->setCellValue('A10', 'Certification of Units Earned');
            $sheet->getStyle('A10')->getFont()->setBold(false)->setSize(11);
            
            $sheet->setCellValue('A11', 'Certification of Course Description');
            $sheet->getStyle('A11')->getFont()->setBold(false)->setSize(11);
            
            $sheet->setCellValue('A12', 'Certification of Graduating with Ranking');
            $sheet->getStyle('A12')->getFont()->setBold(false)->setSize(11);
            
            $sheet->setCellValue('A13', 'Certification of Graduating with Academic Honors');
            $sheet->getStyle('A13')->getFont()->setBold(false)->setSize(11);
            
            $sheet->setCellValue('A14', 'Certification of Graduation with GWA');
            $sheet->getStyle('A14')->getFont()->setBold(false)->setSize(11);
            
            $sheet->setCellValue('A15', 'Certification of Grading System');
            $sheet->getStyle('A15')->getFont()->setBold(false)->setSize(11);
            
            $sheet->setCellValue('A16', 'Certification of Free Tuition');
            $sheet->getStyle('A16')->getFont()->setBold(false)->setSize(11);
            
            $sheet->setCellValue('A17', 'Certification of No Issued ID');
            $sheet->getStyle('A17')->getFont()->setBold(false)->setSize(11);
            
            $sheet->setCellValue('A18', 'Certification of Registration');
            $sheet->getStyle('A18')->getFont()->setBold(false)->setSize(11);
            
            $sheet->setCellValue('A19', 'Checklist of Completed Grades');
            $sheet->getStyle('A19')->getFont()->setBold(false)->setSize(11);
            
            $sheet->setCellValue('A20', 'Transcript of Records');
            $sheet->getStyle('A19')->getFont()->setBold(false)->setSize(11);
            
            $sheet->setCellValue('A21', 'Honorable Dismissal & Transfer Credentials');
            $sheet->getStyle('A22')->getFont()->setBold(false)->setSize(11);

            $sheet->setCellValue('A23', 'Copy of Diploma');
            $sheet->getStyle('A23')->getFont()->setBold(false)->setSize(11);

            $sheet->setCellValue('A24', 'Authentication');
            $sheet->getStyle('A24')->getFont()->setBold(false)->setSize(11);

            $sheet->setCellValue('A25', 'CAV (for DFA)');
            $sheet->getStyle('A25')->getFont()->setBold(false)->setSize(11);

            $sheet->setCellValue('A26', 'CAV (for non-DFA)');
            $sheet->getStyle('A26')->getFont()->setBold(false)->setSize(11);

            $sheet->setCellValue('A27', 'Endorsement Letter');
            $sheet->getStyle('A27')->getFont()->setBold(false)->setSize(11);

            $sheet->setCellValue('A28', 'Others');
            $sheet->getStyle('A28')->getFont()->setBold(false)->setSize(11);
            






            $sheet->setCellValue('B7', 'Number of Request');
            $sheet->getStyle('B7')->getFont()->setBold(true)->setSize(11);


            
            $sheet->setCellValue('B8', $cog);
            $sheet->getStyle('B8')->getFont()->setBold(false)->setSize(11);

            $sheet->setCellValue('B9', $coe);
            $sheet->getStyle('B9')->getFont()->setBold(false)->setSize(11);
            
            $sheet->setCellValue('B10', $cue);
            $sheet->getStyle('B10')->getFont()->setBold(false)->setSize(11);
            
            $sheet->setCellValue('B11', $ccd);
            $sheet->getStyle('B11')->getFont()->setBold(false)->setSize(11);
            
            $sheet->setCellValue('B12', $cgr);
            $sheet->getStyle('B12')->getFont()->setBold(false)->setSize(11);
            
            $sheet->setCellValue('B13', $cgah);
            $sheet->getStyle('B13')->getFont()->setBold(false)->setSize(11);
            
            $sheet->setCellValue('B14', $cgg);
            $sheet->getStyle('B14')->getFont()->setBold(false)->setSize(11);
            
            $sheet->setCellValue('B15', $cgs);
            $sheet->getStyle('B15')->getFont()->setBold(false)->setSize(11);
            
            $sheet->setCellValue('B16', $cft);
            $sheet->getStyle('B16')->getFont()->setBold(false)->setSize(11);
            
            $sheet->setCellValue('B17', $cnid);
            $sheet->getStyle('B17')->getFont()->setBold(false)->setSize(11);
            
            $sheet->setCellValue('B18', $cr);
            $sheet->getStyle('B18')->getFont()->setBold(false)->setSize(11);
            
            $sheet->setCellValue('B19', $checklist);
            $sheet->getStyle('B19')->getFont()->setBold(false)->setSize(11);
            
            $sheet->setCellValue('B20', $tor);
            $sheet->getStyle('B19')->getFont()->setBold(false)->setSize(11);
            
            $sheet->setCellValue('B21', $honorable);
            $sheet->getStyle('B21')->getFont()->setBold(false)->setSize(11);

            $sheet->setCellValue('B22', $diploma);
            $sheet->getStyle('B22')->getFont()->setBold(false)->setSize(11);

            $sheet->setCellValue('B23', $authentication);
            $sheet->getStyle('B23')->getFont()->setBold(false)->setSize(11);

            $sheet->setCellValue('B24', $cav_dfa);
            $sheet->getStyle('B24')->getFont()->setBold(false)->setSize(11);

            $sheet->setCellValue('B25', $cav);
            $sheet->getStyle('B25')->getFont()->setBold(false)->setSize(11);

            $sheet->setCellValue('B26', $endorsement);
            $sheet->getStyle('B26')->getFont()->setBold(false)->setSize(11);

            $sheet->setCellValue('B27', $other);
            $sheet->getStyle('B27')->getFont()->setBold(false)->setSize(11);










            
            $sheet->setCellValue('C7', 'Document Cost');
            $sheet->getStyle('C7')->getFont()->setBold(true)->setSize(11);


            
            $sheet->setCellValue('C8', '50');
            $sheet->getStyle('C8')->getFont()->setBold(false)->setSize(11);

            $sheet->setCellValue('C9', '50');
            $sheet->getStyle('C9')->getFont()->setBold(false)->setSize(11);
            
            $sheet->setCellValue('C10', '50');
            $sheet->getStyle('C10')->getFont()->setBold(false)->setSize(11);
            
            $sheet->setCellValue('C11', '50');
            $sheet->getStyle('C11')->getFont()->setBold(false)->setSize(11);
            
            $sheet->setCellValue('C12', '50');
            $sheet->getStyle('C12')->getFont()->setBold(false)->setSize(11);
            
            $sheet->setCellValue('C13', '50');
            $sheet->getStyle('C13')->getFont()->setBold(false)->setSize(11);
            
            $sheet->setCellValue('C14', '50');
            $sheet->getStyle('C14')->getFont()->setBold(false)->setSize(11);
            
            $sheet->setCellValue('C15', '50');
            $sheet->getStyle('C15')->getFont()->setBold(false)->setSize(11);
            
            $sheet->setCellValue('C16', '0');
            $sheet->getStyle('C16')->getFont()->setBold(false)->setSize(11);
            
            $sheet->setCellValue('C17', '0');
            $sheet->getStyle('C17')->getFont()->setBold(false)->setSize(11);
            
            $sheet->setCellValue('C18', '50');
            $sheet->getStyle('C18')->getFont()->setBold(false)->setSize(11);
            
            $sheet->setCellValue('C19', '50');
            $sheet->getStyle('C19')->getFont()->setBold(false)->setSize(11);
            
            $sheet->setCellValue('C20', '100/page');
            $sheet->getStyle('C20')->getFont()->setBold(false)->setSize(11);
            
            $sheet->setCellValue('C21', '50');
            $sheet->getStyle('C21')->getFont()->setBold(false)->setSize(11);

            $sheet->setCellValue('C22', '300');
            $sheet->getStyle('C22')->getFont()->setBold(false)->setSize(11);

            $sheet->setCellValue('C23', '50');
            $sheet->getStyle('C23')->getFont()->setBold(false)->setSize(11);

            $sheet->setCellValue('C24', '200');
            $sheet->getStyle('C24')->getFont()->setBold(false)->setSize(11);

            $sheet->setCellValue('C25', '200');
            $sheet->getStyle('C25')->getFont()->setBold(false)->setSize(11);

            $sheet->setCellValue('C26', '50');
            $sheet->getStyle('C26')->getFont()->setBold(false)->setSize(11);

            $sheet->setCellValue('C27', '50');
            $sheet->getStyle('C27')->getFont()->setBold(false)->setSize(11);








            
            $sheet->setCellValue('D7', 'Total Collected Fees');
            $sheet->getStyle('D7')->getFont()->setBold(true)->setSize(11);

            
            $sheet->setCellValue('D8', $cogCost);
            $sheet->getStyle('D8')->getFont()->setBold(false)->setSize(11);

            $sheet->setCellValue('D9', $coeCost);
            $sheet->getStyle('D9')->getFont()->setBold(false)->setSize(11);
            
            $sheet->setCellValue('D10', $cueCost);
            $sheet->getStyle('D10')->getFont()->setBold(false)->setSize(11);
            
            $sheet->setCellValue('D11', $ccdCost);
            $sheet->getStyle('D11')->getFont()->setBold(false)->setSize(11);
            
            $sheet->setCellValue('D12', $cgrCost);
            $sheet->getStyle('D12')->getFont()->setBold(false)->setSize(11);
            
            $sheet->setCellValue('D13', $cgahCost);
            $sheet->getStyle('D13')->getFont()->setBold(false)->setSize(11);
            
            $sheet->setCellValue('D14', $cggCost);
            $sheet->getStyle('D14')->getFont()->setBold(false)->setSize(11);
            
            $sheet->setCellValue('D15', $cgsCost);
            $sheet->getStyle('D15')->getFont()->setBold(false)->setSize(11);
            
            $sheet->setCellValue('D16', $cftCost);
            $sheet->getStyle('D16')->getFont()->setBold(false)->setSize(11);
            
            $sheet->setCellValue('D17', $cnidCost);
            $sheet->getStyle('D17')->getFont()->setBold(false)->setSize(11);
            
            $sheet->setCellValue('D18', $crCost);
            $sheet->getStyle('D18')->getFont()->setBold(false)->setSize(11);
            
            $sheet->setCellValue('D19', $checklistCost);
            $sheet->getStyle('D19')->getFont()->setBold(false)->setSize(11);
            
            $sheet->setCellValue('D20', $torCost);
            $sheet->getStyle('D20')->getFont()->setBold(false)->setSize(11);
            
            $sheet->setCellValue('D21', $honorableCost);
            $sheet->getStyle('D21')->getFont()->setBold(false)->setSize(11);

            $sheet->setCellValue('D22', $diplomaCost);
            $sheet->getStyle('D22')->getFont()->setBold(false)->setSize(11);

            $sheet->setCellValue('D23', $authenticationCost);
            $sheet->getStyle('D23')->getFont()->setBold(false)->setSize(11);

            $sheet->setCellValue('D24', $cav_dfaCost);
            $sheet->getStyle('D24')->getFont()->setBold(false)->setSize(11);

            $sheet->setCellValue('D25', $cavCost);
            $sheet->getStyle('D25')->getFont()->setBold(false)->setSize(11);

            $sheet->setCellValue('D26', $endorsementCost);
            $sheet->getStyle('D26')->getFont()->setBold(false)->setSize(11);

            $sheet->setCellValue('D27', $otherCost);
            $sheet->getStyle('D27')->getFont()->setBold(false)->setSize(11);
            


            
            $sheet->setCellValue('A28', 'Total');
            $sheet->getStyle('A28')->getFont()->setBold(false)->setSize(11);

            $sheet->setCellValue('D28', $totalCosting);
            $sheet->getStyle('D28')->getFont()->setBold(false)->setSize(11);


            $writer = new Xlsx($spreadsheet);
            $writer->save("php://output");


        }


    }