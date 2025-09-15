<div class="home-report">
    <div class="tab-content-basic">
        <div class="d-sm-flex align-items-center justify-content-between border-bottom">
        <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item active">
            <a class="nav-link  ps-0" id="profile-tab" data-bs-toggle="tab" href="#news" role="tab" aria-selected="false">News</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" id="home-tab" data-bs-toggle="tab" href="#overview" role="tab" aria-controls="overview" aria-selected="true">Users</a>
            </li>
            
            <!-- <li class="nav-item">
            <a class="nav-link" id="contact-tab" data-bs-toggle="tab" href="#demographics" role="tab" aria-selected="false">Demographics</a>
            </li>
            <li class="nav-item">
            <a class="nav-link border-0" id="more-tab" data-bs-toggle="tab" href="#more" role="tab" aria-selected="false">More</a>
            </li> -->
        </ul>
        <div>
            <div class="btn-wrapper">
            <a href="#" class="btn btn-otline-dark align-items-center"><i class="icon-share"></i> Share</a>
            <a href="#" class="btn btn-otline-dark"><i class="icon-printer"></i> Print</a>
            <a href="#" class="btn btn-primary text-white me-0"><i class="icon-download"></i> Export</a>
            </div>
        </div>
        
        </div>
    </div>



    <div class="tab-content tab-content-basic">
    <div class="tab-pane fade show active" id="news" role="tabpanel" aria-labelledby="overview"> 
            <div class="row">
            <div class="col-sm-12">

                <div class="statistics-details d-flex align-items-center justify-content-between">
                <div>
                    <p class="statistics-title">Total News</p>
                    <h3 class="rate-percentage"><?php echo totalNews($mysqli,'','');?></h3>
                </div>
                <?php
                $newsLanguage = newsLanguage($mysqli);
                foreach($newsLanguage as $lan)
                {
                ?>
                <div>
                    <p class="statistics-title"><?php echo $lan.' News';?></p>
                    <h3 class="rate-percentage"><?php echo totalNews($mysqli,$lan,'');?></h3>
                </div>
                <?php
                }
                ?>
                <div>
                    <p class="statistics-title">Active News</p>
                    <h3 class="rate-percentage"><?php echo totalUser($mysqli,'','y');?></h3>
                </div>
                <div>
                    <p class="statistics-title">In-Active News</p>
                    <h3 class="rate-percentage"><?php echo totalUser($mysqli,'','n');?></h3>
                </div>
                
                </div>

            </div>
            </div> 
        </div>
        <div class="tab-pane fade show" id="overview" role="tabpanel" aria-labelledby="overview"> 
            <div class="row">
            <div class="col-sm-12">

                <div class="statistics-details d-flex align-items-center justify-content-between">
                <div>
                    <p class="statistics-title">Total User</p>
                    <h3 class="rate-percentage"><?php echo totalUser($mysqli,'');?></h3>
                </div>
                <div>
                    <p class="statistics-title">User Active</p>
                    <h3 class="rate-percentage"><?php echo totalUser($mysqli,'y');?></h3>
                </div>
                <div>
                    <p class="statistics-title">User In-Active</p>
                    <h3 class="rate-percentage"><?php echo totalUser($mysqli,'n');?></h3>
                </div>
              
                </div>

            </div>
            </div> 
        </div>


        
    </div>

</div>