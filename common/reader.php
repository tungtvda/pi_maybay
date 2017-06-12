<?php
//require_once '../config.php';
//require_once DIR . '/common/messenger.php';
$id=1;
//echo read_html('epub/index_split_000.html',$id);
//webmsg($id);
//
//print_r(read_content(DIR.'/ebook/epub_html/1/content.opf'));
require_once DIR.'/controller/nhaxuatbanController.php';
function read_content($filename)
{
    $data=simplexml_load_file($filename);
    $result=array();
    $result['html']=array();
    foreach( $data->manifest->item as $item)
    {
        $dt=$item->attributes();
        if($dt['media-type']=='application/xhtml+xml')
        {
           array_push($result['html'],$dt['href']);
        }
        else if($dt['media-type']=='application/x-dtbncx+xml')
        {
            $result['mucluc']=$dt['href'];
        }
    }
    return $result;
}
function read_html($filename,&$charid,&$p_id)
{
    $data=simplexml_load_file($filename);
    $Result=array();
    $Result['span']='';
    $Result['p']="<?xml version='1.0' encoding='utf-8'?>\n<content>";
    foreach($data->body->p as $p)
    {
       $attributes=$p->attributes();
       $class=$attributes['class'];
       //if(isset($p[0])&&$p[0]!='') echo $p[0].'</br>';
        $replace=array('/>','<','(',')','&','%');
        if(isset($p->b))
        {
            $Result['p'].='<p class="'.$class.' block" id="p_'.$p_id.'"><b>'.str_replace($replace,'',$p->b[0]).'</b></p>'."\n";
            $Result['span'].='<p class="'.$class.' block" id="p_'.($p_id++).'"><b>'.buildString($p->b[0],$charid).'</b></p>'."\n";
        }
        else if(isset($p->i))
        {
            $Result['p'].='<p class="'.$class.' block" id="p_'.$p_id.'"><i>'.str_replace($replace,'',$p->i[0]).'</i></p>'."\n";
            $Result['span'].='<p class="'.$class.' block" id="p_'.($p_id++).'"><i>'. buildString($p->i[0],$charid).'</i></p>'."\n";
        }
        else
        {
            $Result['p'].='<p class="'.$class.' block" id="p_'.$p_id.'">'.str_replace($replace,'',$p[0]).'</p>'."\n";
            $Result['span'].='<p class="'.$class.' block" id="p_'.($p_id++).'">'. buildString($p[0],$charid).'</p>'."\n";
        }
    }
    $Result['p'].='</content>';
    return $Result;
}
//
function buildString($string,&$idbegin)
{
    $result='';
    $array=explode(" ",$string);
    foreach($array as $tu)
    {
        if(trim($tu)!="")
        {
            $result.='<span id="'.($idbegin++).'">'.$tu.' </span>';
        }
    }
    return $result;
}
//
function unzip_epub($filename,$bookid)
{
    $zip=new ZipArchive();
    $zip->open($filename);
    $zip->extractTo(DIR.'/ebook/epub_html/'.$bookid);
}
//
function process_epub($bookid)
{
    if(file_exists(DIR.'/ebook/epub_html/'.$bookid.'/content.opf'))
    {
        $struct=read_content(DIR.'/ebook/epub_html/'.$bookid.'/content.opf');
        $Char_id=1;
        $Char_id_start=1;
        $chap_id=1;
        $P_id=1;
        $Jsons=array();
        foreach($struct['html'] as $html)
        {
            $result=read_html(DIR.'/ebook/epub_html/'.$bookid.'/'.$html,$Char_id,$P_id);
            file_put_contents(DIR.'/ebook/html/'.$bookid.'_'.$chap_id.'.ebook',$result['span']);
            file_put_contents(DIR.'/ebook/html/'.$bookid.'_'.$chap_id.'_for_search.ebook',$result['p']);
           $newJson=array();
            $newJson['start']=$Char_id_start;
            $newJson['end']=$Char_id;
            array_push($Jsons,$newJson);
            $Char_id_start=$Char_id;
            $chap_id++;
        }
        for($i=0;$i<count($Jsons);$i++)
        {
            $begin=floor(($Jsons[$i]['start']/$Char_id)*100);
            $end=floor(($Jsons[$i]['end']/$Char_id)*100);
            file_put_contents(DIR.'/ebook/json/'.$bookid.'_'.($i+1).'.json',getJson(($i+1),$begin,$end,(($i+1)==count($Jsons)),$bookid));
        }
        //
       echo file_put_contents(DIR.'/ebook/html/'.$bookid.'_0.ebook',BuildCover($bookid));
       echo file_put_contents(DIR.'/ebook/json/'.$bookid.'_0.json',getJson(0,0,0,false,$bookid));
    }
}
//
function getJson($chap_id,$Start,$End,$is_last,$bookId)
{
    $json='{
                    "chapterId": '.$chap_id.',
                    "locationStart": '.$Start.',
                    "locationEnd": '.$End.',
                    "html": "'.SITE_NAME.'/view/default/chap.php?chapId='.$chap_id.'&bookId='.$bookId.'",
                    "nextchapterId": '.($is_last?'-1':($chap_id+1)).',
                    "prevchapterId": '.(($chap_id==0)?(-1):$chap_id-1);
    return $json;
}
//
//BuildMenu('../ebook/epub_html/1/toc.ncx');
function BuildMenu($filename)
{
    $data=simplexml_load_file($filename);
    foreach($data->navMap->navPoint as $Point)
    {
        $Label= $Point->navLabel->text;
        $attributes=$Point->content->attributes();
        $array=explode("#",$attributes['src']);
        $Chap=$array[0];
        echo $Chap;
    }
}
//
function BuildCover($bookId)
{
    $ListSach=sachService::GetById($bookId);
    if($ListSach!=false)
    {
        $AnhBia=$ListSach[0]->AnhBia;
        $NhaXuatBan=nhaxuatbanService::GetById($ListSach[0]->IdNhaXuatBan);
        $result= '<p style="text-align:center;" class="coverimg"><span><img src="'.SITE_NAME.$AnhBia.'" width="400px"/></span></p>'."\n";
        $result.='<p style="text-align:center;"><span><b>'.$ListSach[0]->Ten.'</b></span></p>'."\n";
        $result.='<p style="text-align:center;"><span>Bản quyền &copy; <b>'.($NhaXuatBan!=false?$NhaXuatBan[0]->Ten:'Không xác định').'</b></span></p>'."\n";
        $result.='<p style="text-align:center;"><span>Không phần nào trong tác phẩm này được phép sao chép hay phát hành dưới bất kỳ hình thức nào mà không được sự cho phép bằng văn bản quả cơ quan chủ quản</span></p>';
        return $result;
    }
    else return '';
}
?>