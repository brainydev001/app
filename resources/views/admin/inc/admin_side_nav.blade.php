 <!-- Main Sidebar Container -->
 <aside class="main-sidebar sidebar-dark-primary elevation-4">
     <!-- Brand Logo -->


     <!-- Sidebar -->
     <div class="sidebar">
         <!-- Sidebar user panel (optional) -->
         <div class="user-panel mt-3 pb-3 mb-3 d-flex">
             <div class="image">
                 {{-- <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image"> --}}
             </div>
             <div class="info">
                 <a href="#" class="d-block">{{ auth()->user()->first_name }} {{ auth()->user()->last_name }}</a>
             </div>
         </div>

         <!-- Sidebar Menu -->
         <nav class="mt-2">
             <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                 data-accordion="false">
                 <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                 {{-- reminders --}}
                 <li class="nav-item">
                     <a href="#" class="nav-link">
                         <i class="nav-icon fas fa-tree"></i>
                         <p>
                             Reminders
                             <span class="right badge badge-danger">New</span>
                         </p>
                     </a>
                 </li>

                 {{-- members --}}
                 <li class="nav-item has-treeview">
                     <a href="#" class="nav-link">
                         <i class="nav-icon fa fa-users"></i>
                         <p>
                             Users
                             <i class="fas fa-angle-left right"></i>
                         </p>
                     </a>
                     <ul class="nav nav-treeview bg-grey text-dark border">
                         <li class="nav-item">
                             <a href="{{ url('user_create') }}" class="nav-link">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>Create new user</p>
                             </a>
                         </li>
                         <li class="nav-item">
                             <a href="{{ url('user/staff') }}" class="nav-link">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>All staff</p>
                             </a>
                         </li>
                         <li class="nav-item">
                             <a href="{{ url('user/farmer') }}" class="nav-link">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>All farmers</p>
                             </a>
                         </li>
                         <li class="nav-item">
                             <a href="{{ url('user/kin') }}" class="nav-link">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>Kin List</p>
                             </a>
                         </li>
                         <li class="nav-item">
                             <a href="#" class="nav-link">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>Archived Members</p>
                             </a>
                         </li>
                     </ul>
                 </li>

                 {{-- modules --}}
                 <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-chart-pie"></i>
                        <p>
                            Modules
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview border">
                        <li class="nav-item">
                            <a href="{{ url('module/Event') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Events</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('module/Activity') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Activities</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('module/Module') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Modules</p>
                            </a>
                        </li>
                    </ul>
                </li>

                 {{-- inputs --}}
                 <li class="nav-item has-treeview">
                     <a href="#" class="nav-link">
                         <i class="nav-icon fas fa-chart-pie"></i>
                         <p>
                             Input
                             <i class="right fas fa-angle-left"></i>
                         </p>
                     </a>
                     <ul class="nav nav-treeview border">
                         <li class="nav-item">
                             <a href="#" class="nav-link">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>Requests</p>
                             </a>
                         </li>
                         <li class="nav-item">
                             <a href="#" class="nav-link">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>All Inputs</p>
                             </a>
                         </li>
                     </ul>
                 </li>

                 {{-- outputs --}}
                 <li class="nav-item has-treeview">
                     <a href="#" class="nav-link">
                         <i class="nav-icon fas fa-chart-pie"></i>
                         <p>
                             Output
                             <i class="fas fa-angle-left right"></i>
                         </p>
                     </a>
                     <ul class="nav nav-treeview border">
                         <li class="nav-item">
                             <a href="#" class="nav-link">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>All Requisition</p>
                             </a>
                         </li>
                         <li class="nav-item">
                             <a href="#" class="nav-link">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>All Outputs</p>
                             </a>
                         </li>
                     </ul>
                 </li>

                 {{-- payments --}}
                 <li class="nav-item has-treeview">
                     <a href="#" class="nav-link">
                         <i class="nav-icon fas fa-chart-pie"></i>
                         <p>
                             Payments
                             <i class="fas fa-angle-left right"></i>
                         </p>
                     </a>
                     <ul class="nav nav-treeview border">
                         <li class="nav-item">
                             <a href="#" class="nav-link">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>All Payments</p>
                             </a>
                         </li>
                         <li class="nav-item">
                             <a href="#" class="nav-link">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>PAFID to Farmer</p>
                             </a>
                         </li>
                         <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>PAFID to Staff</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Pending Payments</p>
                            </a>
                        </li>
                     </ul>
                 </li>

                 {{-- Business Intelligence --}}
                 <li class="nav-item has-treeview">
                     <a href="#" class="nav-link">
                         <i class="nav-icon fas fa-file-powerpoint"></i>
                         <p>
                             Business Intelligence
                             <i class="fas fa-angle-left right"></i>
                         </p>
                     </a>
                     <ul class="nav nav-treeview border">
                         <li class="nav-item">
                             <a href="{{ url('user_analysis') }}" class="nav-link">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>User Data Analysis</p>
                             </a>
                         </li>
                         <li class="nav-item">
                             <a href="#" class="nav-link">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>Input Data Analysis</p>
                             </a>
                         </li>
                         <li class="nav-item">
                             <a href="#" class="nav-link">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>Output Data Analysis</p>
                             </a>
                         </li>
                         <li class="nav-item">
                             <a href="#" class="nav-link">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>Payments Data Analysis</p>
                             </a>
                         </li>
                     </ul>
                 </li>

                 {{-- sys settings --}}
                 <li class="nav-header">System Settings</li>

                 {{-- regions --}}
                 <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-file-powerpoint"></i>
                        <p>
                            Region
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview border">
                        <li class="nav-item">
                            <a href="{{ url('region/Region') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Regions</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('region/Constituency') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Constituencies</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('region/Ward') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Wards</p>
                            </a>
                        </li>
                    </ul>
                </li>

                 {{-- types --}}
                 <li class="nav-item">
                     <a href="{{ url('type_index') }}" class="nav-link">
                         <i class="nav-icon fas fa-users-cog"></i>
                         <p>
                             Membership Types
                         </p>
                     </a>
                 </li>

                 {{-- security & access control --}}
                 <li class="nav-item">
                     <a href="{{ url('access_control') }}" class="nav-link">
                         <i class="nav-icon fas fa-cogs"></i>
                         <p>
                             Security & Access Control
                             <span class="badge badge-info right"></span>
                         </p>
                     </a>
                 </li>

                 {{-- user logs --}}
                 <li class="nav-item">
                     <a href="{{ url('user_logs') }}" class="nav-link">
                         <i class="nav-icon fas fa-users"></i>
                         <p>
                             User Logs
                             <span class="badge badge-info right"></span>
                         </p>
                     </a>
                 </li>
             </ul>
         </nav>
         <!-- /.sidebar-menu -->
     </div>
     <!-- /.sidebar -->
 </aside>
