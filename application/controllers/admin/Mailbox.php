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

        $this->load->model('admin/mailbox/mailbox_model','mailbox',TRUE);

        $data['shop_name'] = $this->configuraciones->get_config('shop_name')->row()->valor;

        $data['email'] = $this->mailbox->getMails();

        $data['content_for_layout'] = $this->load->view('admin/mailbox/index', $data, TRUE);

        $this->load->view('layouts/admin/headerMaster',$data);
    }

    public function refresh(){
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

            $this->load->model('admin/mailbox/mailbox_model','mailbox',TRUE);

            foreach($emails as $email_number) {

                // get information specific to this email
                $overview = imap_fetch_overview($inbox,$email_number,0);


                $message = imap_fetchbody($inbox,$email_number,2);

                $this->mailbox->insertMails($overview[0]->subject,$overview[0]->from,$message,$overview[0]->date,$overview[0]->uid);

                /* output the email header information
                $output.= '<tr id="'.$overview[0]->message_id .'" class="'.($overview[0]->seen ? 'read' : 'unread').'">';
                $output.= '<td class="mailbox-name">'.$overview[0]->from.'</td>';
                $output.= '<td class="mailbox-subject">'.$overview[0]->subject.'</td> ';
                $output.= '<td class="mailbox-date">'.date("d-m-Y", strtotime($overview[0]->date)).'</td>';
                $output.= '</tr>';*/
                
                /*
                 <tr>
                     <td class="mailbox-name"><a href="read-mail.html"><?php $overview[0]->from ?></a></td>
                     <td class="mailbox-subject"><?php $overview[0]->subject ?></td>
                     <td class="mailbox-date"><?php $overview[0]->date ?></td>
                </tr>

                 */

                //output the email body
                //$output.= '<div class="body">'.$message.'</div>';


            }
        }

        imap_close($inbox);

        $this->index();

        // fin de recuperacion
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
