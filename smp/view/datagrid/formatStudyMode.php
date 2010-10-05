<?php
/**
 * Created at 03/09/2010 4:01:42 PM
 * smp/view/datagrid/formatStudyMode.php
 *
 * @author <a href="mailto:smorad12@scu.edu.au">Sid</a>
 * @version 1.0
 */
function format_study_mode($params){
    $key = $params['record']['study_mode'];
    return VH::getValueFromFixArray('study_mode', $key);
}