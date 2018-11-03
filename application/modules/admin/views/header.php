<header class="page-header row justify-center">
    <div class="col-md-6 col-lg-8" >
        <h1 class="float-left text-center text-md-left"><?= $menu ?></h1>
    </div>
    
    <div class="dropdown user-dropdown col-md-6 col-lg-4 text-center text-md-right">
        <img src="<?=base_url()?>assets/images/logo.jpg" alt="profile photo" class="circle float-left profile-photo" width="50" height="auto">
        
        <div class="username mt-1">
            <h4 class="mb-1"><?= $this->session->userdata('identity'); ?></h4>
            
            <h6 class="text-muted"><?= $this->ion_auth->get_users_groups($this->session->userdata('user_id'))->result()[0]->name; ?></h6>
        </div>
    
    </div>
    
    <div class="clear"></div>
</header>