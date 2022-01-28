<?php

use phpDocumentor\Reflection\DocBlock\Tags\Return_;

class ShopAdminModels extends CI_Model
{

    function validate_login_session()
    {
        if (!isset($this->session->userdata[TAG_E_BAAZAAR_LOGIN_SESSION])) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function get_logout()
    {
        if (!$this->validate_login_session()) {
            return TRUE;
        } else {
            $this->session->unset_userdata(TAG_E_BAAZAAR_LOGIN_SESSION);
            return TRUE;
        }
    }

}