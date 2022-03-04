<?php

/* Initialize Joomla framework */
if (!defined('_JEXEC')) {
    define( '_JEXEC', 1 );
    define('JPATH_BASE', dirname(__FILE__) );
    define( 'DS', DIRECTORY_SEPARATOR );
    /* Required Files */
    require_once ( JPATH_BASE .DS.'includes'.DS.'defines.php' );
    require_once ( JPATH_BASE .DS.'includes'.DS.'framework.php' );
    /* To use Joomla's Database Class */
    require_once ( JPATH_BASE .DS.'libraries'.DS.'joomla'.DS.'factory.php' );
    require_once ( JPATH_LIBRARIES.DS.'import.php'); // Joomla library imports.
    /* Create the Application */
    $app = JFactory::getApplication('site')->initialise();
    $lang = JFactory::getLanguage();
    $curlang =  $lang->getTag();
}
header("Content-Type: text/html; charset=utf-8");
?>
<?php
$input = JFactory::getApplication()->input;
$counter = $input->get( 'uid', 1, STRING );
$uname = $input->get( 'uname', 1, STRING );
$uimya = $input->get( 'uimya', 1, STRING );
$uotchestvo = $input->get( 'uotchestvo', 1, STRING );
$udolzhnost = $input->get( 'udolzhnost', 1, STRING );
$uorganizatsiya = $input->get( 'uorganizatsiya', 1, STRING );
$myname = $input->get( 'myname', 1, STRING );
$myimya = $input->get( 'myimya', 1, STRING );
$myotchestvo = $input->get( 'myotchestvo', 1, STRING );
$myotchestvo = $input->get( 'myotchestvo', 1, STRING );
$mydolzhnost = $input->get( 'mydolzhnost', 1, STRING );
$myorganizatsiya = $input->get( 'myorganizatsiya', 1, STRING );
$mykontaktnyytelefon = $input->get( 'mykontaktnyytelefon', 1, STRING );
$myemail = $input->get( 'myemail', 1, STRING );
$curlang = $input->get( 'curlang', 1, STRING );



    if('en-GB' == $curlang ):

