<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mailbox extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $params = array('imapPath' => '{imap.gmail.com:993/imap/ssl/novalidate-cert}INBOX', 'login' => 'projectatomoffice@gmail.com', 'password' => '20marzo2016', 'attachmentsDir' => 'assets');
        //'{imap.gmail.com:993/imap/ssl/novalidate-cert}INBOX', 'projectatomoffice@gmail.com', '20marzo2016', base_url()
        //$imapPath, $login, $password, $attachmentsDir = null

        $this->load->library('MailboxClass',$params);
        $this->load->library('IncomingMail');
        //$this->layout->setLayout('admin/headerMaster');
    }

    public function index()
    {
        //$this->load->view('welcome_message');

        $this->load->model('admin/configuraciones/config_model','configuraciones',TRUE);

        $this->load->model('admin/mailbox/mailbox_model','mailbox',TRUE);

        $data['shop_name'] = $this->configuraciones->get_config('shop_name')->row()->valor;

        $data['email'] = array();//$this->mailbox->getMails();

        $data['content_for_layout'] = $this->load->view('admin/mailbox/index', $data, TRUE);

        $this->load->view('layouts/admin/headerMaster',$data);
    }

    public function enviados()
    {
        //$this->load->view('welcome_message');

        $this->load->model('admin/configuraciones/config_model','configuraciones',TRUE);

        $this->load->model('admin/mailbox/mailbox_model','mailbox',TRUE);

        $data['shop_name'] = $this->configuraciones->get_config('shop_name')->row()->valor;

        /**
         * Se deben configurar los mails enviados
         */

        $data['email'] = array();//$this->mailbox->getMails();



        $data['content_for_layout'] = $this->load->view('admin/mailbox/index', $data, TRUE);

        $this->load->view('layouts/admin/headerMaster',$data);
    }


    public function refresh(){

        $this->load->model('admin/mailbox/mailbox_model','mailbox',TRUE);

        $mailsIds = $this->mailboxclass->searchMailbox('UNSEEN');

        for ($i = 0; $i < sizeof($mailsIds); $i++) {

            $mail = $this->mailboxclass->getMail($mailsIds[$i]);

            $this->mailbox->insertMails($mail->subject, $mail->fromName, $mail->textHtml, $mail->date, $mail->messageId);
        }


        redirect("admin/mailbox");

        /* Inicio de Inbox (Recuperacion de correos)

        $hostname = "{imap.gmail.com:993/imap/ssl/novalidate-cert}INBOX";
        $username = "projectatomoffice@gmail.com";
        $password = "20marzo2016";


        $inbox = imap_open($hostname,$username,$password) or die('Cannot connect to Gmail: ' . imap_last_error());


        $emails = imap_search($inbox,'UNSEEN');


        if($emails) {


            $output = '';


            rsort($emails);

            $this->load->model('admin/mailbox/mailbox_model','mailbox',TRUE);

            foreach($emails as $email_number) {

                // get information specific to this email
                $overview = imap_fetch_overview($inbox,$email_number,0);

                //$message = imap_fetchbody($inbox,$email_number,2);

                $info = imap_fetchstructure($inbox, $email_number, 0);

                if($info -> encoding == 3){
                    $message = base64_decode(imap_fetchbody($inbox, $email_number,""));
                }
                elseif($info -> encoding == 4){
                    $message = imap_qprint(imap_fetchbody($inbox, $email_number,""));
                }
                else
                {
                    $message = imap_fetchbody($inbox, $email_number,"");
                }

                $this->mailbox->insertMails($overview[0]->subject,$overview[0]->from,$this->decode_qprint($message),$overview[0]->date,$overview[0]->uid);

            }
        }

        imap_close($inbox);

        redirect("admin/mailbox");

        // fin de recuperacion     */
    }

    /*Funcion para decodificar los mensajes*/

    function decode_qprint($str)
    {
        $str = preg_replace("/\=([A-F][A-F0-9])/","%$1",$str);
        $str = urldecode($str);
        $str = utf8_encode($str);
        return $str;
    }


    public function readMail($id){
        $this->load->model('admin/configuraciones/config_model','configuraciones',TRUE);
        $this->load->model('admin/mailbox/mailbox_model','mailbox',TRUE);

        $data['shop_name'] = $this->configuraciones->get_config('shop_name')->row()->valor;

        $data['mail'] = $this->mailbox->getMailById($id);

        $data['content_for_layout'] = $this->load->view('admin/mailbox/readmail', $data, TRUE);

        $this->load->view('layouts/admin/headerMaster',$data);
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
