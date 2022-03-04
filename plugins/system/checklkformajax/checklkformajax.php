<?php
// No direct access
defined( '_JEXEC' ) or die;

/**
 *
 * @package     Joomla.Plugin
 * @subpackage  System.Testajax
 * @since       2.5+
 * @author
 */
class plgSystemchecklkformajax extends JPlugin
{
	/**
	 * Class Constructor
	 * @param object $subject
	 * @param array $config
	 */
	public function __construct( & $subject, $config )
	{
		parent::__construct( $subject, $config );
		$this->loadLanguage();
	}

	function onAfterInitialise()
	{
		$input = JFactory::getApplication()->input;
///////////////////////////////////// ЧЕК  НА ЗАГРУЗКУ ФОРМЫ ////////////////////////////////////////
        if ( $input->getCmd( 'action', '' ) === 'getForm' ) {
            $fi = $input->get( 'fi', 1, STRING );
            $sss = $input->get( 'sss', 1, STRING );
            $ssss = $input->get( 'ssss', 1, STRING );
            $did = $input->get( 'did', 1, STRING );
            $tid = $input->get( 'tid', 1, STRING );
            $pid = $input->get( 'pid', 1, STRING );
            $id0 = '17 марта';
            $id1 = '18 марта';
            $id2 = '19 марта';
            $db = JFactory::getDbo();
            $query0 = $db->getQuery(true);
            $query0->select( 'count(*) ' )->from( '#__lk_vstrechi' )->where( 'LK_DATE=' . $db->quote($id0) );
            $db->setQuery( $query0 ); $cntdate0 = $db->loadResult();
            $query1 = $db->getQuery(true);
            $query1->select( 'count(*) ' )->from( '#__lk_vstrechi' )->where( 'LK_DATE=' . $db->quote($id1) );
            $db->setQuery( $query1 ); $cntdate1 = $db->loadResult();
            $query2 = $db->getQuery(true);
            $query2->select( 'count(*) ' )->from( '#__lk_vstrechi' )->where( 'LK_DATE=' . $db->quote($id2) );
            $db->setQuery( $query2 ); $cntdate2 = $db->loadResult();
            if ( ($cntdate2 > 29) && ($cntdate1 > 29) && ($cntdate0 > 29)) {
                echo '<script>jQuery("#'.$fi.' input[value=\"'.$id2.'\"]").addClass("btnoccup").removeClass("btn").prop("onclick", null).attr("onclick", null);</script>';
                echo '<script>jQuery("#'.$fi.' input[value=\"'.$id1.'\"]").addClass("btnoccup").removeClass("btn").prop("onclick", null).attr("onclick", null);</script>';
                echo '<script>jQuery("#'.$fi.' input[data-value=\"time\"]").addClass("btnoccup").removeClass("btn").prop("onclick", null).attr("onclick", null);</script>';
                echo '<script>jQuery("#'.$fi.' input[data-value=\"nper\"]").addClass("btnoccup").removeClass("btn").prop("onclick", null).attr("onclick", null);</script>';
            }
            if ( ($cntdate2 < 29) && ($cntdate1 > 29) && ($cntdate0 < 29) ) {
                echo '<script>jQuery("#'.$fi.' input[value=\"'.$id1.'\"]").addClass("btnoccup").removeClass("btn").prop("onclick", null).attr("onclick", null);</script>';
            }
            if ( ($cntdate2 > 29) && ($cntdate1 < 29) && ($cntdate0 < 29) ) {
                echo '<script>jQuery("#'.$fi.' input[value=\"'.$id2.'\"]").addClass("btnoccup").removeClass("btn").prop("onclick", null).attr("onclick", null);</script>';
            }
            if ( ($cntdate2 < 29) && ($cntdate1 < 29) && ($cntdate0 > 29) ) {
                echo '<script>jQuery("#'.$fi.' input[value=\"'.$id0.'\"]").addClass("btnoccup").removeClass("btn").prop("onclick", null).attr("onclick", null);</script>';
            }
            if ( ($cntdate2 > 29) && ($cntdate1 < 29) && ($cntdate0 > 29) ) {
                echo '<script>jQuery("#'.$fi.' input[value=\"'.$id0.'\"]").addClass("btnoccup").removeClass("btn").prop("onclick", null).attr("onclick", null);</script>';
                echo '<script>jQuery("#'.$fi.' input[value=\"'.$id2.'\"]").addClass("btnoccup").removeClass("btn").prop("onclick", null).attr("onclick", null);</script>';
            }
            if ( ($cntdate2 < 29) && ($cntdate1 > 29) && ($cntdate0 > 29) ) {
                echo '<script>jQuery("#'.$fi.' input[value=\"'.$id0.'\"]").addClass("btnoccup").removeClass("btn").prop("onclick", null).attr("onclick", null);</script>';
                echo '<script>jQuery("#'.$fi.' input[value=\"'.$id1.'\"]").addClass("btnoccup").removeClass("btn").prop("onclick", null).attr("onclick", null);</script>';
            }
            if ( ($cntdate2 > 29) && ($cntdate1 > 29) && ($cntdate0 < 29) ) {
                echo '<script>jQuery("#'.$fi.' input[value=\"'.$id1.'\"]").addClass("btnoccup").removeClass("btn").prop("onclick", null).attr("onclick", null);</script>';
                echo '<script>jQuery("#'.$fi.' input[value=\"'.$id2.'\"]").addClass("btnoccup").removeClass("btn").prop("onclick", null).attr("onclick", null);</script>';
            }
            if ($sss != 1) {echo "<script>addname();checkallowsubmit(" . $sss . ")</script>";}
            if ($ssss != 1) {echo "<script>addname();checkallowsubmit(" . $ssss . ")</script>";}
            return exit;
        }
///////////////////////////////////// ЧЕК  ПО КЛИКУ НА ДАТУ ////////////////////////////////////////
        if ( $input->getCmd( 'action', '' ) === 'getDate' ) {
            $fi = $input->get( 'fi', 1, STRING );
            $sss = $input->get( 'sss', 1, STRING );
            $ssss = $input->get( 'ssss', 1, STRING );
            $did = $input->get( 'did', 1, STRING );
            $tid = $input->get( 'tid', 1, STRING );
            $pid = $input->get( 'pid', 1, STRING );
            echo '<script>if(jQuery("#' . $fi . ' input[data-value=\"date\"]").attr("onclick")){dateclick' . $fi . ' = jQuery("#' . $fi . ' input[data-value=\"date\"]").attr("onclick");}</script>';
            echo '<script>if(jQuery("#' . $fi . ' input[data-value=\"time\"]").attr("onclick")){timeclick' . $fi . ' = jQuery("#' . $fi . ' input[data-value=\"time\"]").attr("onclick");}</script>';
            echo '<script>if(jQuery("#' . $fi . ' input[data-value=\"nper\"]").attr("onclick")){nperclick' . $fi . ' = jQuery("#' . $fi . ' input[data-value=\"nper\"]").attr("onclick");}</script>';
            echo '<script>jQuery("#' . $fi . ' input[data-value=\"date\"]").removeClass("btnoccup").addClass("btn").attr("onclick", dateclick' . $fi . ');</script>';
            echo '<script>jQuery("#' . $fi . ' input[data-value=\"time\"]").removeClass("btnoccup").addClass("btn").attr("onclick", timeclick' . $fi . ');</script>';
            echo '<script>jQuery("#' . $fi . ' input[data-value=\"nper\"]").removeClass("btnoccup").addClass("btn").attr("onclick", nperclick' . $fi . ');</script>';
            if($tid != 1) {echo '<script>jQuery("#'.$fi.' input[value=\"'.$tid.'\"]").addClass("active");</script>';}
            if($did != 1) {echo '<script>jQuery("#'.$fi.' input[value=\"'.$did.'\"]").addClass("active");</script>';}
            if($pid != 1) {echo '<script>jQuery("#'.$fi.' input[value=\"'.$pid.'\"]").addClass("active");</script>';}
            ///////////////// если нет переговорной и времени
            if( ($pid == 1) && ($tid == 1) ) {
                $db = JFactory::getDbo();
                $query1 = $db->getQuery(true);
                $query1->select('count(*)')->from('#__lk_vstrechi')->where('LK_DATE=' . $db->quote($did));
                $db->setQuery($query1);
                $cntdate = $db->loadResult();
                if ($cntdate > 29) {
                    echo '<script>jQuery("#'.$fi.' input[value=\"'.$did.'\"]").addClass("btnoccup").removeClass("btn active").prop("onclick", null).attr("onclick", null);</script>';
                    echo '<script>jQuery("#'.$fi.' input[data-value=\"time\"]").addClass("btnoccup").removeClass("btn").prop("onclick", null).attr("onclick", null);</script>';
//                    echo '<script>jQuery("#'.$fi.' input[data-value=\"time\"]").parent().attr("href", null).attr("onclick", null);</script>';
                    echo '<script>jQuery("#'.$fi.' input[data-value=\"nper\"]").addClass("btnoccup").removeClass("btn").prop("onclick", null).attr("onclick", null);</script>';
//                    echo '<script>jQuery("#'.$fi.' input[data-value=\"nper\"]").parent().attr("href", null).attr("onclick", null);</script>';
                }
                if ($cntdate < 30) {
                    $query00 = $db->getQuery(true);
                    $query00->select('id, LK_DATE, LK_TIME, N_PER')->from('#__lk_vstrechi')->where('LK_DATE=' . $db->quote($did));
                    $db->setQuery($query00);
                    $rows = $db->loadObjectList();
                    if (!empty($rows)) {
                        foreach ($rows as $row) {
                            $query01 = $db->getQuery(true);
                            $query01->select('count(*)')->from('#__lk_vstrechi')->where('LK_TIME=' . $db->quote($row->LK_TIME) . ' AND LK_DATE=' . $db->quote($row->LK_DATE));
                            $db->setQuery($query01);
                            $cnt = $db->loadResult();
                            $query02 = $db->getQuery(true);
                            $query02->select('id, LK_DATE, LK_TIME, N_PER')->from('#__lk_vstrechi')->where('LK_TIME=' . $db->quote($row->LK_TIME) . ' AND LK_DATE=' . $db->quote($row->LK_DATE));
                            $db->setQuery($query02);
                            $db->loadObjectList();
                            if ($cnt > 2) {
                                echo '<script>jQuery("#' . $fi . ' input[value=\"' . $row->LK_TIME . '\"]").addClass("btnoccup").removeClass("btn active").prop("onclick", null).attr("onclick", null);</script>';
                            }
                        }
                    }
                }
            }
            ///////////////// если нет переговорной и есть время
            if( ($pid == 1) && ($tid != 1) ) {
                $db = JFactory::getDbo();
                $query1 = $db->getQuery(true);
                $query1->select('count(*)')->from('#__lk_vstrechi')->where('LK_DATE=' . $db->quote($did) . ' AND LK_TIME=' . $db->quote($tid));
                $db->setQuery($query1);
                $cntdate = $db->loadResult();
                if ($cntdate > 2) {
                    echo '<script>jQuery("#'.$fi.' input[value=\"'.$did.'\"]").addClass("btnoccup").removeClass("btn active").prop("onclick", null).attr("onclick", null);</script>';
                    echo '<script>jQuery("#'.$fi.' input[value=\"'.$tid.'\"]").addClass("btnoccup").removeClass("btn active").prop("onclick", null).attr("onclick", null);</script>';
                    echo '<script>jQuery("#'.$fi.' input[data-value=\"nper\"]").addClass("btnoccup").removeClass("btn").prop("onclick", null).attr("onclick", null);</script>';
//                    echo '<script>jQuery("#'.$fi.' input[data-value=\"nper\"]").parent().attr("href", null).attr("onclick", null);</script>';
                }
                if ($cntdate < 3) {
                    $query00 = $db->getQuery(true);
                    $query00->select('id, LK_DATE, LK_TIME, N_PER')->from('#__lk_vstrechi')->where('LK_TIME=' . $db->quote($tid) . ' AND LK_DATE=' . $db->quote($did));
                    $db->setQuery($query00);
                    $rows = $db->loadObjectList();
                    if (!empty($rows)) {
                        foreach ($rows as $row) {
                            echo '<script>jQuery("#'.$fi.' input[value=\"'.$row->LK_TIME.'\"]").addClass("btnoccup").removeClass("btn active").prop("onclick", null).attr("onclick", null);</script>';
                            echo '<script>jQuery("#'.$fi.' input[value=\"'.$row->N_PER.'\"]").addClass("btnoccup").removeClass("btn active").prop("onclick", null).attr("onclick", null);</script>';
                        }
                    }
                }
            }
            ///////////////// если нет времени и есть переговорная
            if( ($pid != 1) && ($tid == 1) ) {
                $db = JFactory::getDbo();
                $query1 = $db->getQuery(true);
                $query1->select('count(*)')->from('#__lk_vstrechi')->where('LK_DATE=' . $db->quote($did) . ' AND N_PER=' . $db->quote($pid));
                $db->setQuery($query1);
                $cntdate = $db->loadResult();
                if ($cntdate > 9) {
                    echo '<script>jQuery("#'.$fi.' input[value=\"'.$did.'\"]").addClass("btnoccup").removeClass("btn active").prop("onclick", null).attr("onclick", null);</script>';
                    echo '<script>jQuery("#'.$fi.' input[value=\"'.$pid.'\"]").addClass("btnoccup").removeClass("btn active").prop("onclick", null).attr("onclick", null);</script>';
                    echo '<script>jQuery("#'.$fi.' input[data-value=\"time\"]").addClass("btnoccup").removeClass("btn").prop("onclick", null).attr("onclick", null);</script>';
//                    echo '<script>jQuery("#'.$fi.' input[data-value=\"time\"]").parent().attr("href", null).attr("onclick", null);</script>';
                }
                if ($cntdate < 10) {
                    $query00 = $db->getQuery(true);
                    $query00->select('id, LK_DATE, LK_TIME, N_PER')->from('#__lk_vstrechi')->where('N_PER=' . $db->quote($pid) . ' AND LK_DATE=' . $db->quote($did));
                    $db->setQuery($query00);
                    $rows = $db->loadObjectList();
                    if (!empty($rows)) {
                        foreach ($rows as $row) {
                            echo '<script>jQuery("#'.$fi.' input[value=\"'.$row->LK_TIME.'\"]").addClass("btnoccup").removeClass("btn active").prop("onclick", null).attr("onclick", null);</script>';
                            echo '<script>jQuery("#'.$fi.' input[value=\"'.$row->N_PER.'\"]").addClass("btnoccup").removeClass("btn active").prop("onclick", null).attr("onclick", null);</script>';
                        }
                    }
                }
            }
            ///////////////// если есть переговорная и время
            if( ($pid != 1) && ($tid != 1) ) {
                $db = JFactory::getDbo();
                $query00 = $db->getQuery(true);
                $query00->select('id, LK_DATE, LK_TIME, N_PER')->from('#__lk_vstrechi')->where('N_PER=' . $db->quote($pid) . ' AND LK_DATE=' . $db->quote($did) . ' AND LK_TIME=' . $db->quote($tid));
                $db->setQuery($query00);
                $rows = $db->loadObjectList();
                if (!empty($rows)) {
                    foreach ($rows as $row) {
                        echo '<script>jQuery("#'.$fi.' input[value=\"'.$row->LK_TIME.'\"]").addClass("btnoccup").removeClass("btn active").prop("onclick", null).attr("onclick", null);</script>';
                        echo '<script>jQuery("#'.$fi.' input[value=\"'.$row->N_PER.'\"]").addClass("btnoccup").removeClass("btn active").prop("onclick", null).attr("onclick", null);</script>';
                        echo '<script>jQuery("#'.$fi.' input[value=\"'.$row->LK_DATE.'\"]").addClass("btnoccup").removeClass("btn active").prop("onclick", null).attr("onclick", null);</script>';
                    }
                }
            }
            if ($sss != 1) {echo "<script>addname();checkallowsubmit(" . $sss . ")</script>";}
            if ($ssss != 1) {echo "<script>addname();checkallowsubmit(" . $ssss . ")</script>";}
            return exit;
        }
///////////////////////////////////// ЧЕК  ПО КЛИКУ НА ВРЕМЯ ////////////////////////////////////////
        if ( $input->getCmd( 'action', '' ) === 'getTime' ) {
            $fi = $input->get( 'fi', 1, STRING );
            $sss = $input->get( 'sss', 1, STRING );
            $ssss = $input->get( 'ssss', 1, STRING );
            $did = $input->get( 'did', 1, STRING );
            $tid = $input->get( 'tid', 1, STRING );
            $pid = $input->get( 'pid', 1, STRING );
            echo '<script>if(jQuery("#' . $fi . ' input[data-value=\"date\"]").attr("onclick")){dateclick' . $fi . ' = jQuery("#' . $fi . ' input[data-value=\"date\"]").attr("onclick");}</script>';
            echo '<script>if(jQuery("#' . $fi . ' input[data-value=\"time\"]").attr("onclick")){timeclick' . $fi . ' = jQuery("#' . $fi . ' input[data-value=\"time\"]").attr("onclick");}</script>';
            echo '<script>if(jQuery("#' . $fi . ' input[data-value=\"nper\"]").attr("onclick")){nperclick' . $fi . ' = jQuery("#' . $fi . ' input[data-value=\"nper\"]").attr("onclick");}</script>';
            echo '<script>jQuery("#' . $fi . ' input[data-value=\"date\"]").removeClass("btnoccup").addClass("btn").attr("onclick", dateclick' . $fi . ');</script>';
            echo '<script>jQuery("#' . $fi . ' input[data-value=\"time\"]").removeClass("btnoccup").addClass("btn").attr("onclick", timeclick' . $fi . ');</script>';
            echo '<script>jQuery("#' . $fi . ' input[data-value=\"nper\"]").removeClass("btnoccup").addClass("btn").attr("onclick", nperclick' . $fi . ');</script>';
            if($tid != 1) {echo '<script>jQuery("#'.$fi.' input[value=\"'.$tid.'\"]").addClass("active");</script>';}
            if($did != 1) {echo '<script>jQuery("#'.$fi.' input[value=\"'.$did.'\"]").addClass("active");</script>';}
            if($pid != 1) {echo '<script>jQuery("#'.$fi.' input[value=\"'.$pid.'\"]").addClass("active");</script>';}
            ////////////////если нет переговорной и даты
            if( ($pid == 1) && ($did == 1) ) {
                $db = JFactory::getDbo();
                $query1 = $db->getQuery(true);
                $query1->select('count(*)')->from('#__lk_vstrechi')->where('LK_TIME=' . $db->quote($tid));
                $db->setQuery($query1);
                $cntdate = $db->loadResult();
                if ($cntdate > 8) {
                    echo '<script>jQuery("#'.$fi.' input[value=\"'.$tid.'\"]").addClass("btnoccup").removeClass("btn active").prop("onclick", null).attr("onclick", null);</script>';
                    echo '<script>jQuery("#'.$fi.' input[data-value=\"date\"]").addClass("btnoccup").removeClass("btn").prop("onclick", null).attr("onclick", null);</script>';
                    echo '<script>jQuery("#'.$fi.' input[data-value=\"nper\"]").addClass("btnoccup").removeClass("btn").prop("onclick", null).attr("onclick", null);</script>';
                }
                if ($cntdate < 9) {
                    $query00 = $db->getQuery(true);
                    $query00->select('id, LK_DATE, LK_TIME, N_PER')->from('#__lk_vstrechi')->where('LK_TIME=' . $db->quote($tid));
                    $db->setQuery($query00);
                    $rows = $db->loadObjectList();
                    if (!empty($rows)) {
                        foreach ($rows as $row) {
                            $query01 = $db->getQuery(true);
                            $query01->select('count(*)')->from('#__lk_vstrechi')->where('N_PER=' . $db->quote($row->N_PER) . ' AND LK_DATE=' . $db->quote($row->LK_DATE));
                            $db->setQuery($query01);
                            $cnt = $db->loadResult();
                            $query02 = $db->getQuery(true);
                            $query02->select('id, LK_DATE, LK_TIME, N_PER')->from('#__lk_vstrechi')->where('N_PER=' . $db->quote($row->N_PER) . ' AND LK_DATE=' . $db->quote($row->LK_DATE));
                            $db->setQuery($query02);
                            $db->loadObjectList();
                            if ($cnt > 2) {
                                echo '<script>jQuery("#' . $fi . ' input[value=\"' . $row->LK_DATE . '\"]").addClass("btnoccup").removeClass("btn active").prop("onclick", null).attr("onclick", null);</script>';
                                echo '<script>jQuery("#' . $fi . ' input[value=\"' . $row->N_PER . '\"]").addClass("btnoccup").removeClass("btn active").prop("onclick", null).attr("onclick", null);</script>';
                                echo '<script>jQuery("#' . $fi . ' input[value=\"' . $row->LK_TIME . '\"]").addClass("btnoccup").removeClass("btn active").prop("onclick", null).attr("onclick", null);</script>';
                            }
                        }
                    }
                }
            }
            ////////////////если нет переговорной и есть дата
            if( ($pid == 1) && ($did != 1) ) {
                $db = JFactory::getDbo();
                $query1 = $db->getQuery(true);
                $query1->select('count(*)')->from('#__lk_vstrechi')->where('LK_DATE=' . $db->quote($did) . ' AND LK_TIME=' . $db->quote($tid));
                $db->setQuery($query1);
                $cntdate = $db->loadResult();
                if ($cntdate > 2) {
                    echo '<script>jQuery("#'.$fi.' input[value=\"'.$did.'\"]").addClass("btnoccup").removeClass("btn active").prop("onclick", null).attr("onclick", null);</script>';
                    echo '<script>jQuery("#'.$fi.' input[value=\"'.$tid.'\"]").addClass("btnoccup").removeClass("btn active").prop("onclick", null).attr("onclick", null);</script>';
                    echo '<script>jQuery("#'.$fi.' input[data-value=\"nper\"]").addClass("btnoccup").removeClass("btn").prop("onclick", null).attr("onclick", null);</script>';
//                    echo '<script>jQuery("#'.$fi.' input[data-value=\"nper\"]").parent().attr("href", null).attr("onclick", null);</script>';
                }
                if ($cntdate < 3) {
                    $query00 = $db->getQuery(true);
                    $query00->select('id, LK_DATE, LK_TIME, N_PER')->from('#__lk_vstrechi')->where('LK_TIME=' . $db->quote($tid) . ' AND LK_DATE=' . $db->quote($did));
                    $db->setQuery($query00);
                    $rows = $db->loadObjectList();
                    if (!empty($rows)) {
                        foreach ($rows as $row) {
                            echo '<script>jQuery("#'.$fi.' input[value=\"'.$row->LK_TIME.'\"]").addClass("btnoccup").removeClass("btn active").prop("onclick", null).attr("onclick", null);</script>';
                            echo '<script>jQuery("#'.$fi.' input[value=\"'.$row->N_PER.'\"]").addClass("btnoccup").removeClass("btn active").prop("onclick", null).attr("onclick", null);</script>';
                        }
                    }
                }
            }
            ////////////////если есть переговорная и нет даты
            if( ($pid != 1) && ($did == 1) ) {
                $db = JFactory::getDbo();
                $query00 = $db->getQuery(true);
                $query00->select('id, LK_DATE, LK_TIME, N_PER')->from('#__lk_vstrechi')->where('N_PER=' . $db->quote($pid) . ' AND LK_TIME=' . $db->quote($tid));
                $db->setQuery($query00);
                $rows = $db->loadObjectList();
                if (!empty($rows)) {
                    foreach ($rows as $row) {
                        echo '<script>jQuery("#' . $fi . ' input[value=\"' . $row->LK_TIME . '\"]").addClass("btnoccup").removeClass("btn active").prop("onclick", null).attr("onclick", null);</script>';
                        echo '<script>jQuery("#' . $fi . ' input[value=\"' . $row->N_PER . '\"]").addClass("btnoccup").removeClass("btn active").prop("onclick", null).attr("onclick", null);</script>';
                        echo '<script>jQuery("#' . $fi . ' input[value=\"' . $row->LK_DATE . '\"]").addClass("btnoccup").removeClass("btn active").prop("onclick", null).attr("onclick", null);</script>';
                    }
                }
            }
            ////////////////если есть переговорная и дата
            if( ($pid != 1) && ($did != 1) ) {
                $db = JFactory::getDbo();
                $query00 = $db->getQuery(true);
                $query00->select('id, LK_DATE, LK_TIME, N_PER')->from('#__lk_vstrechi')->where('N_PER=' . $db->quote($pid) . ' AND LK_DATE=' . $db->quote($did) . ' AND LK_TIME=' . $db->quote($tid));
                $db->setQuery($query00);
                $rows = $db->loadObjectList();
                if (!empty($rows)) {
                    foreach ($rows as $row) {
                        echo '<script>jQuery("#'.$fi.' input[value=\"'.$row->LK_TIME.'\"]").addClass("btnoccup").removeClass("btn active").prop("onclick", null).attr("onclick", null);</script>';
                        echo '<script>jQuery("#'.$fi.' input[value=\"'.$row->N_PER.'\"]").addClass("btnoccup").removeClass("btn active").prop("onclick", null).attr("onclick", null);</script>';
                        echo '<script>jQuery("#'.$fi.' input[value=\"'.$row->LK_DATE.'\"]").addClass("btnoccup").removeClass("btn active").prop("onclick", null).attr("onclick", null);</script>';
                    }
                }
            }
            if ($sss != 1) {echo "<script>addname();checkallowsubmit(" . $sss . ")</script>";}
            if ($ssss != 1) {echo "<script>addname();checkallowsubmit(" . $ssss . ")</script>";}
            return exit;
        }
///////////////////////////////////// ЧЕК  ПО КЛИКУ НА ПЕРЕГОВОРНУЮ ////////////////////////////////////////
        if ( $input->getCmd( 'action', '' ) === 'getNper' ) {
            $fi = $input->get( 'fi', 1, STRING );
            $sss = $input->get( 'sss', 1, STRING );
            $ssss = $input->get( 'ssss', 1, STRING );
            $did = $input->get( 'did', 1, STRING );
            $tid = $input->get( 'tid', 1, STRING );
            $pid = $input->get( 'pid', 1, STRING );

            echo '<script>if(jQuery("#' . $fi . ' input[data-value=\"date\"]").attr("onclick")){dateclick' . $fi . ' = jQuery("#' . $fi . ' input[data-value=\"date\"]").attr("onclick");}</script>';
            echo '<script>if(jQuery("#' . $fi . ' input[data-value=\"time\"]").attr("onclick")){timeclick' . $fi . ' = jQuery("#' . $fi . ' input[data-value=\"time\"]").attr("onclick");}</script>';
            echo '<script>if(jQuery("#' . $fi . ' input[data-value=\"nper\"]").attr("onclick")){nperclick' . $fi . ' = jQuery("#' . $fi . ' input[data-value=\"nper\"]").attr("onclick");}</script>';
            echo '<script>jQuery("#' . $fi . ' input[data-value=\"date\"]").removeClass("btnoccup").addClass("btn").attr("onclick", dateclick' . $fi . ');</script>';
            echo '<script>jQuery("#' . $fi . ' input[data-value=\"time\"]").removeClass("btnoccup").addClass("btn").attr("onclick", timeclick' . $fi . ');</script>';
            echo '<script>jQuery("#' . $fi . ' input[data-value=\"nper\"]").removeClass("btnoccup").addClass("btn").attr("onclick", nperclick' . $fi . ');</script>';
            if($tid != 1) {echo '<script>jQuery("#'.$fi.' input[value=\"'.$tid.'\"]").addClass("active");</script>';}
            if($did != 1) {echo '<script>jQuery("#'.$fi.' input[value=\"'.$did.'\"]").addClass("active");</script>';}
            if($pid != 1) {echo '<script>jQuery("#'.$fi.' input[value=\"'.$pid.'\"]").addClass("active");</script>';}

            ////////////////если нет даты и времени
            if( ($did == 1) && ($tid == 1) ) {
                $db = JFactory::getDbo();
                $query1 = $db->getQuery(true);
                $query1->select('count(*)')->from('#__lk_vstrechi')->where('N_PER=' . $db->quote($pid));
                $db->setQuery($query1);
                $cntper = $db->loadResult();
                if ($cntper > 29) {
                    echo '<script>jQuery("#'.$fi.' input[value=\"'.$pid.'\"]").addClass("btnoccup").removeClass("btn active").prop("onclick", null).attr("onclick", null);</script>';
                    echo '<script>jQuery("#'.$fi.' input[data-value=\"time\"]").addClass("btnoccup").removeClass("btn").prop("onclick", null).attr("onclick", null);</script>';
//                    echo '<script>jQuery("#'.$fi.' input[data-value=\"time\"]").parent().attr("href", null).attr("onclick", null);</script>';
                    echo '<script>jQuery("#'.$fi.' input[data-value=\"date\"]").addClass("btnoccup").removeClass("btn").prop("onclick", null).attr("onclick", null);</script>';
//                    echo '<script>jQuery("#'.$fi.' input[data-value=\"date\"]").parent().attr("href", null).attr("onclick", null);</script>';
                }
            }
            ////////////////если есть дата и нет времени
            if( ($did != 1) && ($tid == 1) ) {
                $db = JFactory::getDbo();
                $query1 = $db->getQuery(true);
                $query1->select('count(*)')->from('#__lk_vstrechi')->where('LK_DATE=' . $db->quote($did) . ' AND N_PER=' . $db->quote($pid));
                $db->setQuery($query1);
                $cntdate = $db->loadResult();
                if ($cntdate > 9) {
                    echo '<script>jQuery("#'.$fi.' input[value=\"'.$did.'\"]").addClass("btnoccup").removeClass("btn active").prop("onclick", null).attr("onclick", null);</script>';
                    echo '<script>jQuery("#'.$fi.' input[value=\"'.$pid.'\"]").addClass("btnoccup").removeClass("btn active").prop("onclick", null).attr("onclick", null);</script>';
                    echo '<script>jQuery("#'.$fi.' input[data-value=\"time\"]").addClass("btnoccup").removeClass("btn").prop("onclick", null).attr("onclick", null);</script>';
//                    echo '<script>jQuery("#'.$fi.' input[data-value=\"time\"]").parent().attr("href", null).attr("onclick", null);</script>';
                }
                if ($cntdate < 10) {
                    $query00 = $db->getQuery(true);
                    $query00->select('id, LK_DATE, LK_TIME, N_PER')->from('#__lk_vstrechi')->where('N_PER=' . $db->quote($pid) . ' AND LK_DATE=' . $db->quote($did));
                    $db->setQuery($query00);
                    $rows = $db->loadObjectList();
                    if (!empty($rows)) {
                        foreach ($rows as $row) {
                            echo '<script>jQuery("#'.$fi.' input[value=\"'.$row->LK_TIME.'\"]").addClass("btnoccup").removeClass("btn active").prop("onclick", null).attr("onclick", null);</script>';
                            echo '<script>jQuery("#'.$fi.' input[value=\"'.$row->N_PER.'\"]").addClass("btnoccup").removeClass("btn active").prop("onclick", null).attr("onclick", null);</script>';
                        }
                    }
                }
            }
            ////////////////если нет даты и есть время
            if( ($did == 1) && ($tid != 1) ) {
                $db = JFactory::getDbo();
                $query00 = $db->getQuery(true);
                $query00->select('id, LK_DATE, LK_TIME, N_PER')->from('#__lk_vstrechi')->where('N_PER=' . $db->quote($pid) . ' AND LK_TIME=' . $db->quote($tid));
                $db->setQuery($query00);
                $rows = $db->loadObjectList();
                if (!empty($rows)) {
                    foreach ($rows as $row) {
                        echo '<script>jQuery("#' . $fi . ' input[value=\"' . $row->LK_TIME . '\"]").addClass("btnoccup").removeClass("btn active").prop("onclick", null).attr("onclick", null);</script>';
                        echo '<script>jQuery("#' . $fi . ' input[value=\"' . $row->N_PER . '\"]").addClass("btnoccup").removeClass("btn active").prop("onclick", null).attr("onclick", null);</script>';
                        echo '<script>jQuery("#' . $fi . ' input[value=\"' . $row->LK_DATE . '\"]").addClass("btnoccup").removeClass("btn active").prop("onclick", null).attr("onclick", null);</script>';
                    }
                }
            }
            ////////////////если есть дата и время
            if( ($did != 1) && ($tid != 1) ) {
                $db = JFactory::getDbo();
                $query00 = $db->getQuery(true);
                $query00->select('id, LK_DATE, LK_TIME, N_PER')->from('#__lk_vstrechi')->where('N_PER=' . $db->quote($pid) . ' AND LK_DATE=' . $db->quote($did) . ' AND LK_TIME=' . $db->quote($tid));
                $db->setQuery($query00);
                $rows = $db->loadObjectList();
                if (!empty($rows)) {
                    foreach ($rows as $row) {
                        echo '<script>jQuery("#'.$fi.' input[value=\"'.$row->LK_TIME.'\"]").addClass("btnoccup").removeClass("btn active").prop("onclick", null).attr("onclick", null);</script>';
                        echo '<script>jQuery("#'.$fi.' input[value=\"'.$row->N_PER.'\"]").addClass("btnoccup").removeClass("btn active").prop("onclick", null).attr("onclick", null);</script>';
                        echo '<script>jQuery("#'.$fi.' input[value=\"'.$row->LK_DATE.'\"]").addClass("btnoccup").removeClass("btn active").prop("onclick", null).attr("onclick", null);</script>';
                    }
                }
            }
            if ($sss != 1) {echo "<script>addname();checkallowsubmit(" . $sss . ")</script>";}
            if ($ssss != 1) {echo "<script>addname();checkallowsubmit(" . $ssss . ")</script>";}
            return exit;
        }

	}
}
