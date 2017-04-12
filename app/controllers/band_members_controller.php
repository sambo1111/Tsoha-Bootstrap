<?php

class BandMemberController extends BaseController {
    
    public static function index() {
        
        
    }
    
    public static function show($id) {
        
        $band_member = BandMember::find($id);
        
        View::make('band_member/show.html', array('band_member' => $band_member));
        
    }
}
