<aside class="left-sidebar admin-sidebar">
          <div id="sidebar" class="sidebar sidebar-with-footer">
            <!-- Aplication Brand -->
            <div class="app-brand">
              <a href="javascript:void(0)" title="Proposal">
                <span class="brand-name text-truncate">Proposal Dashboard</span>
              </a>
            </div>

            <!-- begin sidebar scrollbar -->
            <div class="" data-simplebar style="height: 100%;">
              <!-- sidebar menu -->
              
              <ul class="nav sidebar-inner" id="sidebar-menu">
                @if(auth()->user()->role_id == 1)
                <li class="{{ Request::is('admin/home') ? 'active' : '' }}">
                    <a class="sidenav-item-link" href="/admin/home">
                    <i class="mdi mdi-view-dashboard-outline"></i>
                        <span class="nav-text">Dashboard</span>
                    </a>
                </li>
                <li class="{{ Request::is('admin/users*') ? 'active' : '' }}">
                    <a class="sidenav-item-link" href="/admin/users">
                    <i class="mdi mdi-account-multiple-outline"></i>
                        <span class="nav-text">Gov Users</span>
                    </a>
                </li>
                <li class="{{ Request::is('admin/proposal-users') ? 'active' : '' }}">
                    <a class="sidenav-item-link" href="/admin/proposal-users">
                    <i class="mdi mdi-account-multiple"></i>
                        <span class="nav-text">Users</span>
                    </a>
                </li>
                <li class="{{ Request::is('admin/categories') ? 'active' : '' }}">
                    <a class="sidenav-item-link" href="/admin/categories">
                    <i class="mdi mdi-format-list-bulleted"></i>
                        <span class="nav-text">Categories</span>
                    </a>
                </li>
                <li class="{{ Request::is('admin/email') ? 'active' : '' }}">
                    <a class="sidenav-item-link" href="/admin/email">
                    <i class="mdi mdi-email"></i>
                        <span class="nav-text">Email</span>
                    </a>
                </li>
                <li class="{{ Request::is('admin/board-members') ? 'active' : '' }}">
                    <a class="sidenav-item-link" href="/admin/board-members">
                    <i class="mdi mdi-account-multiple-outline"></i>
                        <span class="nav-text">Board Members</span>
                    </a>
                </li>
                @endif
                <li class="{{ Request::is('admin/proposals*') ? 'active' : '' }}">
                    <a class="sidenav-item-link" href="/admin/proposals">
                    <i class="mdi mdi-file-pdf"></i>
                        <span class="nav-text">Proposals</span>
                    </a>
                </li>
              </ul>
            </div>
          </div>
        </aside>