echo "
        <a class='chekonload' href='index.php?action=getForm&sss=sss".$counter."&fi=formlkuchastnikim".$counter."' onclick='clickajax(this);return false'></a>
        <form class='form-reg form-horizontal' id='issue-form".$counter."' name='issue-form".$counter."' method='post' action=''>
            <div class='control-group'>
                <label class='control-label'>Full name:</label>
                <div class='controls'>
                    <input name='id2info1' id='id2info1' type='hidden' value ='".$uname." ".$uimya." ".$uotchestvo."'/>
                    <label class='big'>".$uname." ".$uimya." ".$uotchestvo."</label>
                </div>
            </div>
            <div class='control-group'>
                <label class='control-label'>Position:</label>
                <div class='controls'>
                    <input name='id2info3' id='id2info3' type='hidden' value ='".$udolzhnost."'/>
                    <label class='big'>".$udolzhnost."</label>
                </div>
            </div>
            <div class='control-group'>
                <label class='control-label'>Organization:</label>
                <div class='controls'>
                    <input name='id2info2' id='id2info2' type='hidden' value ='".$uorganizatsiya."'/>
                    <label class='big'>".$uorganizatsiya."</label>
                </div>
            </div>
            <div class='control-group'>
                <label class='control-label required' for='Issue_target'>Purpose of meeting<span class='required'>*</span></label>
                <div class='controls'>
                    <input onfocusout='checkallowsubmit(sss" . $counter . ");' onkeyup='checkallowsubmit(sss" . $counter . ");' onclick='' name='tsel' id='tselm".$counter."' type='text' maxlength='255' />
                        <p id='Issue_tsel_em_' style='display:none' class='help-block'></p>
                </div>
            </div>
            <div class='control-group'>
                <label class='control-label required' for='Issue_date'>Date <span class='required'>*</span></label>
                <div class='controls'>
                    <input name='date' id='Issue_date' type='hidden' />
                    <div id='Issue_date_wrap' class='btn-group' data-toggle='buttons-radio'>
                        <a id='date".$counter."' class='dddd' href='index.php?action=getDate&fi=formlkuchastnikim".$counter."&sss=sss".$counter."&did=29 марта' onclick='return false'>
                            <input type='text' onclick='adddatetohref(this,formlkuchastnikim".$counter.");' class='btn btn-default' data-value='date' value='29 марта' READONLY/>
                        </a>
                         <a id='date".$counter."' class='dddd' href='index.php?action=getDate&fi=formlkuchastnikim".$counter."&sss=sss".$counter."&did=30 марта' onclick='return false'>
                            <input type='text' onclick='adddatetohref(this,formlkuchastnikim".$counter.");' class='btn btn-default' data-value='date' value='30 марта' READONLY/>
                        </a>
                        <a id='date".$counter."' class='dddd' href='index.php?action=getDate&fi=formlkuchastnikim".$counter."&sss=sss".$counter."&did=31 марта' onclick='return false'>
                            <input type='text' onclick='adddatetohref(this,formlkuchastnikim".$counter.");' class='btn btn-default' data-value='date' value='31 марта' READONLY/>
                        </a>
                        <div class='ajax-container'></div>
                    </div>
                    <p id='Issue_date_em_' style='display:none' class='help-block'></p>
                </div>
            </div>
            <div class='control-group'>
                <label class='control-label required' for='Issue_hour'>Time <span class='required'>*</span></label>
                <div class='controls'>
                    <input name='hour' id='Issue_hour' type='hidden' />
                    <div id='Issue_hour_wrap' class='btn-group' data-toggle='buttons-radio'>
                        <a id='date".$counter."' class='dddd' href='index.php?action=getTime&fi=formlkuchastnikim".$counter."&sss=sss".$counter."&tid=09-00' onclick='return false'>
                            <input type='text' onclick='addtimetohref(this,formlkuchastnikim".$counter.");' class='btn btn-default' data-value='time' value='09-00' READONLY/>
                        </a>
                        <a id='date".$counter."' class='dddd' href='index.php?action=getTime&fi=formlkuchastnikim".$counter."&sss=sss".$counter."&tid=10-00' onclick='return false'>
                            <input type='text' onclick='addtimetohref(this,formlkuchastnikim".$counter.");' class='btn btn-default' data-value='time' value='10-00' READONLY/>
                        </a>
                        <a id='date".$counter."' class='dddd' href='index.php?action=getTime&fi=formlkuchastnikim".$counter."&sss=sss".$counter."&tid=11-00' onclick='return false'>
                            <input type='text' onclick='addtimetohref(this,formlkuchastnikim".$counter.");' class='btn btn-default' data-value='time' value='11-00' READONLY/>
                        </a>
                        <a id='date".$counter."' class='dddd' href='index.php?action=getTime&fi=formlkuchastnikim".$counter."&sss=sss".$counter."&tid=12-00' onclick='return false'>
                            <input type='text' onclick='addtimetohref(this,formlkuchastnikim".$counter.");' class='btn btn-default' data-value='time' value='12-00' READONLY/>
                        </a>
                        <a id='date".$counter."' class='dddd' href='index.php?action=getTime&fi=formlkuchastnikim".$counter."&sss=sss".$counter."&tid=13-00' onclick='return false'>
                            <input type='text' onclick='addtimetohref(this,formlkuchastnikim".$counter.");' class='btn btn-default' data-value='time' value='13-00' READONLY/>
                        </a>
                        <a id='date".$counter."' class='dddd' href='index.php?action=getTime&fi=formlkuchastnikim".$counter."&sss=sss".$counter."&tid=14-00' onclick='return false'>
                            <input type='text' onclick='addtimetohref(this,formlkuchastnikim".$counter.");' class='btn btn-default' data-value='time' value='14-00' READONLY/>
                        </a>
                        <a id='date".$counter."' class='dddd' href='index.php?action=getTime&fi=formlkuchastnikim".$counter."&sss=sss".$counter."&tid=15-00' onclick='return false'>
                            <input type='text' onclick='addtimetohref(this,formlkuchastnikim".$counter.");' class='btn btn-default' data-value='time' value='15-00' READONLY/>
                        </a>
                        <a id='date".$counter."' class='dddd' href='index.php?action=getTime&fi=formlkuchastnikim".$counter."&sss=sss".$counter."&tid=16-00' onclick='return false'>
                            <input type='text' onclick='addtimetohref(this,formlkuchastnikim".$counter.");' class='btn btn-default' data-value='time' value='16-00' READONLY/>
                        </a>
                        <a id='date".$counter."' class='dddd' href='index.php?action=getTime&fi=formlkuchastnikim".$counter."&sss=sss".$counter."&tid=17-00' onclick='return false'>
                            <input type='text' onclick='addtimetohref(this,formlkuchastnikim".$counter.");' class='btn btn-default' data-value='time' value='17-00' READONLY/>
                        </a>
                        <a id='date".$counter."' class='dddd' href='index.php?action=getTime&fi=formlkuchastnikim".$counter."&sss=sss".$counter."&tid=18-00' onclick='return false'>
                            <input type='text' onclick='addtimetohref(this,formlkuchastnikim".$counter.");' class='btn btn-default' data-value='time' value='18-00' READONLY/>
                        </a>
                        <div class='ajax-container'></div>
                    </div>
                    <p id='Issue_hour_em_' style='display:none' class='help-block'></p>
                </div>
            </div>
            <div class='control-group'>
                <label class='control-label required' for='Issue_apartments'>Boardroom <span class='required'>*</span></label>
                <div class='controls'>
                    <input name='apartments' id='Issue_apartments' type='hidden' />
                    <div id='Issue_apartments_wrap' class='btn-group' data-toggle='buttons-radio'>
                        <a id='date".$counter."' class='dddd' href='index.php?action=getNper&fi=formlkuchastnikim".$counter."&sss=sss".$counter."&pid=№1' onclick='return false'>
                            <input type='text' onclick='addpidtohref(this,formlkuchastnikim".$counter.");' class='btn btn-default' data-value='nper' value='№1' READONLY/>
                        </a>
                        <a id='date".$counter."' class='dddd' href='index.php?action=getNper&fi=formlkuchastnikim".$counter."&sss=sss".$counter."&pid=№2' onclick='return false'>
                            <input type='text' onclick='addpidtohref(this,formlkuchastnikim".$counter.");' class='btn btn-default' data-value='nper' value='№2' READONLY/>
                        </a>
                        <a id='date".$counter."' class='dddd' href='index.php?action=getNper&fi=formlkuchastnikim".$counter."&sss=sss".$counter."&pid=№3' onclick='return false'>
                            <input type='text' onclick='addpidtohref(this,formlkuchastnikim".$counter.");' class='btn btn-default' data-value='nper' value='№3' READONLY/>
												<a id='date".$counter."' class='dddd' href='index.php?action=getNper&fi=formlkuchastnikim".$counter."&sss=sss".$counter."&pid=№4' onclick='return false'>
                            <input type='text' onclick='addpidtohref(this,formlkuchastnikim".$counter.");' class='btn btn-default' data-value='nper' value='№4' READONLY/>
                        </a>
                        <div class='ajax-container'></div>
                    </div>
                    <p id='Issue_apartments_em_' style='display:none' class='help-block'></p>
                </div>
            </div>
            <div class='control-group'>
                <label class='control-label required' for='Issue_from_name'>Your full name <span class='required'>*</span></label>
                <div class='controls'>
                    <input name='from_name' id='Issue_from_name' type='text' maxlength='255' value='".trim($myname)." ".trim($myimya)." ".trim($myotchestvo)."' />
                    <p id='Issue_from_name_em_' style='display:none' class='help-block'></p>
                </div>
            </div>
            <div class='control-group'>
                <label class='control-label required' for='Issue_from_org'>Your organization <span class='required'>*</span></label>
                <div class='controls'>
                    <input name='from_org' id='Issue_from_org' type='text' maxlength='255' value='".$myorganizatsiya."' />
                    <p id='Issue_from_org_em_' style='display:none' class='help-block'></p>
                </div>
            </div>
            <div class='control-group'>
                <label class='control-label required' for='Issue_from_post'>Your position <span class='required'>*</span></label>
                <div class='controls'>
                    <input name='from_post' id='Issue_from_post' type='text' maxlength='255' value='".$mydolzhnost."' />
                    <p id='Issue_from_post_em_' style='display:none' class='help-block'></p>
                </div>
            </div>
            <div class='control-group'>
                <label class='control-label required' for='Issue_from_tel'>Your phone <span class='required'>*</span></label>
                <div class='controls'>
                    <input name='from_tel' id='Issue_from_tel' type='text' maxlength='255' value='".$mykontaktnyytelefon."' />
                    <p id='Issue_from_tel_em_' style='display:none' class='help-block'></p>
                </div>
            </div>
            <div class='control-group'>
                <label class='control-label required' for='Issue_from_email'>Your E-Mail <span class='required'>*</span></label>
                <div class='controls'>
                    <input name='from_email' id='Issue_from_email' type='text' maxlength='255' value='".$myemail."' />
                    <p id='Issue_from_email_em_' style='display:none' class='help-block'></p>
                </div>
            </div>
            <div class='form-actions'>
                <script>
                    jQuery('#formlkuchastnikim".$counter." .dddd').click(function() {
                        clickajax(this);
                        addname(this);
                    });
                </script>
                <input id='subm".$counter."' name='subm".$counter."' class='btn btn-primary inactive' type='button' value='Assign'>
                <script>
                    jQuery(document).ready(function() {
                        sss" . $counter . " = 'm" . $counter . "';
//                        checkallowsubmit(sss" . $counter . ");
                    });
                </script>
                <script>if(jQuery('#formlkuchastnikim".$counter." input[data-value=\"date\"]').attr('onclick')){dateclickformlkuchastnikim".$counter." = jQuery('#formlkuchastnikim".$counter." input[data-value=\"date\"]').attr('onclick');}</script>
                <script>if(jQuery('#formlkuchastnikim".$counter." input[data-value=\"time\"]').attr('onclick')){timeclickformlkuchastnikim".$counter." = jQuery('#formlkuchastnikim".$counter." input[data-value=\"time\"]').attr('onclick');}</script>
                <script>if(jQuery('#formlkuchastnikim".$counter." input[data-value=\"nper\"]').attr('onclick')){nperclickformlkuchastnikim".$counter." = jQuery('#formlkuchastnikim".$counter." input[data-value=\"nper\"]').attr('onclick');}</script>

            </div>
        </form>
