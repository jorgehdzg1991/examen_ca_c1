<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Areas_model extends MY_Model
{
    public function __construct()
    {
        parent::__construct("ctl_areas");
    }
}