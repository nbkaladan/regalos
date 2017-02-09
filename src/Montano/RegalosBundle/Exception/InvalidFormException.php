<?php
/**
 * Created by PhpStorm.
 * User: kaladan
 * Date: 11/08/15
 * Time: 13:05
 */

namespace Montano\RegalosBundle\Exception;


class InvalidFormException extends \RuntimeException{
    protected $form;

    public function __construct($message, $form = null){
        parent::__construct($message);
        $this->form = $form;
    }

    /**
     * @return array|null
     */
    public function getForm(){
        return $this->form;
    }
} 