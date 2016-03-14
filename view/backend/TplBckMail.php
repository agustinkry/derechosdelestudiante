<?php

class TplBckMail {

    public static function getGenericMail($title, $leadBody, $link, $linkText, $centralBody = "", $calloutBody = "") {
        $oTpl = new UtlTemplate('generic.html', TPL_PATH . "mail/");
        $oTpl->assign("title", $title);
        $oTpl->assign("lead_body", $leadBody);
        $oTpl->assign("link", $link);
        $oTpl->assign("link_text", $linkText);
        $oTpl->assign("central_body", $centralBody);
        $oTpl->assign("callout_body", $calloutBody);
        return $oTpl->getOutputContent();
    }

}
