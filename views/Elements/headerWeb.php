<?php get_header(); ?>
<?php

header('Cache-Control: no cache'); //no cache

session_cache_limiter('must-revalidate');
?>
<style type="text/css">
/* Popup box BEGIN */
.hover_bkgr_fricc{
    background:rgba(0,0,0,.28);
    cursor:pointer;
    display:none;
    height:100%;
    position:fixed;
    text-align:center;
    top:0;
    width:100%;
    z-index:10000;
}
.hover_bkgr_fricc .helper{
    display:inline-block;
    height:100%;
    vertical-align:middle;
}
.hover_bkgr_fricc > div {
    background-color: #fff;
    box-shadow: 10px 10px 60px #555;
    display: inline-block;
    height: auto;
    max-width: 551px;
    min-height: 100px;
    vertical-align: middle;
    width: 60%;
    position: relative;
    border-radius: 8px;
    padding: 15px 5%;
}
.popupCloseButton {
	/*margin-top: 25px;*/
}

.trigger_popup_fricc {
    cursor: pointer;
    font-size: 20px;
    margin: 20px;
    display: inline-block;
    font-weight: bold;
}
.content2 {
    width: 70%;
    padding: 0 15px;
    float: left;
 } 
 .content {
    width: 100% !important;
        margin-bottom: 20px !important;
    
 }   

.block-head{margin-bottom: 10px;}
 #comments {
    
    clear: both;
}
.commentlist li {
  
    padding: 10px;
}


#respond{margin-top: 20px;}

  .share-post{  padding: 4px 0px !important; 
    
    margin-left: 10px !important;
    width: 99% !important;
}


@media only screen and (min-width: 990px) {
   .content {
    min-height: inherit !important;
}

}
/* Popup box BEGIN */
</style>
<div class="content2"> 