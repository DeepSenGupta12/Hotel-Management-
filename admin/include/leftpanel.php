<nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item">
            <a class="nav-link" href="<?php echo $link;?>/dashboard">
              <i class="mdi mdi-grid-large menu-icon"></i>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo $link;?>/customer_view">
              <i class="mdi mdi-grid-large menu-icon"></i>
              <span class="menu-title">CUSTOMER DETAILS</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo $link;?>/room_availibility">
              <i class="mdi mdi-grid-large menu-icon"></i>
              <span class="menu-title">ROOM AVAILIBILITY</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo $link;?>/room_facility">
              <i class="mdi mdi-grid-large menu-icon"></i>
              <span class="menu-title">ROOM FACILITY</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo $link;?>/food_menu">
              <i class="mdi mdi-grid-large menu-icon"></i>
              <span class="menu-title">FOOD MENU</span>
            </a>
          </li>
          <li class="nav-item nav-category">ROOM MASTER</li>
          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#ui-rooms" aria-expanded="false" aria-controls="ui-basic">
              <i class="menu-icon mdi mdi-floor-plan"></i>
              <span class="menu-title">ADD / VIEW ROOM</span>
              &nbsp;&nbsp;<i class="fa fa-caret-right"></i> 
            </a>
            <div class="collapse" id="ui-rooms">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="<?php echo $link;?>/room_create">ADD</a></li>
                <li class="nav-item"> <a class="nav-link" href="<?php echo $link;?>/room_view">VIEW</a></li>
              </ul>
            </div>
          </li>
          
          <li class="nav-item nav-category">TOUR PLACES MASTER</li>
          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#ui-user" aria-expanded="false" aria-controls="ui-basic">
              <i class="menu-icon mdi mdi-floor-plan"></i>
              <span class="menu-title">ADD / VIEW TOUR</span>
              &nbsp;&nbsp;<i class="fa fa-caret-right"></i> 
            </a>
            <div class="collapse" id="ui-user">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="<?php echo $link;?>/tour_add">ADD</a></li>
                <li class="nav-item"> <a class="nav-link" href="<?php echo $link;?>/tour_view">VIEW</a></li>
              </ul>
            </div>
          </li>
          
          <li class="nav-item nav-category">GALLERY MASTER</li>
          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#ui-gallery" aria-expanded="false" aria-controls="ui-basic">
              <i class="menu-icon mdi mdi-floor-plan"></i>
              <span class="menu-title">ADD / VIEW GALLERY</span>
              &nbsp;&nbsp;<i class="fa fa-caret-right"></i> 
            </a>
            <div class="collapse" id="ui-gallery">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="<?php echo $link;?>/gallery_add">ADD</a></li>
                <li class="nav-item"> <a class="nav-link" href="<?php echo $link;?>/gallery_view">VIEW</a></li>
              </ul>
            </div>
          </li>
          
          
        </ul>
      </nav>
    