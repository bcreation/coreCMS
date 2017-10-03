<?php 
class Form {

    public $controller;
    
    public function __construct ($controller){
        $this->controller = $controller;

    }
    public function input($name, $label, $option = array()) {
        if(!isset($this->controller->request->data->$name)){
            $value = '';
        }else{
            $value = $this->controller->request->data->$name;
        }
        if ($label == 'hidden' ) {
            return  '<input type="hidden" name="'.$name.'" value="'.$value.'"/>';
        }
        $html = '<div class="form-group"><label for="input'.$name.'">'.$label.'</label>';
        $attr = '';
        foreach( $option as $k=>$v){
            if( $k != 'type'){
                $attr .= "$k=\"$v\"";
            }
        }
        if( !isset($option['type'] ) ) {
            $html .= '<input type="text" id="input'.$name.'" name="'.$name.'" class="form-control" value="'.$value.'">';
        }else if ($option['type'] == 'textarea' ) {
            $html .= '<textarea id="input'.$name.'" name="'.$name.'" class="form-control" '.$attr.'>'.$value.'</textarea>';
        }else if ($option['type'] == 'checkbox' ) {
            $html .= '<div class="checkbox">
                <label>
                <input type="checkbox" name="'.$name.'" '.($value == "on" ? "checked" : "").'>
                '.(is_string($value) ? $value : "").'
                </label>
            </div>';
        }          
        $html .= '</div>';
        return $html;
    }

    public function button($name, $action, $option) {
        $html = '<button type="'.$action.'" class="btn btn-'.$option['class'].'">'.$name.'</button>';
        return $html;
        
    }
}