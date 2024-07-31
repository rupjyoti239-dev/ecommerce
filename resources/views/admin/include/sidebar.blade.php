<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
    <div class="menu_section">
        <h3>General</h3>
        <ul class="nav side-menu">
            <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-home"></i> Home </a>
            </li>


            <li><a><i class="fa-solid fa-gear"></i> Category <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="{{ route('admin.category.list') }}">Category list</a></li>
                </ul>
            </li>

            <li><a><i class="fa-solid fa-gear"></i> Settings <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="{{ route('admin.change-password') }}">Change Password</a></li>
                </ul>
            </li>

        </ul>
    </div>


</div>
