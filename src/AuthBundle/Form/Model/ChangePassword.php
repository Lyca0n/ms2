<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AuthBundle\Form\Model;

use Symfony\Component\Security\Core\Validator\Constraints as SecurityAssert;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Description of ChangePassword
 *
 * @author jvillalv
 */
class ChangePassword {
    /**
     * @SecurityAssert\UserPassword(
     *     message = "Wrong value for your current password"
     * )
     */
     protected $oldPassword;

    /**
     * @Assert\Length(
     *  min=8, 
     *  minMessage = "Password should by at least 6 chars long"
     * )
     */
     protected $newPassword;
     
     public function getOldPassword(){
         return $this->oldPassword;
     }     
     public function setOldPassword($password){
        $this->oldPassword = $password;
     }          
     public function getNewPassword(){
         return $this->newPassword;
     }     
     public function setNewPassword($password){
        $this->newPassword = $password;
     }      
}
