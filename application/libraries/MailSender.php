<?php

class MailSender extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function sendMailGmail($from, $correo, $pass)
    {
        //cargamos la libreria email de ci
        $this->load->library("email");

        //configuracion para gmail
        $configGmail = array(
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.gmail.com',
            'smtp_port' => 465,
            'smtp_user' => $correo,
            'smtp_pass' => $pass,
            'mailtype' => 'html',
            'charset' => 'utf-8',
            'newline' => "\r\n"
        );

        //cargamos la configuración para enviar con gmail
        $this->email->initialize($configGmail);

        $this->email->from($from);
        $this->email->to($correo);
        $this->email->subject('Cotizacion Solicitada');
        $this->email->message('<h2>Cotizacion</h2><hr><br> Han solicitado la siguiente cotizacion');
        $this->email->send();
        //con esto podemos ver el resultado
        var_dump($this->email->print_debugger());
    }
}