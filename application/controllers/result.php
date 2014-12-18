<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Result extends CI_Controller {
    
    public $student_grade = null;
    public $student_term = null;
    public $results= null ;
    
    public function index() {
        $data = array(
            'title' => 'Exam Results',
            'mDescription' => '',
            'mKeywords' => '',
        );
        $this->load->model('Mresult'); // load Model
        if ($this->session->userdata['user_nsi'] == FALSE) { // Check whether this is first time
            $studentId = $this->input->post('studentId', TRUE); // accept NIC
            $user['records'] = $this->Mresult->get_user_records($studentId); // get user details for session
            
            if ($user['records'] == TRUE) { // Check whether accepted NIC is in database
                $user_data = array(// Set Session Data
                    'user_nsi' => $studentId,
                    'user_name' => $user['records']['0']->f_name . ' ' . $user['records']['0']->m_name . ' ' . $user['records']['0']->l_name,
                    'user_school' => $user['records']['0']->school_name,
                    'load_model' => FALSE,
                );
                $this->session->set_userdata($user_data); // session created
                
                $results['content'] = $this->Mresult->get_results();
                
                // Set data to class varibles
                //$this->results['content'] = $results['content'];
                $this->student_grade = $results['content'][0]->grade_num;
                $results['forHistoryChart'] = $this->Mresult->get_resultForHistoryChart(intval($results['content'][0]->grade_num));
                $this->results['forHistoryChart'] = $results['forHistoryChart'];
                $this->writeHistoryChart_jsonData();
                
                // to Test
                //$part=0;
                //var_dump($this->results['forHistoryChart']);
                
//                $term['max'] = 0;
//                $term['1_sebjects_count'] =0;
//                $term['2_sebjects_count'] =0;
//                $term['3_sebjects_count'] =0;
//                $subjects_of[][] = null;
//                foreach ($this->results['forHistoryChart'] as $row) {
//                    if ($row->term > $term['max']) {
//                        $term['max'] = $row->term;
//                    }
//                    if ($row->term == 1) {
//                        $index = $term['1_sebjects_count'];
//                        $subjects_of['term_1'][$index] = $row->marks;
//                        echo 'T1'.$subjects_of['term_1'][$index]."\n";
//                        $term['1_sebjects_count']++;
//                        echo '<br />';
//                    }  elseif ($row->term == 2) {
//                        $index = $term['2_sebjects_count'];
//                        $subjects_of['term_2'][$index] = $row->marks;
//                        echo 'T2'.$subjects_of['term_2'][$index]."\n";
//                        $term['2_sebjects_count']++;
//                        echo '<br />';
//                    }  elseif ($row->term == 3) {
//                        $index = $term['3_sebjects_count'];
//                        $subjects_of['term_3'][$index] = $row->marks;
//                        echo 'T3'.$subjects_of['term_3'][$index]."\n";
//                        $term['3_sebjects_count']++;
//                        echo '<br />';
//                    }
//                }
//                echo 'Max'.$term['max']."\n";
//                echo $term['1_sebjects_count']."\n";
//                echo $term['2_sebjects_count']."\n";
//                echo $term['3_sebjects_count']."\n";
                
//                var_dump($this->student_grade);
//                echo $this->student_grade;
//                for ($i = 0; $i <= count($this->results['content'], 1); $i++) {
//                    if ($i == count($this->results['content'], 1)) {
//                        
//                        echo count($this->results['content'], 1);
//                        $part3 = 'Average';
//                        echo $part3;
//                        break;
//                    }
//                    $part3 = $this->results['content'][$i]->subject_name;
//                    echo $part3;
//                }
                
                
            
                $this->load->view('vheader', $data);
                $this->load->view('vresult', $results);
                $this->load->view('vfooter');
            } else { // If accepted user NIC is not in database
                $this->session->set_userdata('load_model', TRUE);
                redirect('');
            }
            
        } else { // If this is not first time
            $results['content'] = $this->Mresult->get_results();
            // Set data to class varibles
            $this->results['content'] = $results['content'];
            $this->student_grade = $results['content'][0]->grade_num;
            $results['forHistoryChart'] = $this->Mresult->get_resultForHistoryChart(intval($results['content'][0]->grade_num));
            $this->results['forHistoryChart'] = $results['forHistoryChart'];
            $this->writeHistoryChart_jsonData();
                
            
            $this->load->view('vheader', $data);
            $this->load->view('vresult', $results);
            $this->load->view('vfooter');
        }
    }
    
    public function previous_results() {
        $data = array(
            'title' => 'Exam Results',
            'mDescription' => '',
            'mKeywords' => '',
        );
        $selected_grade = $this->input->post('selected_grade', TRUE);
        $selected_term = $this->input->post('selected_term', TRUE);
        $this->student_grade = intval($selected_grade);
        $this->student_term = intval($selected_term);
        
        $this->load->model('Mresult');
        $results['content'] = $this->Mresult->previous_results($selected_grade, $selected_term);
        
        // Set data to class varibles
            $this->results['content'] = $results['content'];
            $this->student_grade = $results['content'][0]->grade_num;
            $results['forHistoryChart'] = $this->Mresult->get_resultForHistoryChart(intval($results['content'][0]->grade_num));
            $this->results['forHistoryChart'] = $results['forHistoryChart'];
            $this->writeHistoryChart_jsonData();
        
//        $this->load->helper('file');
//        $data2 ='
//{
//  "cols": [
//        {"id":"","label":"Topping","pattern":"","type":"string"},
//        {"id":"","label":"Slices","pattern":"","type":"number"}
//      ],
//  "rows": [
//        {"c":[{"v":"Mushrooms","f":null},{"v":'.$this->student_grade.',"f":null}]},
//        {"c":[{"v":"Onions","f":null},{"v":65.34,"f":null}]},
//        {"c":[{"v":"Olives","f":null},{"v":52,"f":null}]},
//        {"c":[{"v":"Zucchini","f":null},{"v":87.14,"f":null}]},
//        {"c":[{"v":"Pepperoni","f":null},{"v":25,"f":null}]}
//      ]
//}
//';
//        if (!write_file('./assets/json/historyChart.json', $data2)) {
//            //echo 'Unable to write the file';
//        } else {
//            //echo 'File written!';
//        }

        if ($results['content'] == TRUE) {
            $this->load->view('vheader', $data);
            $this->load->view('vresult', $results);
            $this->load->view('vfooter');
        }  else {
            $this->session->set_userdata('load_model', TRUE);
            redirect('/result');
        }
    }
    
    // Function to retrive Grade for marks
    public function check_Grade($marks) {
        
        if (29>= $marks || $marks <= 00) { return 'F';
        } elseif (34>= $marks || $marks <= 30) { return 'D';
        } elseif (39>= $marks || $marks <= 35) { return 'D+';
        } elseif (44>= $marks || $marks <= 40) { return 'C';
        } elseif (54>= $marks || $marks <= 45) { return 'C+';
        } elseif (59>= $marks || $marks <= 55) { return 'B';
        } elseif (64>= $marks || $marks <= 60) { return 'B+';
        } elseif (69>= $marks || $marks <= 65) { return 'A-';
        } elseif (84>= $marks || $marks <= 70) { return 'A';
        } elseif (100>= $marks || $marks <= 85) { return 'A+';
        }
    }
    
    //Function to file read
    public function readFile() {
        $string = read_file('./assets/json/historyChart.json');
        echo $string;
        
    }
    
    
    // Function to send Json DATA for charts
    public function getData() {
        echo '
            {
              "cols": [
                    {"id":"","label":"Topping","pattern":"","type":"string"},
                    {"id":"","label":"Slices","pattern":"","type":"number"}
                  ],
              "rows": [
                    {"c":[{"v":"Mushrooms","f":null},{"v":3,"f":null}]},
                    {"c":[{"v":"Onions","f":null},{"v":1,"f":null}]},
                    {"c":[{"v":"Olives","f":null},{"v":1,"f":null}]},
                    {"c":[{"v":"Zucchini","f":null},{"v":1,"f":null}]},
                    {"c":[{"v":"Pepperoni","f":null},{"v":2,"f":null}]}
                  ]
            }
        ';
    }
    
    // Function to send Json DATA for charts
    public function writeHistoryChart_jsonData() {
        $file = fopen("./assets/json/historyChart.json", "wb") or die("Unable to open file!");
        
        $term['max'] = 0;               // To max term number depend on grade
        $term['subjects_max'] = 0;      // To store max number of subjects depend on term
        $term['that_subjects_max'] = 0; // To store term number wich holdes max subjects
        $term['1_subjects_count'] =0;   // To store term:1 subjects count
        $term['2_subjects_count'] =0;   // To store term:2 subjects count
        $term['3_subjects_count'] =0;   // To store term:3 subjects count
        $subjects_of[][] = null;        // New array to store Subjects Names & Subjects Marks filter by term
        
        foreach ($this->results['forHistoryChart'] as $row) {
            if ($row->term > $term['max']) {
                $term['max'] = $row->term;                                          // Find max term depend on the grade and store it to $term['max']
            }
            if ($row->term == 1) {                                                  // Count number of subjects in term:1
                $subjects_of['term_1'][$term['1_subjects_count']] = $row->marks;    // Store Term:1 subject marks to new array called $subject_of['term_1']
                $term['1_subjects_count']++;
            }  elseif ($row->term == 2) {                                           // Count number of subjects in term:2
                $subjects_of['term_2'][$term['2_subjects_count']] = $row->marks;    // Store Term:2 subject marks to new array called $subject_of['term_2']
                $term['2_subjects_count']++;
            }  elseif ($row->term == 3) {                                           // Count number of subjects in term:3
                $subjects_of['term_3'][$term['3_subjects_count']] = $row->marks;    // Store Term:3 subject marks to new array called $subject_of['term_3']
                $term['3_subjects_count']++;
            }
        }
        // Find wich term has the most subjects & store that number to $term['subject_max']
        if ($term['1_subjects_count'] > $term['2_subjects_count']) {
            if ($term['1_subjects_count'] > $term['3_subjects_count']) {
                $term['subjects_max'] = $term['1_subjects_count'];
                $term['that_subjects_max'] = 1;
            } else {
                $term['subjects_max'] = $term['3_subjects_count'];
                $term['that_subjects_max'] = 3;
            }
        } elseif ($term['2_subjects_count'] > $term['3_subjects_count']) {
            $term['subjects_max'] = $term['2_subjects_count'];
            $term['that_subjects_max'] = 2;
        } else {
            $term['subjects_max'] = $term['3_subjects_count'];
            $term['that_subjects_max'] = 3;
        }
        
        foreach ($this->results['forHistoryChart'] as $row) {
            if ($row->term == $term['that_subjects_max']) {
                $subjects_of['term_max_names'][] = $row->subject_name;
            }
        }
        
$part1 ='
{
    "cols": [
        {"label": "Year", "type": "string"},';
fwrite($file, $part1."\n");

        for($i=0; $i <= $term['subjects_max']; $i++){
            if ($i == $term['subjects_max']) {
                $part2 = '        {"label": "';
                fwrite($file, $part2);
                $part3 = 'Average';
                fwrite($file, $part3);
                $part4 = '", "type": "number"}';
                fwrite($file, $part4);
                break;
            }
            $part2 = '        {"label": "';
            fwrite($file, $part2);
            $part3 = $subjects_of['term_max_names'][$i];
            fwrite($file, $part3);
            $part4 = '", "type": "number"},';
            fwrite($file, $part4."\n");
        }
        
//        for($i=0; $i <= count($this->results['content'], 1); $i++){
//            $part2 = '        {"label": "';
//            fwrite($file, $part2);
//            $part3 = $this->results['content'][$i]->subject_name;
//            fwrite($file, $part3);
//            $part4 = '", "type": "number"},';
//            fwrite($file, $part4."\n");
//            if ($i == count($this->results['content'], 1)) {
//                $part2 = '        {"label": "';
//                fwrite($file, $part2);
//                $part3 = 'Average';
//                fwrite($file, $part3);
//                $part4 = '", "type": "number"}';
//                fwrite($file, $part4);
//                break;
//            }
//        }
        
$part5 ='
    ],
    "rows": [';
fwrite($file, $part5."\n");

        
        $marksTotal = 0.00;
        for($i=1; $i<=$term['max']; $i++){
            for($j=0; $j<$term['subjects_max']; $j++){ // $term[''.$i.'_sebjects_count']
                if ($j==0) {
                    $marksTotal = 0.00;
                    $part6 ='        {"c":[{"v": "Grade:';
                    fwrite($file, $part6);
                    $part7 = $this->student_grade.' Term:'.$i.'"},';
                    fwrite($file, $part7."\n");
                }
                $part8 ='              {"v": ';
                fwrite($file, $part8);
                if (isset($subjects_of['term_'.$i.''][$j])) {
                    $part9 = round($subjects_of['term_'.$i.''][$j]).', "f": "'.$subjects_of['term_'.$i.''][$j].'% '.$this->check_Grade($subjects_of['term_'.$i.''][$j]).'"},';
                    $marksTotal += round($subjects_of['term_'.$i.''][$j], 2);
                }  else {
                    $part9 = '0, "f": "No Records"},';
                }
                fwrite($file, $part9."\n");
                
            }
            $part10 ='              {"v": ';
            fwrite($file, $part10);
            $part11 = round($marksTotal/$term[$i.'_subjects_count']).', "f": "'.round($marksTotal/$term[$i.'_subjects_count']).'%"}';
            fwrite($file, $part11);
            
$part12 ='
             ]
        },';
            fwrite($file, $part12."\n");
        }
        
$part13 ='
    ],
}';
            fwrite($file, $part13."\n");
            fclose($file);
            
    }
    
    
    public function demochartdata() {
$string =' 
{
    "cols": [
        {"label": "Year", "type": "string"},
        {"label": "Sub2", "type": "number"},
        {"label": "Sub2", "type": "number"},
        {"label": "Sub2", "type": "number"},
        {"label": "Sub2", "type": "number"},
        {"label": "Sub2", "type": "number"},
        {"label": "Sub2", "type": "number"},
        {"label": "Sub2", "type": "number"},
        {"label": "Sub2", "type": "number"},
        {"label": "Sub2", "type": "number"},
        {"label": "Avg", "type": "number"}
    ],
    "rows": [
        {"c":[{"v": "G11 .1"},
              {"v": 11, "f": "1"},
              {"v": 55, "f": "2"},
              {"v": 11, "f": "1"},
              {"v": 55, "f": "2"},
              {"v": 11, "f": "1"},
              {"v": 55, "f": "2"},
              {"v": 11, "f": "1"},
              {"v": 55, "f": "2"},
              {"v": 55, "f": "2"},
              {"v": 98, "f": "3"}
             ]
        },
        {"c":[{"v": "G11 .2"},
              {"v": 11, "f": "1"},
              {"v": 55, "f": "2"},
              {"v": 11, "f": "1"},
              {"v": 55, "f": "2"},
              {"v": 11, "f": "1"},
              {"v": 55, "f": "2"},
              {"v": 11, "f": "1"},
              {"v": 55, "f": "2"},
              {"v": 55, "f": "2"},
              {"v": 76.0, "f": "3"}
             ]
        },
        {"c":[{"v": "G11 .3"},
              {"v": 11, "f": "1"},
              {"v": 55, "f": "2"},
              {"v": 11, "f": "1"},
              {"v": 55, "f": "2"},
              {"v": 11, "f": "1"},
              {"v": 55, "f": "2"},
              {"v": 11, "f": "1"},
              {"v": 55, "f": "2"},
              {"v": 55, "f": "2"},
              {"v": 46.0, "f": "3"}
             ]
        },
    ],
}
';
echo $string;
    }
}

//   echo json_encode ($results['content'][0]);