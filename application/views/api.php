<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// echo getOs(0);
echo $this->security->get_csrf_token_name();
echo $this->security->get_csrf_hash();
?>
