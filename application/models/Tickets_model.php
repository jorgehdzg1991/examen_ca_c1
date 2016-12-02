<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tickets_model extends MY_Model
{
    private $nombre_tabla;

    public function __construct()
    {
        parent::__construct("opr_tickets");
    }
}