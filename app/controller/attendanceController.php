<?php

class AttendanceController extends mController
{

    private $_model_attendance = '';
    private $_user_model = '';


    public function __construct()
    {
        parent::__construct();

        $this->_model_attendance = $this->load->model("attendance_model");
        $this->_user_model = $this->load->model("user_model");
    }

    public function sse()
    {

        // http://192.168.10.10/RFAttendanceSystem/index.php?url=AttendanceController/
        header('Content-Type: text/event-stream');
        header('Cache-Control: no-cache');

        //header('Connection: keep-alive');
        while (true) {
            //echo "retry: 1000" . PHP_EOL;
            echo 'id: ' . uniqid() . PHP_EOL;
            echo 'data: ' . date("h:i:s", time()) . PHP_EOL;
            echo PHP_EOL;
            //ob_flush();
            //flush();
            sleep(1);
        }

    }

    public function put($rfid = null)
    {
        if (!$rfid) echo json_encode(array('error' => true, 'message' => "No Tag Given!"));
        $this->_model_attendance->attendance_time($rfid);
    }

    /**
     * Attendance daily report showing
     * Created by
     * Habibur Rahman
     * Sr. Software Engineer
     */
    public function attendanceTodayReport()
    {
        $today = date('Y-m-d');

        $this->document->title('Daily Attendance Report');
        $this->document->headertitle("Daily Attendance Report of <strong>" . $today . "</strong>");

        // JS and css files for date picker
        $this->document->js(array(
            DIR_VIEW . 'vendor/js/dataTables.bootstrap.min.js',
            DIR_VIEW . 'vendor/js/jquery.dataTables.min.js',
            DIR_VIEW . 'theme/gray/js/data_table.js',
        ));

        $this->document->css(array(
            DIR_VIEW . 'vendor/css/tables.css',
        ));

        $data['dailyInformations'] = $this->_model_attendance->getAllOfCurrentDay($today);
        $data['date'] = $today;
        $this->load->view("v_attendence_daily_report", $data);

    }

    /**
     * Attendance Yearly report showing
     * Created by
     * Habibur Rahman
     * Sr. Software Engineer
     */
    public function attendanceYearlyReport()
    {
        $today = date('Y');

        $this->document->title('Yearly Attendance Report');
        $this->document->headertitle("Year Attendance Report of <strong>" . $today . "</strong>");

        // JS and css files for date picker
        $this->document->js(array(
            DIR_VIEW . 'vendor/js/dataTables.bootstrap.min.js',
            DIR_VIEW . 'vendor/js/jquery.dataTables.min.js',
            DIR_VIEW . 'theme/gray/js/data_table.js',
        ));

        $this->document->css(array(
            DIR_VIEW . 'vendor/css/tables.css',
        ));

        $presentYear = $data['dailyInformations'] = $this->_model_attendance->getPresentYear($today);
        $data['yearlyInformations'] = $this->_model_attendance->getAllOfCurrentYear($presentYear['id']);
        $data['year'] = $today;
//       echo '<pre>';var_dump($data['yearlyInformations']); echo '</pre>'; die;
        $this->load->view("v_attendence_yearly_report", $data);

    }

    /**
     * Attendance report by user
     * Created by
     * Habibur Rahman
     * Sr. Software Engineer
     */
    public function attendanceReportByUser()
    {
        $this->document->headertitle("Attendance by User");


//        JS and css files for date picker
        $this->document->js(array(
            DIR_VIEW . 'vendor/js/jquery-ui.js',
            DIR_VIEW . 'theme/gray/js/attendance.js',
            DIR_VIEW . 'vendor/js/dataTables.bootstrap.min.js',
            DIR_VIEW . 'vendor/js/jquery.dataTables.min.js',
            DIR_VIEW . 'theme/gray/js/data_table.js',

        ));

        $this->document->css(array(
            DIR_VIEW . 'vendor/css/calender.css',
            DIR_VIEW . 'vendor/css/jquery-ui.css',
            DIR_VIEW . 'vendor/css/tables.css',
        ));


        $data['users'] = $this->_user_model->get_all_user();

        if ($_POST) {

            $today = date('Y-m-d');

            $user_info = $this->_user_model->get_user_by_id($_POST['user_id']);

            $this->document->title("Attendance Detail of");
            $this->document->headertitle("Attendance by User <strong>" . $user_info['user_first_name'] . " " . $user_info['user_last_name'] . "</strong>");


            $userId = $_POST['user_id'];

            $fromDate = empty($_POST['from_date']) ? $today : date('Y-m-d', strtotime($_POST['from_date']));
            $toDate = empty($_POST['to_date']) ? $today : date('Y-m-d', strtotime($_POST['to_date']));

            $data['userAttentInformations'] = $this->_model_attendance->getattendanceReportByUser($userId, $fromDate, $toDate);
//        echo '<pre>'; var_dump($data['userAttentInformations']);echo '</pre>'; die;

        }

        $this->load->view("v_attendence_user_report", $data);

    }

}