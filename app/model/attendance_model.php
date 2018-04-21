<?php

class AttendanceModel extends mModel
{

    private $_table = '';       // This is the primary table of this module
    private $_dTable = '';
    private $_fTable = '';// Secondary or detail table if any
    private $_select = array(); // The select field list array to use in select() or update() function
    private $_where = array();  // where array to use in Database function
    private $_other = '';       // other string to use in database function

    public function __construct()
    {
        parent::__construct();

        $this->_table = 'attendance';
        $this->_dTable = 'attendance_detail';
        $this->_fTable = 'attendance_fiscal';
        $this->_select = array('*');
        $this->_where = array('user_status' => 1);
        $this->_other = 'order by id desc';

    }

    private function _find_user_info($pid = 0)
    {
        // TODO :: we'll use this method to add or search other information related to the user, like leave, blocked or card missing status.
        return true;
    }

    private function _find_id_by_tag($rfid)
    {
        $this->_table = 'users';
        $this->_select = array('id');
        $this->_where = array('user_rfid' => $rfid, 'user_status' => 1);
        $user = $this->db->select($this->_table, $this->_select, $this->_where)->result();
        return $user['id'];
    }

    private function _intime_exists($pid)
    {
        $present_date = date('Y-m-d');
        $this->_select = array('in_time');
        $this->_where = array('ref_user_id' => $pid, 'present_date' => $present_date);
        $isExist = $this->db->select($this->_dTable, $this->_select, $this->_where)->result();
        return $isExist;
    }

    public function attendance_time($rfid = null)
    {
        //date_default_timezone_set('Asia/Dhaka');

        if ($pid = self::_find_id_by_tag($rfid))
        {
            if (self::_find_user_info($pid))
            {
                if (self:: _intime_exists($pid))    // Logout
                {
                    $present_date = date('Y-m-d');
                    $current_time = date('h:i:s');
                    $dataOut = array(
                        'out_time' => $current_time
                    );
                    $this->_where = array('ref_user_id' => $pid, 'present_date' => $present_date);
                    $aid = $this->db->update($this->_dTable, $dataOut, $this->_where);
                    // TODO:: Need to return false if database operation failed checking with the Affected Row ID [$aid]

                    echo json_encode(array('error' => false, 'message' => "Out time success!"));
                }
                else // Login
                {

                    $this->db->start();

                    $present_date = date('Y-m-d');
                    $current_time = date('h:i:s');
                    $dataIn = array(
                        'in_time' => $current_time,
                        'present_date' => $present_date,
                        'ref_user_id' => $pid
                    );

                    $lid = $this->db->insert($this->_dTable, $dataIn);

                    // +1 total attendance

                    if ($lid)
                    {
                        // TODO:: Need to have all fiscal related data from a global scope // When adding fiscal, make sure that no duplicate year and fiscal_status=1 should be in one row
                        $year = date('Y');
                        $fiscal = $this->db->select('attendance_fiscal', array('id'), array('fiscal_year' => $year, 'fiscal_status' => 1), "ORDER BY id DESC LIMIT 1")->result();

                        if ($fiscal)
                        {
                            self::attendance_count($pid, $fiscal['id']);
                            $this->db->end();
                            echo json_encode(array('error' => false, 'message' => "Attendance counted!"));
                        } else {
                            $this->db->back();
                            echo json_encode(array('error' => true, 'message' => "Fiscal Year not found!!"));
                        }
                    }
                }
            } else {
                // TODO :: There might have data mismatching, blocking, or missing card, so show and log Error
                // Notification: You need to contact to the administrator of your company.
            }
        } else {
            // TODO :: Later implementation into device end
            echo json_encode(array('error'=>true, 'message'=>"Tag Not Found!"));
        }
    }

    public function attendance_count($pid, $fiscal)
    {
        // Checking if data exists for the current Tag user
        $this->_table = 'attendance';
        $this->_select = array('attendance_total');
        $this->_where = array('ref_user_id' => $pid, 'ref_fiscal_id' => $fiscal);
        $attendance = $this->db->select($this->_table, $this->_select, $this->_where)->result();


        if(!$attendance) // Need to insert data
        {
            $attendance_total = 1;
            $data = array(
                'ref_user_id'       => $pid,
                'ref_fiscal_id'     => $fiscal,
                'attendance_total'  => $attendance_total
            );

            $this->db->insert($this->_table, $data);

        }
        else            // Update total
        {
            $attendance_total = $attendance['attendance_total']+1;
            $dataUpdate = array(
                'attendance_total' => $attendance_total
            );
            $this->_where = array('ref_user_id' => $pid, 'ref_fiscal_id'=>$fiscal);
            $this->db->update($this->_table, $dataUpdate, $this->_where);
        }
    }

    /**
     * Attendance daily report showing
     * Created by
     * Habibur Rahman
     * Sr. Software Engineer
     */
    public function getAllOfCurrentDay($today)
    {

        $sql =
                '
                    SELECT 
                            attendance_detail.in_time,
                            attendance_detail.out_time,
                            attendance_detail.present_date,
                            users.id,
                            users.user_email,
                            user_details.user_first_name,
                            user_details.user_last_name,
                            user_details.user_phone
                            
                            
                    FROM attendance_detail
                    
                    LEFT JOIN users
                          ON users.id = attendance_detail.ref_user_id
                    LEFT JOIN user_details
                          ON user_details.ref_user_id = users.id
                          
                    WHERE attendance_detail.present_date = "'.$today.'"
                    AND attendance_detail.detail_status = 1
                    ';
        return $this->db->query("$sql")->results();

    }

    /**
     * get present Year id report showing
     * Created by
     * Habibur Rahman
     * Sr. Software Engineer
     */
    public function getPresentYear($today)
    {
        $sql =
            '
                    SELECT *            
                    FROM attendance_fiscal    
                    WHERE fiscal_year = "'.$today.'"
                    AND fiscal_status = 1
                    ';
        return $this->db->query("$sql")->result();
    }

    /**
     * Attendance Yearly report showing
     * Created by
     * Habibur Rahman
     * Sr. Software Engineer
     */
    public function getAllOfCurrentYear($idFiscal)
    {
        $sql =
            '
                    SELECT 
                            attendance.*,
                            users.user_email,
                            user_details.user_first_name,
                            user_details.user_last_name,
                            user_details.user_phone,
                            attendance_fiscal.fiscal_year
                            
                            
                    FROM attendance
                    
                    LEFT JOIN users
                          ON users.id = attendance.ref_user_id
                    LEFT JOIN user_details
                          ON user_details.ref_user_id = users.id
                    LEFT JOIN attendance_fiscal
                          ON attendance_fiscal.id = attendance.ref_fiscal_id
                          
                    WHERE attendance.ref_fiscal_id = "'.$idFiscal.'"';
        return $this->db->query("$sql")->results();
    }


    /**
     * Attendance report by date range by user
     * Created by
     * Habibur Rahman
     * Sr. Software Engineer
     */
    public function getattendanceReportByUser($userId,$fromDate,$toDate)
    {
        $sql =
            '
                    SELECT 
                            attendance_detail.*
                            
                            
                    FROM attendance_detail
                          
                    WHERE ref_user_id = "'.$userId.'" 
                    AND detail_status = 1
                    AND present_date BETWEEN 
                                            "'.$fromDate.'" 
                                            AND
                                            "'.$toDate.'"
                    ';
        return $this->db->query("$sql")->results();
    }
}