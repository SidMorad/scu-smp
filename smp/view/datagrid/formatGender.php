<?php
/**
 * Created at 03/09/2010 4:03:11 PM
 * smp/view/datagrid/formatGender.php
 *
 * @author <a href="mailto:smorad12@scu.edu.au">Sid</a>
 * @version 1.0
 */
function format_gender($params){
    $key = $params['record']['gender'];
    return VH::getValueFromFixArray('gender', $key);
}