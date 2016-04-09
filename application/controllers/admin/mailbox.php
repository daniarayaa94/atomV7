<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mailbox extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        //$this->layout->setLayout('admin/headerMaster');
    }

    public function index()
    {
        //$this->load->view('welcome_message');

        $this->load->model('admin/configuraciones/config_model','configuraciones',TRUE);

        $data['shop_name'] = $this->configuraciones->get_config('shop_name')->row()->valor;

        //$this->layout->view('index',$data);

        // Inicio de Inbox (Recuperacion de correos)

        $hostname = '{pop.gmail.com:995/pop3/ssl}';
        $username = 'dani.glover@gmail.com';
        $password = '5539741';

        /* try to connect */
        $inbox = imap_open($hostname,$username,$password) or die('Cannot connect to Gmail: ' . imap_last_error());

        /* grab emails */
        $emails = imap_search($inbox,'ALL');

        /* if emails are returned, cycle through each... */
        if($emails) {

            /* begin output var */
            $output = '';

            /* put the newest emails on top */
            rsort($emails);

            $data['email'] = $emails;

            /* for every email... */
            foreach($emails as $email_number) { 

                // get information specific to this email
                $overview = imap_fetch_overview($inbox,$email_number,0);
                $message = imap_fetchbody($inbox,$email_number,2);

                // output the email header information
                $output.= '<div  '.($overview[0]->seen ? 'read' : 'unread').'">';
                $output.= '<span class="subject">'.$overview[0]->subject.'</span> ';
                $output.= '<span class="from">'.$overview[0]->from.'</span>';
                $output.= '<span class="date">on '.$overview[0]->date.'</span>';
                $output.= '</div>';

                //output the email body
                $output.= '<div class="body">'.$message.'</div>';


            }

            echo $output;
        }

        /* close the connection */
        imap_close($inbox);

        // fin de recuperacion


        $data['content_for_layout'] = $this->load->view('admin/mailbox/index', $data, TRUE);

        $this->load->view('layouts/admin/headerMaster',$data);
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */