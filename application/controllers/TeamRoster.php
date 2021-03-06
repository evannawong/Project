<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TeamRoster
 *
 * TeamRoster displays all the team information for our project team, the 
 * Dallas Cowboys
 * 
 * @author Devan Yim & Derek Gleeson
 */
class TeamRoster extends Application {
    public $pagenum = 0;
    function __construct() {
        parent::__construct();
    }

    //Displays the team roster - Devan Yim
    function index() {
        //$this->data['pagebody'] = 'TeamRoster';    // this is the view we want shown
        //$this->data['players'] = $this->Roster->all();
        //$this->render();

        $this->page();
    }
    
    //Displays the team roster in groups with pagination - Evanna Wong
    function page($page_num = 1){
        $this->data['pagebody'] = 'TeamRoster';
        
        //Pagination settings
        $config = array();
        $config["base_url"] = base_url() . "Team/page";
        $config["total_rows"] = $this->Roster->record_count();
        $config['per_page'] = 12;
        $config['use_page_numbers']  = TRUE;
        $config['page_query_string'] = FALSE;
        
        //Bootstrap pagination controls
        $config['full_tag_open'] = "<ul class='pagination'>";
        $config['full_tag_close'] ="</ul>";
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
        $config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
        $config['next_tag_open'] = "<li>";
        $config['next_tagl_close'] = "</li>";
        $config['prev_tag_open'] = "<li>";
        $config['prev_tagl_close'] = "</li>";
        $config['first_tag_open'] = "<li>";
        $config['first_tagl_close'] = "</li>";
        $config['last_tag_open'] = "<li>";
        $config['last_tagl_close'] = "</li>";       
        $config['first_link'] = 'First';
        $config['last_link'] = 'Last';
        $config['next_link'] = 'Next';
        $config['prev_link'] = 'Previous';
        
        $this->pagination->initialize($config); 
        
        //Fetch data from model
        $this->data['players'] = $this->Roster->get_data($config["per_page"], $page_num);
        
        //Create page links
        $this->data["links"] = $this->pagination->create_links();
        
        $this->render();
    }
}