";

        elseif('ru-RU' == $curlang ):
            echo "
        <a class='chekonload' href='index.php?action=getForm&sss=sss".$counter."&fi=formlkuchastnikim".$counter."' onclick='clickajax(this);return false'></a>
        <form class='form-reg form-horizontal' id='issue-form".$counter."' name='issue-form".$counter."' method='post' action=''>
            <div class='control-group'>
                <label class='control-label'>Ф.И.О.:</label>
                <div class='controls'>
                    <input name='id2info1' id='id2info1' type='hidden' value ='".$uname." ".$uimya." ".$uotchestvo."'/>
                    <label class='big'>".$uname." ".$uimya." ".$uotchestvo."</label>
                </div>
            </div>
            <div class='control-group'>
                <label class='control-label'>Должность:</label>
                <div class='controls'>
                    <input name='id2info3' id='id2info3' type='hidden' value ='".$udolzhnost."'/>
                    <label class='big'>".$udolzhnost."</label>
                </div>
            </div>
            <div class='control-group'>
                <label class='control-label'>Компания:</label>
                <div class='controls'>
                    <input name='id2info2' id='id2info2' type='hidden' value ='".$uorganizatsiya."'/>
                    <label class='big'>".$uorganizatsiya."</label>
                </div>
            </div>
            <div class='control-group'>
                <label class='control-label required' for='Issue_target'>Цель встречи<span class='required'>*</span></label>
                <div class='controls'>
                    <input onfocusout='checkallowsubmit(sss" . $counter . ");' onkeyup='checkallowsubmit(sss" . $counter . ");' onclick='' name='tsel' id='tselm".$counter."' type='text' maxlength='255' required />
                        <p id='Issue_tsel_em_' style='display:none' class='help-block'></p>
                </div>
            </div>
            <div class='control-group'>
                <label class='control-label required' for='Issue_date'>Дата <span class='required'>*</span></label>
                <div class='controls'>
                    <input name='date' id='Issue_date' type='hidden' required />
                    <div id='Issue_date_wrap' class='btn-group' data-toggle='buttons-radio'>
                        <a id='date".$counter."' class='dddd' href='index.php?action=getDate&fi=formlkuchastnikim".$counter."&sss=sss".$counter."&did=29 марта' onclick='return false'>
                            <input type='text' onclick='adddatetohref(this,formlkuchastnikim".$counter.");' class='btn btn-default' data-value='date' value='29 марта' READONLY/>
                        </a>
                         <a id='date".$counter."' class='dddd' href='index.php?action=getDate&fi=formlkuchastnikim".$counter."&sss=sss".$counter."&did=30 марта' onclick='return false'>
                            <input type='text' onclick='adddatetohref(this,formlkuchastnikim".$counter.");' class='btn btn-default' data-value='date' value='30 марта' READONLY/>
                        </a>
                        <a id='date".$counter."' class='dddd' href='index.php?action=getDate&fi=formlkuchastnikim".$counter."&sss=sss".$counter."&did=31 марта' onclick='return false'>
                            <input type='text' onclick='adddatetohref(this,formlkuchastnikim".$counter.");' class='btn btn-default' data-value='date' value='31 марта' READONLY/>
                        </a>
                        <div class='ajax-container'></div>
                    </div>
                    <p id='Issue_date_em_' style='display:none' class='help-block'></p>
                </div>
            </div>
            <div class='control-group'>
                <label class='control-label required' for='Issue_hour'>Время <span class='required'>*</span></label>
                <div class='controls'>
                    <input name='hour' id='Issue_hour' type='hidden' required />
                    <div id='Issue_hour_wrap' class='btn-group' data-toggle='buttons-radio'>
                        <a id='date".$counter."' class='dddd' href='index.php?action=getTime&fi=formlkuchastnikim".$counter."&sss=sss".$counter."&tid=09-00' onclick='return false'>
                            <input type='text' onclick='addtimetohref(this,formlkuchastnikim".$counter.");' class='btn btn-default' data-value='time' value='09-00' READONLY/>
                        </a>
                        <a id='date".$counter."' class='dddd' href='index.php?action=getTime&fi=formlkuchastnikim".$counter."&sss=sss".$counter."&tid=10-00' onclick='return false'>
                            <input type='text' onclick='addtimetohref(this,formlkuchastnikim".$counter.");' class='btn btn-default' data-value='time' value='10-00' READONLY/>
                        </a>
                        <a id='date".$counter."' class='dddd' href='index.php?action=getTime&fi=formlkuchastnikim".$counter."&sss=sss".$counter."&tid=11-00' onclick='return false'>
                            <input type='text' onclick='addtimetohref(this,formlkuchastnikim".$counter.");' class='btn btn-default' data-value='time' value='11-00' READONLY/>
                        </a>
                        <a id='date".$counter."' class='dddd' href='index.php?action=getTime&fi=formlkuchastnikim".$counter."&sss=sss".$counter."&tid=12-00' onclick='return false'>
                            <input type='text' onclick='addtimetohref(this,formlkuchastnikim".$counter.");' class='btn btn-default' data-value='time' value='12-00' READONLY/>
                        </a>
                        <a id='date".$counter."' class='dddd' href='index.php?action=getTime&fi=formlkuchastnikim".$counter."&sss=sss".$counter."&tid=13-00' onclick='return false'>
                            <input type='text' onclick='addtimetohref(this,formlkuchastnikim".$counter.");' class='btn btn-default' data-value='time' value='13-00' READONLY/>
                        </a>
                        <a id='date".$counter."' class='dddd' href='index.php?action=getTime&fi=formlkuchastnikim".$counter."&sss=sss".$counter."&tid=14-00' onclick='return false'>
                            <input type='text' onclick='addtimetohref(this,formlkuchastnikim".$counter.");' class='btn btn-default' data-value='time' value='14-00' READONLY/>
                        </a>
                        <a id='date".$counter."' class='dddd' href='index.php?action=getTime&fi=formlkuchastnikim".$counter."&sss=sss".$counter."&tid=15-00' onclick='return false'>
                            <input type='text' onclick='addtimetohref(this,formlkuchastnikim".$counter.");' class='btn btn-default' data-value='time' value='15-00' READONLY/>
                        </a>
                        <a id='date".$counter."' class='dddd' href='index.php?action=getTime&fi=formlkuchastnikim".$counter."&sss=sss".$counter."&tid=16-00' onclick='return false'>
                            <input type='text' onclick='addtimetohref(this,formlkuchastnikim".$counter.");' class='btn btn-default' data-value='time' value='16-00' READONLY/>
                        </a>
                        <a id='date".$counter."' class='dddd' href='index.php?action=getTime&fi=formlkuchastnikim".$counter."&sss=sss".$counter."&tid=17-00' onclick='return false'>
                            <input type='text' onclick='addtimetohref(this,formlkuchastnikim".$counter.");' class='btn btn-default' data-value='time' value='17-00' READONLY/>
                        </a>
                        <a id='date".$counter."' class='dddd' href='index.php?action=getTime&fi=formlkuchastnikim".$counter."&sss=sss".$counter."&tid=18-00' onclick='return false'>
                            <input type='text' onclick='addtimetohref(this,formlkuchastnikim".$counter.");' class='btn btn-default' data-value='time' value='18-00' READONLY/>
                        </a>
                        <div class='ajax-container'></div>
                    </div>
                    <p id='Issue_hour_em_' style='display:none' class='help-block'></p>
                </div>
            </div>
            <div class='control-group'>
                <label class='control-label required' for='Issue_apartments'>Переговорная <span class='required'>*</span></label>
                <div class='controls'>
                    <input name='apartments' id='Issue_apartments' type='hidden' required />
                    <div id='Issue_apartments_wrap' class='btn-group' data-toggle='buttons-radio'>
                        <a id='date".$counter."' class='dddd' href='index.php?action=getNper&fi=formlkuchastnikim".$counter."&sss=sss".$counter."&pid=№1' onclick='return false'>
                            <input type='text' onclick='addpidtohref(this,formlkuchastnikim".$counter.");' class='btn btn-default' data-value='nper' value='№1' READONLY/>
                        </a>
                        <a id='date".$counter."' class='dddd' href='index.php?action=getNper&fi=formlkuchastnikim".$counter."&sss=sss".$counter."&pid=№2' onclick='return false'>
                            <input type='text' onclick='addpidtohref(this,formlkuchastnikim".$counter.");' class='btn btn-default' data-value='nper' value='№2' READONLY/>
                        </a>
                        <a id='date".$counter."' class='dddd' href='index.php?action=getNper&fi=formlkuchastnikim".$counter."&sss=sss".$counter."&pid=№3' onclick='return false'>
                            <input type='text' onclick='addpidtohref(this,formlkuchastnikim".$counter.");' class='btn btn-default' data-value='nper' value='№3' READONLY/>
                        </a>
												<a id='date".$counter."' class='dddd' href='index.php?action=getNper&fi=formlkuchastnikim".$counter."&sss=sss".$counter."&pid=№4' onclick='return false'>
                            <input type='text' onclick='addpidtohref(this,formlkuchastnikim".$counter.");' class='btn btn-default' data-value='nper' value='№4' READONLY/>
                        </a>
                        <div class='ajax-container'></div>
                    </div>
                    <p id='Issue_apartments_em_' style='display:none' class='help-block'></p>
                </div>
            </div>
            <div class='control-group'>
                <label class='control-label required' for='Issue_from_name'>Ваши Ф.И.О. <span class='required'>*</span></label>
                <div class='controls'>
                    <input name='from_name' id='Issue_from_name' type='text' maxlength='255' value='".trim($myname)." ".trim($myimya)." ".trim($myotchestvo)."' required />
                    <p id='Issue_from_name_em_' style='display:none' class='help-block'></p>
                </div>
            </div>
            <div class='control-group'>
                <label class='control-label required' for='Issue_from_org'>Ваша организация <span class='required'>*</span></label>
                <div class='controls'>
                    <input name='from_org' id='Issue_from_org' type='text' maxlength='255' value='".$myorganizatsiya."' required />
                    <p id='Issue_from_org_em_' style='display:none' class='help-block'></p>
                </div>
            </div>
            <div class='control-group'>
                <label class='control-label required' for='Issue_from_post'>Ваша должность <span class='required'>*</span></label>
                <div class='controls'>
                    <input name='from_post' id='Issue_from_post' type='text' maxlength='255' value='".$mydolzhnost."' required />
                    <p id='Issue_from_post_em_' style='display:none' class='help-block'></p>
                </div>
            </div>
            <div class='control-group'>
                <label class='control-label required' for='Issue_from_tel'>Ваш телефон <span class='required'>*</span></label>
                <div class='controls'>
                    <input name='from_tel' id='Issue_from_tel' type='text' maxlength='255' value='".$mykontaktnyytelefon."' required />
                    <p id='Issue_from_tel_em_' style='display:none' class='help-block'></p>
                </div>
            </div>
            <div class='control-group'>
                <label class='control-label required' for='Issue_from_email'>Ваш E-Mail <span class='required'>*</span></label>
                <div class='controls'>
                    <input name='from_email' id='Issue_from_email' type='text' maxlength='255' value='".$myemail."' required />
                    <p id='Issue_from_email_em_' style='display:none' class='help-block'></p>
                </div>
            </div>
            <div class='form-actions'>
                <script>
                    jQuery('#formlkuchastnikim".$counter." .dddd').click(function() {
                        clickajax(this);
                        addname(this);
                    });
                </script>
                <input id='subm".$counter."' name='subm".$counter."' class='btn btn-primary' type='submit' value='Назначить' style='margin-left:22%'>
                <script>
                    jQuery(document).ready(function() {
                        sss" . $counter . " = 'm" . $counter . "';
//                        checkallowsubmit(sss" . $counter . ");
                    });
                </script>
                <script>if(jQuery('#formlkuchastnikim".$counter." input[data-value=\"date\"]').attr('onclick')){dateclickformlkuchastnikim".$counter." = jQuery('#formlkuchastnikim".$counter." input[data-value=\"date\"]').attr('onclick');}</script>
                <script>if(jQuery('#formlkuchastnikim".$counter." input[data-value=\"time\"]').attr('onclick')){timeclickformlkuchastnikim".$counter." = jQuery('#formlkuchastnikim".$counter." input[data-value=\"time\"]').attr('onclick');}</script>
                <script>if(jQuery('#formlkuchastnikim".$counter." input[data-value=\"nper\"]').attr('onclick')){nperclickformlkuchastnikim".$counter." = jQuery('#formlkuchastnikim".$counter." input[data-value=\"nper\"]').attr('onclick');}</script>

            </div>
        </form>
";
        endif;

?>
